create database memo_laravel character set utf8;;

use memo_laravel

create table memo (
  id int not null auto_increment primary key,
  title varchar(255),
  memo varchar(255),
  backgroundColor varchar(255)
  isArchive boolean
);


ALTER TABLE memo
ADD isArchive boolean NOT NULL;
