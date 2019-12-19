CREATE DATABASE chaimastore;
USE chaimastore;

CREATE TABLE usuarios (
  id int primary key auto_increment not null,
  nombre varchar(100) not null,
  apellidos varchar(255),
  email varchar(255) unique not null,
  password varchar(255) not null,
  rol varchar(20),
  imagen varchar(255)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'admin', 'admin', NULL);