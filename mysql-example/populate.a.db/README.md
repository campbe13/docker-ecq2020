# run mysql, create & populate a database

You must [install docker-compose](https://docs.docker.com/compose/install/) to use this.

See the [docker-compose.yaml](docker-compose.yaml) it is explained below
## Contents
The sql script used to create and populate the database  is mapped from the host to the container `./dbscript` see Note below

State/database persistent is maintained through a database on the host directory:  
> There is a database directory  `./testdb` (created if it doesn't exist) that is mapped to the container.
### managing the container runtime
* run `docker-compose up` or `docker-compose up -d`
* look at the logs `docker logs`  (will be on screen if -d omitted in up)
* stop `docker stop`

### Bind mapping for the container (host:container)
Host directory | Container directory 
--------------- | -----------------
./dbscript   | /docker-entrypoint-initdb.d
./testdb  | /var/lib/mysql
###  Note
When you run this if the database exsists already it will not run what is in your `/docker-entrypoint-initdb.d/`
this is so it does not clobber what you have created, a safety catch.

So if you are recreating the database or changing the schema, you must delete the contents of the database mapping in `./testdb`
