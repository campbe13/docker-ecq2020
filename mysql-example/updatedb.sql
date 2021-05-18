# script to update the db

use pets;

select * from fish;

# the piranha ate 2 of  their friends
select * from fish where name="munchy";
update fish set quantity=3 where name="munchy";
select * from fish where name="munchy";

# we have a new puppy
insert into dogs values ("Sweetums", "mutt", "2020-10-25") ;
