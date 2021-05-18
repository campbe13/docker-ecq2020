# script to create and populate a simple db

drop database if exists pets;
create database pets;
use pets;

create table dogs (name varchar(20), breed varchar(25), birth DATE);

#show tables;
#describe dogs;

insert into dogs values ("Mr. Floofy", "Shih Tzu", "2016-05-05") ;
insert into dogs values ("Walter", "Labradoodle", "2014-10-25") ;
insert into dogs values ("Freddy", "Wheaton Terrier & Poodle", "2018-10-31") ;

create table lizards (name varchar(20), type varchar(25), birth DATE);

insert into lizards values ("Slinky", "Rat Snake", "2011-05-05") ;
insert into lizards values ("Sticky", "Geko", "2014-11-05") ;

create table fish (name varchar(20), type varchar(25), species_family varchar(15), quantity SMALLINT );
insert into fish values ("munchy", "Piranha", "Serrasalmidae", 5) ;
insert into fish values ("stripey", "Zebrafisih", "Danio rerio",   20) ;

#select * from dogs;
