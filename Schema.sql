CREATE TABLE `user`(
    username varchar(255) primary key,
    pass varchar(18),
    email varchar(255),
    first_name varchar(50),
    last_name varchar(50),
    phone_number char(10),
    profile_img varchar(255));

CREATE TABLE cook(
    username varchar(255) primary key,
    location ENUM('Qalqilya', 'Ramallah','Nablus','Hebron','Jenin','Salfit','Betlehem','Jerusalem','Tulkarm','Jericho')
    );

CREATE TABLE customer(
    username varchar(255) primary key
    );

alter TABLE cook add CONSTRAINT fk_cook_user FOREIGN KEY (username) REFERENCES user(username); 

alter TABLE customer add CONSTRAINT fk_customer_user FOREIGN KEY (username) REFERENCES user(username); 

CREATE TABLE follows(
    follower_username varchar(255),
    followed_username varchar(255),
    PRIMARY KEY(follower_username,followed_username),
    FOREIGN KEY(follower_username) REFERENCES customer(username),
    FOREIGN KEY(followed_username) REFERENCES cook(username)
    );


CREATE TABLE message(
    cook_username varchar(255) not null,
    customer_username varchar(255) not null,
    sender ENUM('cook','customer'),
    content varchar(255),
    send_date datetime,
    PRIMARY KEY(send_date),
    FOREIGN KEY(customer_username) REFERENCES customer(username),
    FOREIGN KEY(cook_username) REFERENCES cook(username)
    );

CREATE TABLE tag(
    name varchar(20) primary key ,
    description text
    );

CREATE TABLE meal (
    name varchar(50),
    cook_username varchar(255),
    price numeric(5,2),
    waiting_time time,
    PRIMARY KEY(name,cook_username),
    FOREIGN KEY(cook_username) REFERENCES cook(username)
    );
    
CREATE TABLE meal_rating (
    meal_name varchar(50),
    cook_username varchar(255),
    customer_username varchar(255),
    rating numeric(1,0),
    PRIMARY KEY(meal_name,cook_username,customer_username),
    FOREIGN KEY(meal_name,cook_username) REFERENCES meal(name,cook_username),
    CONSTRAINT meal_rating_range CHECK (rating >=0 and rating <=5)
    );
    
CREATE TABLE `order` (
    order_date datetime,
    cook_username varchar(255),
    customer_username varchar(255),
    meal_name varchar(50),
	delivery_date datetime,
    PRIMARY KEY(meal_name,cook_username,customer_username,order_date),
    FOREIGN KEY(meal_name,cook_username) REFERENCES meal(name,cook_username),
    FOREIGN KEY(customer_username) REFERENCES customer(username)
    );

CREATE TABLE meal_tag (
    cook_username varchar(255),
    meal_name varchar(50),
    tag_name varchar(20),
    PRIMARY KEY(meal_name,cook_username,tag_name),
    FOREIGN KEY(meal_name,cook_username) REFERENCES meal(name,cook_username),
    FOREIGN KEY(tag_name) REFERENCES tag(name)
    );

CREATE table meal_picture(
    cook_username varchar(255),
    meal_name varchar(50),
    pic_no numeric(1,0),
    pic_path varchar(255),
    primary key(cook_username, meal_name,pic_no),
    FOREIGN key (cook_username, meal_name) REFERENCES meal(cook_username,name)
    );

ALTER TABLE meal
ADD COLUMN description varchar(65535);

DELIMITER &&  
CREATE PROCEDURE insert_customer ( in username varchar(255),
    in pass varchar(18),
    in email varchar(255),
    in first_name varchar(50),
    in last_name varchar(50),
    in phone_number char(10),
    in profile_img varchar(255))  
BEGIN  
    insert into user values (username,pass,email,first_name,last_name,phone_number,profile_img);  
    insert into customer values (username);   
END &&  
DELIMITER ;

DELIMITER &&  
CREATE PROCEDURE insert_cook ( in username varchar(255),
    in pass varchar(18),
    in email varchar(255),
    in first_name varchar(50),
    in last_name varchar(50),
    in phone_number char(10),
    in profile_img varchar(255),
    in location varchar(255))                           
BEGIN  
    insert into user values (username,pass,email,first_name,last_name,phone_number,profile_img);  
    insert into cook values (username,location);   
END &&  
DELIMITER ;  

DELIMITER &&  
CREATE PROCEDURE delete_user ( in uname varchar(255))                           
BEGIN  
    delete from cook where username = uname; 
    delete from customer where username = uname; 
    delete from user where username = uname; 
END &&  
DELIMITER ;  


DELIMITER &&  
CREATE PROCEDURE update_picture ( in uname varchar(255),in picture varchar(255) )                           
BEGIN  
    update user set profile_img = picture where username = uname;
END &&  
DELIMITER ;  

DELIMITER &&  
CREATE PROCEDURE get_users ()                           
BEGIN  
select * from user;
END &&  
DELIMITER ; 

DELIMITER &&  
CREATE PROCEDURE insert_meal (
    in name varchar(50),
    in cook_username varchar(255),
    in price numeric(5,2),
    in waiting_time time,
    in description varchar(65535))                           
BEGIN  
insert into meal values(name,cook_username,price,waiting_time,description);
END &&  
DELIMITER ; 


DELIMITER &&  
CREATE PROCEDURE get_recommended_meals_for(in uname varchar(255))                           
BEGIN  
with followed_cooks as (select followed_username as username
	      				from follows
      					where follower_username=uname)
(select *
from meal
where meal.cook_username in (select * from followed_cooks)
limit 15)
UNION
(select *
from meal
where meal.cook_username not in (select * from followed_cooks)
limit 5)
;END &&  
DELIMITER ; 

DELIMITER &&  
CREATE PROCEDURE get_meal_pictures(in uname varchar(255), in mname varchar(255))                           
BEGIN  

select pic_path
from meal natural join meal_picture
where cook_username=uname and meal_name=mname

;END &&  `user`
DELIMITER ; 


DELIMITER &&  
CREATE PROCEDURE update_user ( in _username varchar(255),
    in _pass varchar(18),
    in _email varchar(255),
    in _first_name varchar(50),
    in _last_name varchar(50),
    in _phone_number char(10),
    in _profile_img varchar(255))                           
BEGIN  
    update user set  pass = _pass,
        email = _email,
        first_name = _first_name,
        last_name = _last_name,
        phone_number = _phone_number,
        profile_img = _profile_img 
        where username = _username;
END &&  
DELIMITER ; 


DELIMITER &&  
CREATE PROCEDURE get_cook_meals(in cname varchar(255))                           
BEGIN  
	select * 
	from meal
    where cook_username = cname
;END &&  
DELIMITER ; 