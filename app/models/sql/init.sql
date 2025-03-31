-- User
-- Post
-- Comment
-- Category
-- drop database BLOG;
create database BLOG;
use BLOG;

CREATE TABLE User (
  ID int NOT NULL AUTO_INCREMENT,

  Name varchar(255) NOT NULL Unique,
  Password varchar(255) NOT NULL,

  CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (ID)
);

CREATE TABLE Post (
  ID int NOT NULL AUTO_INCREMENT,

  Title varchar(255) NOT NULL,
  Slug varchar(512) NOT NULL Unique,

  UserID int NOT NULL,

  CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (ID),
  FOREIGN KEY (UserID) REFERENCES User(ID)
);

CREATE TABLE Comment (
  ID int NOT NULL AUTO_INCREMENT,

  Content text NOT NULL,

  UserID int NOT NULL,
  PostID int NOT NULL,

  CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (ID),
  FOREIGN KEY (UserID) REFERENCES User(ID),
  FOREIGN KEY (PostID) REFERENCES Post(ID)
);

CREATE TABLE Category (
  ID int NOT NULL AUTO_INCREMENT,

  Name varchar(255) NOT NULL,

  CreatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,
  UpdatedAt DATETIME DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (ID)
);

CREATE TABLE CategoryPost (
  CategoryID int NOT NULL,
  PostID int NOT NULL,

  PRIMARY KEY (CategoryID, PostID),
  FOREIGN KEY (CategoryID) REFERENCES Category(ID),
  FOREIGN KEY (PostID) REFERENCES Post(ID)
);

ALTER TABLE Post ADD FULLTEXT (Title);
CREATE INDEX index_post_slug ON Post (Slug);

Insert into category (Name) values ('AWS'), ('Javascript'), ('Design Pattern');
