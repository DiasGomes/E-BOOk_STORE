--Trabalho BD
-- Caio Vinicius, Pedro Duarte, Thales, Joao Gomes

--Criacao das tabelas

drop table AVALIACAO cascade constraints;
drop table AQUISICAO cascade constraints;
drop table CLIENTE cascade constraints;
drop table EBOOK_GENERO cascade constraints;
drop table GENERO cascade constraints;
drop table AUTORIA cascade constraints;
drop table E_BOOK cascade constraints;
drop table EDITORA cascade constraints;
drop table AUTOR cascade constraints;

drop trigger TR_EBOOK_NUM_COMPRAS;
drop trigger TR_EBOOK_MEDIA_AVAL;
drop trigger TR_CLIENTE_VALID_EMAIL;
drop trigger TR_CLIENTE_SALDO_UPDATE;
drop trigger TR_CLIENTE_CK_SALDO_COMPRA;

create table AUTOR (
    ID_Autor number(5),
    Primeiro_Nome varchar(30) not null,
    Segundo_Nome varchar(30) not null
);

create table EDITORA (
    ID_Editora number(5),
    Nome varchar2(30) not null
);

create table E_BOOK (
    ID_Ebook number(5),
    Titulo varchar2(30) not null,
    Edicao number(2) not null,
    Data_publicacao date not null,
    Preco number(5,2) not null,
    Link_arquivo varchar2(30) not null,
    ID_Editora number(5) not null,
    Numero_compras number(5) default 0 not null,
    Num_avaliacoes number(2) default 0 not null,
    Soma_avaliacoes number(5) default 0 not null
);

create table AUTORIA (
    ID_Ebook number(5),
    ID_Autor number(5)
);

create table GENERO (
    Genero varchar2(20)
);

create table EBOOK_GENERO (
    ID_Ebook number(5),
    Genero varchar2(20)
);

create table CLIENTE (
    Email varchar2(40),
    Primeiro_Nome varchar2(30) not null,
    Segundo_Nome varchar2(30) not null,
    Saldo number(6,2) default 0 not null,
    Hash_senha varchar2(40) not null
);

create table AQUISICAO (
    Email_Cliente varchar2(40),
    ID_Ebook number(5),
    Data_aquisicao date default CURRENT_DATE not null,
    Preco number(6,2) not null
);

create table AVALIACAO (
    Email_Cliente varchar2(40),
    ID_Ebook number(5),
    Nota number(2) not null,
    Comentario varchar2(80)
);

--Restricoes

alter table AUTOR add constraint AUTOR_PK primary key(ID_Autor);

alter table EDITORA add constraint EDITORA_PK primary key(ID_Editora);

alter table E_BOOK add constraint EBOOK_PK primary key(ID_Ebook);
alter table E_BOOK add constraint EB_EDITORA_FK foreign key(ID_Editora) references EDITORA(ID_Editora);
alter table E_BOOK add constraint EB_PRECO_CK check(Preco >= 0);

alter table AUTORIA add constraint AUT_EBOOK_FK foreign key(ID_Ebook) references E_BOOK(ID_Ebook);
alter table AUTORIA add constraint AUT_AUTOR_FK foreign key(ID_Autor) references AUTOR(ID_Autor);
alter table AUTORIA add constraint AUTORIA_PK primary key(ID_Ebook, ID_Autor);

alter table GENERO add constraint GENERO_PK primary key(Genero);

alter table EBOOK_GENERO add constraint EG_GENERO_FK foreign key(Genero) references GENERO(Genero);
alter table EBOOK_GENERO add constraint EG_EBOOK_FK foreign key(ID_Ebook) references E_BOOK(ID_Ebook);
alter table EBOOK_GENERO add constraint EBOOK_GENERO_PK primary key(ID_Ebook, Genero);

alter table CLIENTE add constraint CLIENTE_PK primary key(Email);
alter table CLIENTE add constraint CL_SALDO_CK check(Saldo >= 0);

alter table AQUISICAO add constraint AQ_CLIENTE_FK foreign key(Email_Cliente) references CLIENTE(Email);
alter table AQUISICAO add constraint AQ_EBOOK_FK foreign key(ID_Ebook) references E_BOOK(ID_Ebook);
alter table AQUISICAO add constraint AQUISICAO_PK primary key(Email_Cliente, ID_EBook);
alter table AQUISICAO add constraint AQ_PRECO_CK check(Preco >= 0);

alter table AVALIACAO add constraint AV_CLIENTE_EBOOK_FK foreign key(Email_Cliente, ID_Ebook) references AQUISICAO(Email_Cliente, ID_Ebook);
alter table AVALIACAO add constraint AVALIACAO_PK primary key(Email_Cliente, ID_Ebook);
alter table AVALIACAO add constraint AV_NOTA_CK check(Nota between 0 and 10);

--Triggers

