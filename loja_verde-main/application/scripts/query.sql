CREATE DATABASE lojaverde;

CREATE TABLE lojaverde.usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    telefone VARCHAR(15),
    email VARCHAR(255),
    genero VARCHAR(10),
    maior BOOLEAN
);
CREATE TABLE produtos (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    marca VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL
);
