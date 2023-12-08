CREATE TABLE Admins (
 id int NOT NULL AUTO_INCREMENT,
 name varchar(25) NOT NULL,
 email varchar(50) NOT NULL,
 password varchar(500) NOT NULL,
 status varchar(25) NOT NULL,
 PRIMARY KEY (id)
) ENGINE = InnoDB;