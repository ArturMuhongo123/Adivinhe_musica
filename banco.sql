CREATE DATABASE IF NOT EXISTS adivinhe_musica;
USE adivinhe_musica;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    pontos INT DEFAULT 0
);
INSERT INTO musicas (titulo, arquivo, nivel, opcao_a, opcao_b, opcao_c, correta)
VALUES 
('Shape of You', 'audios/facil/1.mp3', 'facil', 'Shape of You', 'Perfect', 'Thinking Out Loud', 'A'),
('Lonely', 'audios/facil/2.mp3', 'facil', 'So sick','Lonely', 'Be with you', 'B'),
('Voltei com ela', 'audios/facil/3.mp3', 'facil', 'Voltei com ela', 'Magui', 'Alma Gemêa', 'A'),
('Mo cota', 'audios/medio/1.mp3', 'medio', 'Shape of You', 'Perfect', 'Mo cota', 'C'),
('O que seria de mim', 'audios/facil/2.mp3', 'medio', 'Kimbieta', 'O que seria de mim', 'Urna', 'B'),
('Mulher mata', 'audios/medio/3.mp3', 'medio', 'Mulher mata', 'Imperial', 'Vou bazar', 'A'),
('Angolano Segue Em Frente', 'audios/dificil/1.mp3', 'dificil', 'Angolano Segue Em Frente', 'Sonhador', 'Angolano Batalhador', 'A'),
('Yolanda', 'audios/dificil/2.mp3', 'dificil', 'Moça Linda', 'Yolanda', 'O tempo passa', 'B'),
('Eu vou xinguilar', 'audios/dificil/xinguilar.mp3', 'medio', 'Alambamento', 'Casa do marido', 'Eu vou xinguilar', 'C');
