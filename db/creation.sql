# CREATE DATABASE `band_piano` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

create table instruments
(
    inst_id         int auto_increment
        primary key,
    inst_name       varchar(32) not null,
    inst_key_offset int         not null
);

create table sessions
(
    series_identifier varchar(64) not null,
    session_token     varchar(64) not null,
    username          varchar(32) not null,
    expire            datetime    not null
);

create table users
(
    usr_id       int auto_increment
        primary key,
    usr_name     varchar(32)  not null,
    usr_password varchar(255) not null
);