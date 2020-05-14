create database memo_laravel character set utf8;

use memo_laravel

create table memo (
  id int NOT NULL auto_increment primary key,
  indexNumber int,
  title varchar(255),
  memo varchar(1000),
  backgroundColor varchar(255),
  isArchive boolean NOT NULL default "0",
  label varchar(255)
);


create table label (
  id int not null auto_increment primary key,
  label varchar(255) NOT NULL
);
