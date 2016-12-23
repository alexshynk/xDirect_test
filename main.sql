set names utf8;

drop table if exists xdirect_contacts;
create table xdirect_contacts(
	id int auto_increment primary key,
	date_reg timestamp,
	name varchar(20),
	surname varchar(20),
	phone varchar(15),
	email varchar(50)
);