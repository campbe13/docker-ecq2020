# demo create a db container

1. [run](#run) `docker run --name mysql-container -d -e MYSQL_DATABASE=mydb -e MYSQL_ROOT_PASSWORD=secret-password -e MYSQL_USER=dbuser -e MYSQL_PASSWORD=secret -p 3306:3306 mysql:latest`
2. [watch logs](#logs) `docker logs mysql-container`
3. [access](#access) `mysql -u root -p -h 127.0.0.1`
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
c8fd508b4719e53ff1c895348b0eba6ab1d258eb91c6bf7b0439171169d4f613```
## <a name="logs">watch the logs</a>, there is a slight delay for access in mysql startup
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020$ docker logs mysql-container -f                      2020-03-10 22:23:15+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
2020-03-10 22:23:15+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
2020-03-10 22:23:15+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.##
2020-03-10 22:23:15+00:00 [Note] [Entrypoint]: Initializing database files
2020-03-10T22:23:15.991450Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T22:23:15.991641Z 0 [System] [MY-013169] [Server] /usr/sbin/mysqld (mysqld 8.0.19) initializing of server in progress as process 45
2020-03-10T22:23:50.569601Z 5 [Warning] [MY-010453] [Server] root@localhost is created with an empty password ! Please consider switching off the --initialize-insecure option.
2020-03-10 22:24:36+00:00 [Note] [Entrypoint]: Database files initialized
2020-03-10 22:24:36+00:00 [Note] [Entrypoint]: Starting temporary server
2020-03-10T22:24:36.574728Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T22:24:36.574954Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 95
2020-03-10T22:24:39.587969Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2020-03-10T22:24:39.745774Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2020-03-10T22:24:39.793517Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 0  MySQL Community Server - GPL.
2020-03-10 22:24:39+00:00 [Note] [Entrypoint]: Temporary server started.
2020-03-10T22:24:40.047059Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock'
Warning: Unable to load '/usr/share/zoneinfo/iso3166.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone1970.tab' as time zone. Skipping it.
2020-03-10 22:24:52+00:00 [Note] [Entrypoint]: Creating database mydb
2020-03-10 22:24:52+00:00 [Note] [Entrypoint]: Creating user dbuser
2020-03-10 22:24:52+00:00 [Note] [Entrypoint]: Giving user dbuser access to schema mydb

2020-03-10 22:24:53+00:00 [Note] [Entrypoint]: Stopping temporary server
2020-03-10T22:24:53.118838Z 14 [System] [MY-013172] [Server] Received SHUTDOWN from user root. Shutting down mysqld (Version: 8.0.19).
2020-03-10T22:24:55.864003Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.19)  MySQL Community Server - GPL.
2020-03-10 22:24:56+00:00 [Note] [Entrypoint]: Temporary server stopped

2020-03-10 22:24:56+00:00 [Note] [Entrypoint]: MySQL init process done. Ready for start up.

2020-03-10T22:24:56.566048Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T22:24:56.566260Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
2020-03-10T22:25:00.713701Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2020-03-10T22:25:00.778638Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2020-03-10T22:25:00.829787Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
2020-03-10T22:25:00.990784Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
```
## <a name="access">access the db</a> on the container
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020$ mysql -u root -p -h 127.0.0.1
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 8
Server version: 8.0.19 MySQL Community Server - GPL

Copyright (c) 2000, 2020, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mydb               |
| mysql              |
| performance_schema |
| sys                |
+--------------------+
5 rows in set (0.01 sec)

mysql> select user, host from mysql.user;
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
