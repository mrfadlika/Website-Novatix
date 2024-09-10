CREATE DATABASE realDataBaseNovatix;

USE realDataBaseNovatix;

CREATE TABLE users (
    id int auto_increment primary key,
    nama varchar(255),
    email varchar(255),
    nomor_hp varchar(20),
    tanggal_lahir DATE,
    nim varchar(8),
    password varchar(255),
    created_at datetime default current_timestamp,
    foto_profil varchar(255)
);

CREATE TABLE materi (
    id int auto_increment primary key,
    judul varchar(255),
    matkul varchar(255),
    deskripsi varchar(1000),
    file_path varchar(255),
    created_at datetime default current_timestamp,
    user_id varchar(255)
);

CREATE TABLE mailing (
    id int auto_increment primary key,
    send_from varchar(255),
    send_to varchar(255),
    subyek varchar(255),
    isi_pesan varchar(1000),
    file_path varchar(255),
    tanggal_kirim datetime default current_timestamp
);

CREATE TABLE info (
    id int auto_increment primary key,
    nama varchar(255),
    posisi varchar(255),
    role varchar(255),
    nomor_hp varchar(20)
);

CREATE TABLE pengampu (
    id int auto_increment primary key,
    mata_kuliah varchar(255),
    penanggung_jawab varchar(255)
);


CREATE TABLE tugas (
    id int auto_increment primary key,
    nama_tugas varchar(255),
    mata_kuliah varchar(255),
    dosen_pengampu varchar(255),
    deadline date not null,
    deskripsi varchar(1000),
    status varchar(1),
);

CREATE TABLE events (
    id int auto_increment primary key,
    title varchar(255),
    start date,
    end date
);

CREATE TABLE schedules (
    id int auto_increment primary key,
    day varchar(255),
    subject varchar(255),
    activity varchar(255)
);

INSERT INTO schedules (day, subject, activity) 
VALUES ('Monday', '07:30-12:00', 'Grafika Komputer'), 
('Monday', '13:00-14:40', 'Komunikasi Data Multimedia'), 
('Tuesday', '07:30-12:00','Prak Desain Web'), 
('Wednesday','07:30-12:00','Prak Basis Data Multimedia'), 
('Thursday','07:30-12:00','Prak Pemrograman Berorientasi Objek'), 
('Thursday','13:00-17:40','Prak Desain dan Pengembangan Multimedia'), 
('Thursday','17:40-19:50','Matematika Diskrit'), 
('Friday','13:00-17:40','Prak Administrasi Jaringan');

CREATE TABLE pengumuman (
    id int auto_increment primary key,
    judul varchar(255),
    konten varchar(1000),
    file_path varchar(255),
    created_at datetime default current_timestamp
);

INSERT INTO info (nama, posisi, role, nomor hp)
VALUES ("Andi Gunawan", "Dosen Pemrograman", "dosen, 82133029285"), 
("Dra. Nurmiani", "Dosen Bahasa Indonesia", "dosen", "81242681092"), 
("Dr. Alimin", "Dosen Bahasa Inggris", "dosen", "85222078287"), 
("Achmad Zulfajri", "Dosen Multimedia", "dosen", "82210514412"), 
("Ainun Jariyah", "Dosen Jaringan", "dosen", "81330066003"), 
("Alvian Bastian", "Dosen Pemrograman", "dosen", "85956193100"), 
("Irvan Muzakkir", "Dosen Pemrograman", "dosen", "85299918182"), 
("Murniati", "Teknisi Lab TMJ", "staff", "81343524552"), 
("Ilyas Syarif", "Dosen Informatika", "dosen", "81342947996"), 
("Andi Hamdianah", "Dosen Multimedia", "dosen", "87788122090"),
("Muh Irsan S", "Dosen Pemrograman", "dosen", "85229414818"),
("Murniati", "Staff Jurusan TIK", "staff", "85240971919"), 
("Nur Ichsan AS", "Dosen Matematika", "dosen", "85299695345");