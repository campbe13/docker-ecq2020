# mysql & docker platform

As with other dbs it is very easy to start up an instance of a mysql database without the need for installing the database itself, no issues with versions and Windows compatibility amongst other things. 


### mysql instance, no Dockerfile, no yaml
* Use this for [demos](MYSQLDEMO.md)
* [running a db from docker hub](MYSQL-INSTANCE.md) runtime output, see also the [launch script](standalone-mysql.sh) and the [sql script](quickdb.sql) to populate the db


## todo example use mysql with volume /logs on local host 
## todo example populate db by copying *.sql or *.sh to `/docker-entrypoint-initdb.d/` 
