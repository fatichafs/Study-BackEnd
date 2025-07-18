https://chatgpt.com/share/6879c41a-12a0-800b-adc9-85e2c48b7337


CREATE DATABASE pincela;
USE pincela;

CREATE TABLE lukisan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    gambar VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
