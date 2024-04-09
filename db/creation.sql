CREATE DATABASE `band_piano` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

create table band_piano.instruments
(
    inst_id         int auto_increment
        primary key,
    inst_name       varchar(32) not null,
    inst_key_offset int         not null
);

create table band_piano.notes
(
    note int not null
);

create table band_piano.sessions
(
    sn_username          varchar(32)  not null,
    sn_series_identifier varchar(64)  not null,
    sn_session_token     varchar(64)  not null,
    sn_expire            int unsigned not null
);

create table band_piano.users
(
    usr_id       int auto_increment
        primary key,
    usr_name     varchar(32)  not null,
    usr_password varchar(256) not null
);

