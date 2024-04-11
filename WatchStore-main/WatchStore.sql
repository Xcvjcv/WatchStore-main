drop schema if exists db_asm;
create schema db_asm;

create table tbl_user (
      user_id int(11) primary key auto_increment,
      username varchar(50) not null,
      user_pass varchar(100) not null,
      email varchar(50) not null unique key,
      full_name varchar(100),
--     customer_address varchar(255),
--     customer_phone int(10) unique key,
--     customer_email varchar(50) unique key,
--     customer_message text,
      is_accessible int default 1
);

create table tbl_product (
  prd_id int primary key auto_increment,
  prd_name varchar(50),
  prd_type varchar(50),
  img varchar(50),
  brand varchar(50),
  price varchar(50),
  for_who varchar(50),
  foreign key(cate_id) references tbl_category(cate_id)
);


