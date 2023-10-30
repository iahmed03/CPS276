CREATE TABLE Customers (
 id int NOT NULL AUTO_INCREMENT,
 firstname varchar(50) NOT NULL,
 lastname varchar(50) NULL,
 address varchar(50) NULL,
 state varchar(50) NULL,
 zip varchar(50) NULL,
 phone varchar(50) NOT NULL,
 email varchar(255) NOT NULL,
 password varchar(255) NOT NULL,
 PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE ProductGroup (
 id int NOT NULL AUTO_INCREMENT,
 groupname varchar(50) NOT NULL,
 imagefolder varchar(250) NULL,
 PRIMARY KEY (id)
) ENGINE = InnoDB;

CREATE TABLE Product (
 id int NOT NULL AUTO_INCREMENT,
 groupid int NOT NULL,
 productname varchar(50) NOT NULL,
 productprice varchar(25) NOT NULL,
 image varchar(255) NULL,
 description varchar(2500) NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (groupid) REFERENCES ProductGroup(id)
) ENGINE = InnoDB;

CREATE TABLE Orders (
 id int NOT NULL AUTO_INCREMENT,
 timestamp int NOT NULL,
 customerid int NOT NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (customerid) REFERENCES Customers(id)
) ENGINE = InnoDB;

CREATE TABLE Order_info (
 id int NOT NULL AUTO_INCREMENT,
 orderid int NOT NULL,
 productid int NOT NULL,
 amount int NOT NULL,
 PRIMARY KEY (id),
 FOREIGN KEY (orderid) REFERENCES Orders(id),
 FOREIGN KEY (productid) REFERENCES Product(id)
) ENGINE = InnoDB;


