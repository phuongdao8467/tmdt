DROP Database if exists smartfood ;
CREATE DATABASE IF NOT EXISTS smartfood CHARACTER SET utf8mb4;
USE smartfood;
-- create table
CREATE Table user(
	user_id int not null AUTO_INCREMENT,
	name varchar(50),
	email varchar(50),
	passhash varchar(50),
	phonenumber varchar(10),
	gender int,
	role1 int,
	primary key(user_id )
	
);
create table food(
	food_id int not null AUTO_INCREMENT,
	image varchar(50),
	name varchar(50),
	description varchar(200),
	price int,
	status bool,
	primary key(food_id)
);
create table coupon(
	coupon_id varchar(50) not null unique,
	start1 datetime,
	end1 datetime,
	value int,
	primary key(coupon_id) 
);
Drop table if exists usercoupon;
create table usercoupon(
	id int not null auto_increment,
	user_id int,
	coupon_id varchar(50),
	num int,
	primary key(id),
	Foreign key (user_id) references user(user_id) on delete set null,
	Foreign key (coupon_id) references coupon(coupon_id) on delete set null
);
Drop table if exists orderlist;
create table orderlist(
	orderlist_id int not null AUTO_INCREMENT,
	user_id int,
	food_id int,
	num int,
	time1 datetime,
	status2 int,
	bill_id int,
	name_order varchar(50) NOT NULL,
  	phone varchar(10) NOT NULL,
  	adress text NOT NULL
	primary key(orderlist_id),
	Foreign key (user_id) references user(user_id) on DELETE set NULL,
	Foreign key (food_id) references food(food_id) on DELETE CASCADE
);

Drop table if exists bill;
create table bill(
	bill_id int not null,
	coupon_id varchar(50),
	value int,
	status int,
	primary key(bill_id)
);
Drop table if exists orderlist;
create table orderlist(
	orderlist_id int not null AUTO_INCREMENT,
	user_id int,
	food_id int,
	num int,
	time1 datetime,
	status2 int,
	bill_id int,
	primary key(orderlist_id),
	Foreign key (user_id) references user(user_id) on DELETE set NULL,
	Foreign key (food_id) references food(food_id) on DELETE CASCADE
);



Drop table if exists sessionlogin;
create table sessionlogin(
	session_id int not null AUTO_INCREMENT,
	user_id int,
	value varchar(50),
	primary key(session_id),
	Foreign key (user_id) references user(user_id) on DELETE set NULL
);

-- Create fuction

-- user
Drop procedure if Exists addUser;
DELIMITER $$

Create procedure addUser(
	name1 varchar(50),
	email1 varchar(50),
	passhash1 varchar(50),
	phonenumber1 varchar(10),
	gender1 int,
	role11 int
)
begin
	if(exists(select * from user where email=email1))then
		select -1;
	else
		INSERT into user(name, email, passhash, phonenumber, gender, role1)
		values
		(name1,email1,passhash1,phonenumber1,gender1,role11);
		select user_id from user where email=email1;
	end if;
end; $$
DELIMITER ;
call addUser('add','adadd','add','1234',0,1);

