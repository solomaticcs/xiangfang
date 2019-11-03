create table product (pid int not null,tid int not null,pmodel varchar(10),size varchar(30),weight double precision,price int not null,imgurl varchar,click int not null);
insert into product values ('1','2','D9006','長46x寬35.5x高25.5(公分)','5.9','2500','1.jpg','0');
insert into product values ('2','2','D9009','長37x寬23x高65(公分)','8','4200','2.jpg','0');
insert into product values ('3','2','D9013','長32x寬21x高44.5(公分)','5.3','2300','3.jpg','0');
insert into product values ('4','1','D2816','長23.5x寬17x高19(公分)','1.07','550','4.jpg','0');
insert into product values ('5','1','D2960M','長27x寬18x高19.5(公分)','1.6','700','5.jpg','0');
insert into product values ('6','1','D2651K','長33x寬20x高27(公分)','2.4','1250','6.jpg','0');
insert into product values ('7','1','D2680','長33.2x寬17.5x高26(公分)','2.33','1250','7.jpg','0');
insert into product values ('8','1','FB2655K','長33x寬17.5x高26.5(公分)','2.85','1200','8.jpg','0');
insert into product values ('9','1','D2890','長36.5x寬22x高27(公分)','2.9','1250','9.jpg','0');
insert into product values ('10','1','D2665','長38x寬25x高30(公分)','8.8','1700','10.jpg','0');
insert into product values ('11','1','D2892','長36x寬22x高35(公分)','3.6','1500','11.jpg','0');

create table product_type (tid int not null,tname varchar(10));
insert into product_type values ('1','手提箱');
insert into product_type values ('2','拉桿箱');

create table product_member (uno int not null,uid varchar(20),upw varchar,uname varchar(5),uemail varchar(30),utelphone varchar(20),uaddr varchar(50),ulevel varchar(10));
insert into product_member values ('0','0','0','0','0','0','0','0');

create table product_order (oid int not null,uid varchar(20) not null,pid int not null,pprice int not null,pnum int not null,psum int not null);
insert into product_order values ('0','0','0','0','0','0');