create or replace trigger TR_EBOOK_NUM_COMPRAS
after insert or delete on AQUISICAO for each row
BEGIN
    IF(inserting) THEN
        update E_BOOK set Numero_compras = (select Numero_compras from E_Book e where e.ID_Ebook = :NEW.ID_Ebook) + 1 where ID_Ebook = :NEW.ID_Ebook;
    ELSE
        update E_BOOK set Numero_compras = (select Numero_compras from E_Book e where e.ID_Ebook = :NEW.ID_Ebook) - 1 where ID_Ebook = :NEW.ID_Ebook;
    END IF;
END;
/

create or replace trigger TR_EBOOK_AVAL
after insert or update or delete on AVALIACAO for each row
BEGIN
    IF INSERTING THEN
        update E_BOOK set Num_avaliacoes = (select Num_avaliacoes from E_Book e where e.ID_Ebook = :NEW.ID_Ebook) + 1 where ID_Ebook = :NEW.ID_Ebook;
        update E_BOOK set Soma_avaliacoes = (select Soma_avaliacoes from E_Book e where e.ID_Ebook = :NEW.ID_Ebook) + :NEW.Nota where ID_Ebook = :NEW.ID_Ebook;
    ELSE IF UPDATING THEN
            update E_BOOK set Soma_avaliacoes = (select Soma_avaliacoes from E_Book e where e.ID_Ebook = :NEW.ID_Ebook) + :NEW.Nota - :OLD.Nota where ID_Ebook = :NEW.ID_Ebook;
        ELSE
            update E_BOOK set Num_avaliacoes = (select Num_avaliacoes from E_Book e where e.ID_Ebook = :OLD.ID_Ebook) - 1 where ID_Ebook = :OLD.ID_Ebook;
            update E_BOOK set Soma_avaliacoes = (select Soma_avaliacoes from E_Book e where e.ID_Ebook = :OLD.ID_Ebook) - :OLD.Nota where ID_Ebook = :OLD.ID_Ebook;
        END IF;
    END IF;
END;
/

create or replace trigger TR_CLIENTE_VALID_EMAIL
before insert or update of Email on CLIENTE for each row
BEGIN
    IF(:NEW.Email not like '%@%.com') THEN
        RAISE_APPLICATION_ERROR (-20001,'20001: Email invalido.');
    END IF;
END;
/

create or replace trigger TR_CLIENTE_SALDO_UPDATE
before update of Saldo on CLIENTE for each row
BEGIN
    IF(:NEW.Saldo > :OLD.Saldo + 10000 or :NEW.Saldo < :OLD.Saldo - 10000) THEN
        RAISE_APPLICATION_ERROR (-20002,'20002: Variacao absoluta no saldo maior do que 10000 reais.');
    END IF;
END;
/

create or replace trigger TR_CLIENTE_CK_SALDO_COMPRA
before insert or update of Preco on AQUISICAO for each row --update em aquisicao alterara o saldo do cliete
declare CL_Saldo number(6,2);
BEGIN
    IF INSERTING THEN
        select Saldo into CL_Saldo from CLIENTE where Email = :NEW.Email_Cliente;
        IF CL_Saldo < :NEW.Preco THEN
            RAISE_APPLICATION_ERROR (-20003,'20003: Saldo insuficiente.');
        ELSE
            update CLIENTE set Saldo = CL_Saldo - :NEW.Preco where Email = :NEW.Email_Cliente;
        END IF;
    ELSE
        select Saldo into CL_Saldo from CLIENTE where Email = :NEW.Email_Cliente;
        IF :NEW.Preco - :OLD.Preco > CL_Saldo THEN
            RAISE_APPLICATION_ERROR (-20003,'20003: Saldo insuficiente.');
        ELSE
            update CLIENTE set Saldo = CL_Saldo - (:NEW.Preco - :OLD.Preco) where Email = :NEW.Email_Cliente;
        END IF;
    END IF;
END;
/

-- Insercoes

insert into CLIENTE values ('admin@admin.com', 'admin', 'admin', 0, '123');
insert into CLIENTE values ('caiovinicius@gmail.com', 'Caio', 'Vinicius', 100, '123');
insert into CLIENTE values ('joaogomes@gmail.com', 'Joao', 'Gomes', 200, '123');
insert into CLIENTE values ('pedroduarte@gmail.com', 'Pedro', 'Duarte', 300, '123');
insert into CLIENTE values ('tales@gmail.com', 'Tales', 'A', 400, '123');
--select * from CLIENTE;

insert into AUTOR values (1, 'Paul', 'Deitel');
insert into AUTOR values (2, 'Robert', 'Boylestad');
insert into AUTOR values (3, 'Machado', 'Assis');
insert into AUTOR values (4, 'Clarisse', 'Lispector');
insert into AUTOR values (5, 'JRR', 'Tolkien');
--select * from AUTOR;

insert into EDITORA values (1, 'Editora A');
insert into EDITORA values (2, 'Editora B');
insert into EDITORA values (3, 'Editora C');
insert into EDITORA values (4, 'Editora D');
insert into EDITORA values (5, 'Editora E');
--select * from EDITORA;

