# demo create a db container

1. [run](#run) `docker run --name mysql-container -d -e MYSQL_DATABASE=mydb -e MYSQL_ROOT_PASSWORD=secret-password -e MYSQL_USER=dbuser -e MYSQL_PASSWORD=secret -p 3306:3306 mysql:latest`
   see [docker run](https://docs.docker.com/engine/reference/commandline/run/)
2. [see the process](#ps) `docker ps` and `sudo netstat -plan4 `  
   see [docker ps](https://docs.docker.com/engine/reference/commandline/ps/)
4. [watch logs](#logs) `docker logs mysql-container -f `  (the -f is like tail -f, to stdout & stderr continuously)  
   see [docker logs](https://docs.docker.com/engine/reference/commandline/logs/)
5. [access](#access) `mysql -u root -p -h 127.0.0.1`
## <a name="run">run the db container</a>
```
tricia@teacher:~$ docker run --name mysql-container -d -e MYSQL_DATABASE=mydb -e MYSQL_ROOT_PASSWORD=secret-password -e MYSQL_USER=dbuser -e MYSQL_PASSWORD=secret -p 3306:3306 mysql:latest
Unable to find image 'mysql:latest' locally
latest: Pulling from library/mysql
69692152171a: Already exists
1651b0be3df3: Pull complete
951da7386bc8: Pull complete
0f86c95aa242: Pull complete
37ba2d8bd4fe: Pull complete
6d278bb05e94: Pull complete
497efbd93a3e: Pull complete
f7fddf10c2c2: Pull complete
16415d159dfb: Pull complete
0e530ffc6b73: Pull complete
b0a4a1a77178: Pull complete
cd90f92aa9ef: Pull complete
Digest: sha256:d50098d7fcb25b1fcb24e2d3247cae3fc55815d64fec640dc395840f8fa80969
Status: Downloaded newer image for mysql:latest
c8fd508b4719e53ff1c895348b0eba6ab1d258eb91c6bf7b0439171169d4f613
```
## <a name="ps">show the docker process </a>
```
tricia@teacher:~$ docker ps
CONTAINER ID   IMAGE                          COMMAND                  CREATED         STATUS         PORTS                               NAMES
c8fd508b4719   mysql:latest                   "docker-entrypoint.s…"   3 minutes ago   Up 2 minutes   0.0.0.0:3306->3306/tcp, 33060/tcp   mysql-container
```
the service is bound via docker-proxy
```
tricia@teacher:~$ sudo netstat -plan4
[sudo] password for tricia:
Active Internet connections (servers and established)
Proto Recv-Q Send-Q Local Address           Foreign Address         State       PID/Program name
tcp        0      0 0.0.0.0:8700            0.0.0.0:*               LISTEN      44586/docker-proxy
tcp        0      0 0.0.0.0:8701            0.0.0.0:*               LISTEN      44710/docker-proxy
tcp        0      0 127.0.0.1:32861         0.0.0.0:*               LISTEN      957/containerd
tcp        0      0 0.0.0.0:3306            0.0.0.0:*               LISTEN      69096/docker-proxy
```
## <a name="logs">watch the logs</a>, there is a slight delay for access in mysql startup
```
tricia@teacher:~$ docker logs mysql-container -f
2021-05-18 18:17:43+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.25-1debian10 started.
2021-05-18 18:17:43+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
2021-05-18 18:17:43+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.25-1debian10 started.
2021-05-18 18:17:43+00:00 [Note] [Entrypoint]: Initializing database files
2021-05-18T18:17:43.682976Z 0 [System] [MY-013169] [Server] /usr/sbin/mysqld (mysqld 8.0.25) initializing of server in progress as process 42
2021-05-18T18:17:43.690468Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2021-05-18T18:17:44.191949Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2021-05-18T18:17:45.759542Z 6 [Warning] [MY-010453] [Server] root@localhost is created with an empty password ! Please consider switching off the --initialize-insecure option.
2021-05-18 18:17:52+00:00 [Note] [Entrypoint]: Database files initialized
2021-05-18 18:17:52+00:00 [Note] [Entrypoint]: Starting temporary server
2021-05-18T18:17:52.751533Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.25) starting as process 87
2021-05-18T18:17:52.775860Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2021-05-18T18:17:53.126149Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2021-05-18T18:17:53.306598Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: /var/run/mysqld/mysqlx.sock
2021-05-18T18:17:53.599248Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2021-05-18T18:17:53.599481Z 0 [System] [MY-013602] [Server] Channel mysql_main configured to support TLS. Encrypted connections are now supported for this channel.
2021-05-18T18:17:53.603969Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2021-05-18T18:17:53.631672Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.25'  socket: '/var/run/mysqld/mysqld.sock'  port: 0  MySQL Community Server - GPL.
2021-05-18 18:17:53+00:00 [Note] [Entrypoint]: Temporary server started.
Warning: Unable to load '/usr/share/zoneinfo/iso3166.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone1970.tab' as time zone. Skipping it.
2021-05-18 18:17:57+00:00 [Note] [Entrypoint]: Creating database mydb
2021-05-18 18:17:57+00:00 [Note] [Entrypoint]: Creating user dbuser
2021-05-18 18:17:57+00:00 [Note] [Entrypoint]: Giving user dbuser access to schema mydb

2021-05-18 18:17:57+00:00 [Note] [Entrypoint]: Stopping temporary server
2021-05-18T18:17:57.584870Z 13 [System] [MY-013172] [Server] Received SHUTDOWN from user root. Shutting down mysqld (Version: 8.0.25).
2021-05-18T18:18:00.184772Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.25)  MySQL Community Server - GPL.
2021-05-18 18:18:00+00:00 [Note] [Entrypoint]: Temporary server stopped

2021-05-18 18:18:00+00:00 [Note] [Entrypoint]: MySQL init process done. Ready for start up.

2021-05-18T18:18:00.889201Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.25) starting as process 1
2021-05-18T18:18:00.900914Z 1 [System] [MY-013576] [InnoDB] InnoDB initialization has started.
2021-05-18T18:18:01.147899Z 1 [System] [MY-013577] [InnoDB] InnoDB initialization has ended.
2021-05-18T18:18:01.309209Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Bind-address: '::' port: 33060, socket: /var/run/mysqld/mysqlx.sock
2021-05-18T18:18:01.395664Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2021-05-18T18:18:01.395892Z 0 [System] [MY-013602] [Server] Channel mysql_main configured to support TLS. Encrypted connections are now supported for this channel.
2021-05-18T18:18:01.400904Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2021-05-18T18:18:01.429039Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.25'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
```
## <a name="access">access the db</a> on the container
```
tricia@teacher:~$ mysql -u root -p -h 127.0.0.1
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 9
Server version: 8.0.25 MySQL Community Server - GPL

Copyright (c) 2000, 2021, Oracle and/or its affiliates.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases ; 
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mydb               |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
5 rows in set (0.02 sec)

mysql> select user, host from mysql.user ;
+------------------+-----------+
| user             | host      |
+------------------+-----------+
| dbuser           | %         |
| root             | %         |
| mysql.infoschema | localhost |
| mysql.session    | localhost |
| mysql.sys        | localhost |
| root             | localhost |
+------------------+-----------+
6 rows in set (0.00 sec)

mysql>
```