Drop procedure if Exists modifyUser;
Delimiter $$
Create procedure modifyUser(
	user_id1 int,
	name1 varchar(50),
	email1 varchar(50),
	passhash1 varchar(50),
	phonenumber1 varchar(10),
	gender1 int,
	role11 int
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	else
		update user
		set name=name1, email=email1, passhash=passhash1, phonenumber=phonenumber1, gender=gender1, role1=role11
		where user_id=user_id1;
		select 1;
	end if;
end; $$
DELIMITER ;

Drop procedure if Exists deleteUser;
Delimiter $$
Create procedure deleteUser(
	user_id1 int
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	else
		delete from user where user_id=user_id1;
		select 1;
	end if;
end; $$
DELIMITER ;

Drop procedure if Exists getInfo;
Delimiter $$
Create procedure getInfo(
	user_id1 int
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	else
		select name, email, phonenumber, gender, role1 from user where user_id=user_id1;
	end if;
end; $$
DELIMITER ;

Drop procedure if Exists changePassword;
Delimiter $$
Create procedure changePassword(
	user_id1 int,
	currentpass varchar(50),
	newpass varchar(50)
)
begin
	if(!exists(select * from user where user_id=user_id1 and passhash=currentpass))then
		select -1;
	else
		Update user set passhash= currentpass where user_id =user_id1;
		select 1;
	end if;
end; $$
DELIMITER ;

Drop procedure if Exists addCoupon;
Delimiter $$
Create procedure addCoupon(
	coupon_id1 varchar(50),
	start datetime,
	end datetime,
	value int
)
begin
	if(exists(select * from coupon where coupon_id=coupon_id1))then
		select -1;
	else
		INSERT into coupon(coupon_id ,start1 ,end1 ,value )
		values
		(coupon_id1, start,end,value );
		select 1;
	end if;
end;  $$
DELIMITER ;
call addcoupon("QN-05","2011-12-18 13:17:17","2011-12-19 13:17:17",10000);

Drop procedure if Exists modifyCoupon;
Delimiter $$
Create procedure modifyCoupon(
	coupon_id1 varchar(50),
	start datetime,
	end datetime,
	value1 int
)
begin
	if(!exists(select * from coupon where coupon_id=coupon_id1))then
		select -1;
	else
		Update coupon
		set start1=start, end1=end, value=value1 where coupon_id=coupon_id1;
		select 1;
	end if;
end;  $$ 
DELIMITER ;
call modifycoupon("QN-04","2011-12-18 13:17:17","2011-12-19 13:17:17",15000);

Drop procedure if Exists deleteCoupon;
Delimiter $$
Create procedure deleteCoupon(
	coupon_id1 varchar(50)
)
begin
	if(!exists(select * from coupon where coupon_id=coupon_id1))then
		select -1;
	else
		delete from coupon where coupon_id =coupon_id1;
		select 1;
	end if;
end;  $$
DELIMITER ;
call deleteCoupon("QN-05");

Drop procedure if Exists showcouponUser;
Delimiter $$
Create procedure showcouponUser(
	user_id1 int
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	else
		select * from coupon where coupon_id in (select coupon_id from usercoupon where user_id =user_id1);
	end if;
end;  $$
DELIMITER ;





DROP procedure if exists addfood;
DELIMITER $$

CREATE procedure addfood(
	in image1 varchar(50),
	in name1 varchar(50),
	in description1 varchar(200),
	in price1 int
)
begin
	if(exists(SELECT * from food where name=name1)) THEN
		SELECT -1;
	else
	 INSERT into food(image,name,description ,price ,status )
	 values
	 (image1, name1, description1, price1, true );
	SELECT food_id FROM food where name=name1;
	end if;
end;
$$
DELIMITER ;
call addfood('112','test','Ngon', 123);
Drop procedure if exists setfood;
DELIMITER $$
CREATE procedure setfood(food_id1 int,status1 int)
begin
	if(!exists(SELECT * FROM food where food_id=food_id1)) THEN
		SELECT -1;
	end if;
	update food set status =status1 where food_id=food_id1;
	SELECT 1;
end; $$
DELIMITER ;

CALL setfood(5,true);

Drop procedure if exists modifyFood;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`modifyFood`(
	food_id1 int,
	in name1 varchar(50),
	in image1 varchar(50),
	in description1 varchar(200),
	in price1 int
)
begin
	if(!exists(select * from food where food_id =food_id1))then
		select -1;
	else
		Update food
		set image =image1,name=name1, price =price1, description =description1 where food_id =food_id1 ;
		select 1;
	end if;
end
$$
DELIMITER ;

Drop procedure if exists deletefood;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`deletefood`(
	food_id1 int
)
begin
	if(!exists(SELECT * from food where food_id =food_id1)) THEN
		SELECT -1;
	else
	 	delete from food where food_id =food_id1;
		SELECT 1;
	end if;
end
$$
DELIMITER ;

Drop procedure if exists getFood;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`getFood`(
)
begin
	select * from food ;
end
$$
Delimiter ;

Drop procedure if exists modifyOrder;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`modifyOrder`(
	orderlist_id1 int,
	user_id1 int,
	food_id1 int,
	num1 	int,
	time	datetime,
	status1 int
)
begin
		if(!exists(select * from food where food_id=food_id1))then
			select -1;
		elseif(!exists(select * from user where user_id=user_id1))then
			select -1;
		elseif(!exists(select * from orderlist where orderlist_id =orderlist_id1))then
			select -1;
		else
			Update orderlist 
			set food_id =food_id1,num=num1, time1 =time, user_id =user_id1, status2= status1 where  orderlist_id =orderlist_id1;
			select 1;
	end if;
	end
$$
DELIMITER ;

Drop procedure if exists addOrder;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`addOrder`(
	user_id1 int,
	food_id1 int,
	num1 	int,
	time	datetime,
	status1 int
)
begin
		if(!exists(select * from food where food_id=food_id1))then
			select -1;
		elseif(!exists(select * from user where user_id=user_id1))then
			select -1;
		else
			if(exists(SELECT * from orderlist where food_id=food_id1 and user_id=user_id1 and status2=1))THEN 
				UPDATE orderlist set num=num+num1,time1=time where food_id=food_id1 and user_id=user_id1 and status2=0;
			else
			INSERT into orderlist (user_id ,food_id ,num ,time1,status2 )
			values
			(user_id1,food_id1,num1,time,status1);
			select orderlist_id from orderlist where user_id=user_id1 and food_id=food_id1 and num =num1 and time1=time;
			end if;
	end if;
	end
	$$
Delimiter ;

Drop procedure if exists deleteOrder;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`deleteOrder`(
	orderlist_id1 int
)
begin
	if (!exists(select * from orderlist where orderlist_id =orderlist_id1))then
		select -1;
	else
		delete from orderlist where orderlist_id =orderlist_id1;
			select 1;
	end if;
	end
	$$
Delimiter ;

Drop procedure if exists showOrderUser;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`showOrderUser`(
	user_id1 int
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	else
		select * from orderlist where orderlist_id in (select orderlist_id from orderlist where user_id =user_id1);
	end if;
end
	$$
Delimiter ;

Drop procedure if exists addSession;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`addSession`(
	user_id1 int,
	value1 varchar(50)
)
begin
	if(!exists(select * from user where user_id=user_id1))then
		select -1;
	elseif(exists(select * from sessionlogin where user_id=user_id1)) then
		delete from sessionlogin where user_id =user_id1;
		INSERT into sessionlogin(user_id,value )
		values
		(user_id1,value1);
		select 1;
	else
		INSERT into sessionlogin(user_id,value)
		values
		(user_id1,value1);
		select 1;
	end if;
end
	$$
Delimiter ;

Drop procedure if exists getUser_id;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`getUser_id`(
	value1 varchar(50)
)
begin
	if(!exists(select * from sessionlogin where value =value1))then
		select -1;
	else 
		SELECT user_id from sessionlogin where value =value1 LIMIT 1;
	end if;
end
	$$
Delimiter ;

Drop procedure if exists addCouponUser;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`addCouponUser`(
	user_id int,
	coupon_id varchar(50),
	num int
)
begin
	if(!exists(select * from coupon where coupon.coupon_id=coupon_id))then
		select -1;
	elseif(!exists(select * from user where user.user_id=user_id)) THEN 
		select -1;
	else 
		INSERT into usercoupon (user_id1 ,coupon_id1,num1 ) 
		values
		(user_id,coupon_id,num);
		select 1;
	end if;
end
	$$
Delimiter ;
call addUser('Nguyễn Minh Quang','132342','123','123',1,2);
call addUser('admin','admin','admin','admin',1,4);
select * from user;
call getInfo(17);

select * from user where email='123' and passhash ='1234';


Drop procedure if exists getRole;
DELIMITER $$
create procedure getRole(
	user_id1 int
)
begin
	if(!exists(SELECT *from user where user_id =user_id1)) THEN
		SELECT -1;
	else
		SELECT role1 from user where user_id =user_id1;
	end if;
end;	$$
DELIMITER ;

Drop procedure if exists addCouponUser;
DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `smartfood`.`addCouponUser`(
	user_id int,
	coupon_id varchar(50),
	num int
)
begin
	if(!exists(select * from coupon where coupon.coupon_id=coupon_id))then
		select -1;
	elseif(!exists(select * from user where user.user_id=user_id)) THEN 
		select -1;
	elseif(exists(select * from usercoupon where usercoupon.user_id=user_id and usercoupon.coupon_id=coupon_id))THEN 
		UPDATE usercoupon set usercoupon.num=usercoupon.num+num where usercoupon.user_id=user_id and usercoupon.coupon_id=coupon_id;
	else
		INSERT into usercoupon (user_id ,coupon_id,num ) 
		values
		(user_id,coupon_id,num);
		select 1;
	end if;
end
	$$
Delimiter ;	

Select * from coupon;
Select * from usercoupon;
INSERT INto coupon(coupon_id ,start1 ,end1 ,value ) values('ad-123','2019-12-30 00:00:00','2019-12-30 00:00:00',20000);
call addCouponUser(3,'ad-123',4);


