# script to create and populate a simple db

create database pets;
use pets;

create table dogs (name varchar(20), breed varchar(25), birth DATE);

show tables;
describe dogs;


insert into dogs values ("Mr. Floofy", "Shih Tzu", "2016-05-05") ;
insert into dogs values ("Walter", "Labradoodle", "2014-10-25") ;
insert into dogs values ("Freddy", "Wheaton Terrier & Poodle", "2018-10-31") ;


select * from dogs;
