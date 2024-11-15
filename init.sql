CREATE DATABASE IF NOT EXISTS A3_Psico;
USE A3_Psico;

CREATE TABLE usuario (
    id_usuario INT(4) AUTO_INCREMENT PRIMARY KEY,
    nome varchar (255),
    login VARCHAR(100) UNIQUE,
    senha VARCHAR(15),
    nivel VARCHAR(4)
);

CREATE TABLE paciente (
    id_paciente INT(4) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    genero VARCHAR(5),
    data_nascimento DATE,
    contato VARCHAR(15),
    contato_emergencia VARCHAR(15),
    email VARCHAR(50),
    endereco VARCHAR(100),
    escolaridade VARCHAR(20),
    ocupacao VARCHAR(25),
    necessidade_especial VARCHAR(9),
    estagiario_responsavel INT(4),
    orientador_responsavel INT(4),
    FOREIGN KEY (estagiario_responsavel) REFERENCES usuario(id_usuario),
    FOREIGN KEY (orientador_responsavel) REFERENCES usuario(id_usuario)
);

CREATE TABLE prontuario (
    id_prontuario INT AUTO_INCREMENT PRIMARY KEY,
    data_abertura DATE,
    nome_completo VARCHAR(100),
    data_nascimento DATE,
    genero ENUM('M', 'F', 'Outro'),
    endereco VARCHAR(255),
    telefone VARCHAR(20),
    email VARCHAR(100),
    contato_emergencia VARCHAR(255),
    escolaridade VARCHAR(50),
    ocupacao VARCHAR(100),
    necessidade_especial VARCHAR(50),
    estagiario_responsavel VARCHAR(100),
    orientador_responsavel VARCHAR(100)
);


CREATE TABLE sessao (
    id_sessao INT(4) PRIMARY KEY,
    id_prontuario INT,
    data_sessao DATE,
    numero_sessao INT(3),
    descricao_atividades VARCHAR(255),
    observacao VARCHAR(255),
    FOREIGN KEY (id_prontuario) REFERENCES prontuario(id_prontuario)
);


