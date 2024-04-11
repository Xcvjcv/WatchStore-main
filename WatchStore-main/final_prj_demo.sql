create schema final_project;
use final_project;
create table tbl_user (
	user_id int(11) primary key auto_increment,
    username varchar(50) not null,
    user_pass varchar(100) not null,
    email varchar(50) not null unique key,
    full_name varchar(100),
    is_accessible int default 1
);

create table tbl_category (
	cate_id int(11) primary key auto_increment,
    cate_name varchar(255),
    gender varchar(10)
);


create table tbl_product (
     prd_id int primary key auto_increment,
     prd_name varchar(50),
     prd_type varchar(50),
     img varchar(50),
     brand_id int(11),
     price varchar(50),
     for_who varchar(50),
     foreign key(brand_id) references tbl_category(cate_id)
);
    
insert into tbl_category(cate_name,gender)
values
('Longines','Nam'),
('Longines','Nu'),
('Casio','Nam'),
('Casio','Nu'),
('Mido','Nam'),
('Mido','Nu'),	
('Edox','Nam'),
('Edox','Nu'),
('Seiko','Nam'),
('Seiko','Nu');

insert into tbl_product(
	 prd_name,
     prd_type,
     img,
     brand_id,
     price,
     for_who)
values("longines","Chạy cơ","ADD.jpg",1,"1.000.000VND","Nam");
