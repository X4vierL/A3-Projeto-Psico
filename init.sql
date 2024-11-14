CREATE DATABASE IF NOT EXISTS A3_Psico;
USE A3_Psico;

CREATE TABLE paciente (
    id_paciente INT(4) PRIMARY KEY,
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
    id_prontuario INT PRIMARY KEY,
    data_inicio_atendimentos DATE,
    id_paciente INT(4),
    historico_familiar VARCHAR(255),
    historico_social VARCHAR(255),
    consideracoes_finais VARCHAR(255),
    observacoes VARCHAR(255),
    FOREIGN KEY (id_paciente) REFERENCES paciente(id_paciente)
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

CREATE TABLE usuario (
    id_usuario INT(4) PRIMARY KEY,
    login VARCHAR(100) UNIQUE,
    senha VARCHAR(15),
    nivel_acesso VARCHAR(4)
);