insert into GENERO values ('Ficcao');
insert into GENERO values ('Romance');
insert into GENERO values ('Drama');
insert into GENERO values ('Infantil');
insert into GENERO values ('Conto');
--select * from GENERO;

insert into E_BOOK values (1, 'Titulo1', 1, '01/01/2001', 100, 'Link1', 1, 0, 0, 0);
insert into E_BOOK values (2, 'Titulo2', 1, '02/02/2002', 200, 'Link2', 2, 0, 0, 0);
insert into E_BOOK values (3, 'Titulo3', 1, '03/03/2003', 300, 'Link3', 3, 0, 0, 0);
insert into E_BOOK values (4, 'Titulo4', 1, '04/04/2004', 400, 'Link4', 4, 0, 0, 0);
insert into E_BOOK values (5, 'Titulo5', 1, '05/05/2005', 500, 'Link5', 5, 0, 0, 0);
--select * from E_BOOK;

insert into EBOOK_GENERO values (1, 'Ficcao');
insert into EBOOK_GENERO values (1, 'Infantil'); --livro 1 possui 2 generos
insert into EBOOK_GENERO values (2, 'Romance');
insert into EBOOK_GENERO values (3, 'Drama');
insert into EBOOK_GENERO values (4, 'Infantil');
insert into EBOOK_GENERO values (5, 'Conto');
--select * from EBOOK_GENERO;

insert into AUTORIA values (1, 1);
insert into AUTORIA values (1, 2); --autores 1 e 2 escreveram o livro 1
insert into AUTORIA values (2, 2);
insert into AUTORIA values (3, 3);
insert into AUTORIA values (4, 4);
insert into AUTORIA values (5, 5);
--select * from AUTORIA;

--teste trigger de num_compras e saldo minimo
select Saldo from CLIENTE where Email = 'caiovinicius@gmail.com';
select Numero_compras from E_BOOK where ID_Ebook = 1;
insert into AQUISICAO values ('caiovinicius@gmail.com', 1, '01/01/2000', 100); --Cliente 2 compra livro 1 por 100 reais
select Saldo from CLIENTE where Email = 'caiovinicius@gmail.com';
select Numero_compras from E_BOOK where ID_Ebook = 1;

--teste trigger valor aquisicao > saldo
select Saldo from CLIENTE where email = 'joaogomes@gmail.com';
select Numero_compras from E_BOOK where ID_Ebook = 3;
insert into AQUISICAO values ('joaogomes@gmail.com', 3, '01/01/2000', 300); --Cliente 3 tenta comprar livro 3 por 300 reais (tem saldo de 200) --falha
select Saldo from CLIENTE where Email = 'joaogomes@gmail.com';
select Numero_compras from E_BOOK where ID_Ebook = 3;

insert into AQUISICAO values ('caiovinicius@gmail.com', 2, '01/01/2000', 0);
insert into AQUISICAO values ('caiovinicius@gmail.com', 3, '01/01/2000', 0);
insert into AQUISICAO values ('caiovinicius@gmail.com', 4, '01/01/2000', 0);
insert into AQUISICAO values ('caiovinicius@gmail.com', 5, '01/01/2000', 0); --caio possui livros de 1 a 5, ganhou de graca

insert into AQUISICAO values ('pedroduarte@gmail.com', 2, '01/01/2000', 0);
insert into AQUISICAO values ('pedroduarte@gmail.com', 3, '01/01/2000', 0); --pedro possui livros 2 e 3

insert into AQUISICAO values ('tales@gmail.com',4, '01/01/2000', 0);
insert into AQUISICAO values ('tales@gmail.com',5, '01/01/2000', 0); --tales possui livros 4 e 5

--teste trigger nota media avaliacao
select * from AVALIACAO;
select Num_avaliacoes, Soma_avaliacoes from E_BOOK where ID_Ebook = 1;
--insert into AVALIACAO values ('caiovinicius@gmail.com', 2, 10, 'Bom'); --tenta avalia um livro que nao possui
insert into AVALIACAO values ('caiovinicius@gmail.com', 1, 10, 'Bom');
select * from AVALIACAO;
select Num_avaliacoes, Soma_avaliacoes from E_BOOK where ID_Ebook = 1;

insert into AVALIACAO values ('caiovinicius@gmail.com', 2, 10, 'Ok');
insert into AVALIACAO values ('pedroduarte@gmail.com', 2, 5, 'Pode melhorar'); --media deve ser 10+5 / 2 = 7.5

--teste update e delete
--select * from E_BOOK;
--update AVALIACAO set Nota = 5 where Email_Cliente = 'caiovinicius@gmail.com' and ID_Ebook = 2;
--delete from AVALIACAO where Email_Cliente = 'caiovinicius@gmail.com' and ID_Ebook = 2;

commit;

