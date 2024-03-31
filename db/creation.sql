CREATE DATABASE `band_piano` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

create table instruments
(
    inst_id         int auto_increment
        primary key,
    inst_name       varchar(32) not null,
    inst_key_offset int         not null
);

create table users
(
    usr_id       int auto_increment
        primary key,
    usr_name     varchar(32)  not null,
    usr_password varchar(255) not null
);

create table tokens
(
    sn_usr_id int      not null,
    sn_hash   int      not null,
    sn_date   datetime not null,
    constraint tokens_users_usr_id_fk
        foreign key (sn_usr_id) references users (usr_id)
);