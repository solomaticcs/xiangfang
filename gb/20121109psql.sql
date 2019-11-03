create table reply (no int not null,name varchar(10),id varchar(10),content text,time varchar);
insert into reply values ('0','','','','');

create table reply2 (no int not null,no2 int not null,name varchar(10),id varchar(10),content text,time varchar);
insert into reply2 values ('0','0','','','','');

create table member (no int not null,name varchar(10),id varchar(20),pw varchar(20),level varchar(3));

insert into member values ('0','','','','');
insert into member values ('1','DwyaneWade','wade','5678','0');
insert into member values ('2','管理員','admin','123456','1');

create table good (no int not null,no2 int not null,name varchar(10),id varchar(10),good varchar(10),time varchar);

insert into good values ('0','0','','','','');