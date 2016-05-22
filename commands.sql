create database nowall_login;

use nowall_login;

grant all on nowall_login.* to testuser@localhost identified by '9999';

create table users (
  id int primary key auto_increment,
  name varchar(32),
  password varchar(32),
  created_at datetime
);
