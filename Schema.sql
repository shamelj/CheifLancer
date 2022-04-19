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
