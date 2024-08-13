drop database if exists duffet;
create database duffet;
use duffet;

create table usuario (
	id int auto_increment primary key,
    cpf varchar(16) not null unique,
    nome varchar(100) not null,
    sobrenome varchar(100) not null,
    email varchar(100) not null unique,
    senha varchar(100) not null,
    endereco varchar(100) not null,
    telefone varchar(30) not null,
    is_admin boolean default false	
);

create table produto (
	id int auto_increment primary key,
    nome varchar(100) not null,
    preco float not null,
    descricao text not null,
    quant_disponivel int not null,
    tipo enum("doce","bolo", "especial") not null default "bolo",
    sabor varchar(100) not null,
    imagem varbinary(1000) default null
);

create table pedido (
	codigo int auto_increment,
    id_produto int,
    id_usuario int,
    primary key (codigo, id_produto, id_usuario),
    foreign key (id_produto) references produto(id),
    foreign key (id_usuario) references usuario(id)
);

create table carrinho (
	id_produto int,
    id_usuario int,
    primary key (id_produto, id_usuario),
    foreign key (id_produto) references produto(id),
    foreign key (id_usuario) references usuario(id)
);

create table historico (
	id_produto int,
    id_usuario int,
    primary key (id_produto, id_usuario),
    foreign key (id_produto) references produto(id),
    foreign key (id_usuario) references usuario(id)
);

create table comentario (
	id_produto int,
    id_usuario int,
    data date not null,
    conteudo text not null,
    primary key (id_produto, id_usuario),
    foreign key (id_produto) references produto(id),
    foreign key (id_usuario) references usuario(id)
);

insert into usuario values 
(default, "00000000001", "admin", "admin", "admin@gmail.com", "2ac9a6746aca543af8dff39894cfe8173afba21eb01c6fae33d52947222855ef", "Rua Anuar Sadat, 600", "3899", true);

insert into produto values 
(default, "Bolo de Maracujá com Brigadeiro", 22.30, "bla bla bla", 20, "bolo", "Maracujá com Brigadeiro", default);

