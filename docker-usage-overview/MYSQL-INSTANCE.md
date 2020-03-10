m# running a database container	

This illustrates running  a mysql container without the need to install and configure mysql server.  

This illustrates running a mysql container without the need for a Dockerfile or docker-compose.yaml.

1. launch: docker run
2. monitor: docker logs 
3. monitor: docker ps
3. monitor: netstat -plan
3. monitor: iptables -nl
3. monitor: iptables -nl -t nat
3. connect: mysql -p your.ip.addr 

## refs
* https://docs.docker.com/engine/reference/commandline/run/
* https://hub.	docker.com/_/mysql/

## `docker run`
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020$ docker run --name mysql-container -e MYSQL_ROOT_PASSWORD=secret-password -p 3306:3306 mysql:latest
21042f0aa702289da8e21d7796e2cfa6241059251244898eb7ccc99b9442d415
```
## `docker logs`
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020$ docker logs mysql-container
2020-03-10 15:20:29+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
2020-03-10 15:20:30+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
2020-03-10 15:20:30+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
2020-03-10 15:20:30+00:00 [Note] [Entrypoint]: Initializing database files
2020-03-10T15:20:30.379705Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T15:20:30.379990Z 0 [System] [MY-013169] [Server] /usr/sbin/mysqld (mysqld 8.0.19) initializing of server in progress as process 45

2020-03-10T15:21:17.519138Z 5 [Warning] [MY-010453] [Server] root@localhost is created with an empty password ! Please consider switching off the --initialize-insecure option.
2020-03-10 15:22:06+00:00 [Note] [Entrypoint]: Database files initialized
2020-03-10 15:22:06+00:00 [Note] [Entrypoint]: Starting temporary server
2020-03-10T15:22:06.747899Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T15:22:06.748162Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 95
2020-03-10T15:22:11.125800Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2020-03-10T15:22:11.207212Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2020-03-10T15:22:11.254914Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 0  MySQL Community Server - GPL.
2020-03-10 15:22:11+00:00 [Note] [Entrypoint]: Temporary server started.
2020-03-10T15:22:11.736626Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock'
Warning: Unable to load '/usr/share/zoneinfo/iso3166.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone.tab' as time zone. Skipping it.
Warning: Unable to load '/usr/share/zoneinfo/zone1970.tab' as time zone. Skipping it.

2020-03-10 15:22:27+00:00 [Note] [Entrypoint]: Stopping temporary server
2020-03-10T15:22:27.421889Z 10 [System] [MY-013172] [Server] Received SHUTDOWN from user root. Shutting down mysqld (Version: 8.0.19).
2020-03-10T15:22:29.486532Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.19)  MySQL Community Server - GPL.
2020-03-10 15:22:30+00:00 [Note] [Entrypoint]: Temporary server stopped

2020-03-10 15:22:30+00:00 [Note] [Entrypoint]: MySQL init process done. Ready for start up.

2020-03-10T15:22:30.846835Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
2020-03-10T15:22:30.847049Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
2020-03-10T15:22:33.999492Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
2020-03-10T15:22:34.065756Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
2020-03-10T15:22:34.112866Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
2020-03-10T15:22:34.710456Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
```
## `docker ps`
```
tricia@acerubuntu1804:~$ docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS              PORTS                               NAMES
422924c9c85f        mysql:latest        "docker-entrypoint.s…"   3 minutes ago       Up 3 minutes        0.0.0.0:3306->3306/tcp, 33060/tcp   mysql-container
```
## `netstat -plan`
```
Active Internet connections (servers and established)
Proto Recv-Q Send-Q Local Address           Foreign Address         State       PID/Program name
tcp        0      0 127.0.0.1:6379          0.0.0.0:*               LISTEN      -
tcp        0      0 127.0.0.53:53           0.0.0.0:*               LISTEN      -
tcp        0      0 0.0.0.0:22              0.0.0.0:*               LISTEN      -
tcp        0      0 127.0.0.1:631           0.0.0.0:*               LISTEN      -
tcp        0      0 127.0.0.1:25            0.0.0.0:*               LISTEN      -
tcp        0      0 127.0.0.1:6010          0.0.0.0:*               LISTEN      -
tcp        0      0 192.168.0.117:22        192.168.0.191:57110     ESTABLISHED -
tcp        0      0 192.168.0.117:22        192.168.0.191:51018     ESTABLISHED -
tcp        0      0 192.168.0.117:22        192.168.0.191:51025     ESTABLISHED -
tcp        0      0 127.0.0.1:36052         127.0.0.1:6010          ESTABLISHED 9100/gedit
tcp        0      0 127.0.0.1:6010          127.0.0.1:36052         ESTABLISHED -
tcp6       0      0 :::3306                 :::*                    LISTEN      -
tcp6       0      0 ::1:6379                :::*                    LISTEN      -
tcp6       0      0 :::80                   :::*                    LISTEN      -
tcp6       0      0 :::22                   :::*                    LISTEN      -
tcp6       0      0 ::1:631                 :::*                    LISTEN      -
tcp6       0      0 ::1:25                  :::*                    LISTEN      -
tcp6       0      0 ::1:6010                :::*                    LISTEN      -
tcp6       0      0 :::8900                 :::*                    LISTEN      -
```
## `sudo iptables -nL`
This is the filter table (default displayed by iptables)
```
tricia@acerubuntu1804:~$ sudo iptables -nL
Chain INPUT (policy ACCEPT)
target     prot opt source               destination

Chain FORWARD (policy DROP)
target     prot opt source               destination
DOCKER-USER  all  --  0.0.0.0/0            0.0.0.0/0
DOCKER-ISOLATION-STAGE-1  all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0            ctstate RELATED,ESTABLISHED
DOCKER     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0            ctstate RELATED,ESTABLISHED
DOCKER     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0            ctstate RELATED,ESTABLISHED
DOCKER     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0            ctstate RELATED,ESTABLISHED
DOCKER     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0
ACCEPT     all  --  0.0.0.0/0            0.0.0.0/0

Chain OUTPUT (policy ACCEPT)
target     prot opt source               destination

Chain DOCKER (4 references)
target     prot opt source               destination
ACCEPT     tcp  --  0.0.0.0/0            172.17.0.2           tcp dpt:80
ACCEPT     tcp  --  0.0.0.0/0            172.17.0.3           tcp dpt:3306

Chain DOCKER-ISOLATION-STAGE-1 (1 references)
target     prot opt source               destination
DOCKER-ISOLATION-STAGE-2  all  --  0.0.0.0/0            0.0.0.0/0
DOCKER-ISOLATION-STAGE-2  all  --  0.0.0.0/0            0.0.0.0/0
DOCKER-ISOLATION-STAGE-2  all  --  0.0.0.0/0            0.0.0.0/0
DOCKER-ISOLATION-STAGE-2  all  --  0.0.0.0/0            0.0.0.0/0
RETURN     all  --  0.0.0.0/0            0.0.0.0/0

Chain DOCKER-ISOLATION-STAGE-2 (4 references)
target     prot opt source               destination
DROP       all  --  0.0.0.0/0            0.0.0.0/0
DROP       all  --  0.0.0.0/0            0.0.0.0/0
DROP       all  --  0.0.0.0/0            0.0.0.0/0
DROP       all  --  0.0.0.0/0            0.0.0.0/0
RETURN     all  --  0.0.0.0/0            0.0.0.0/0

Chain DOCKER-USER (1 references)
target     prot opt source               destination
RETURN     all  --  0.0.0.0/0            0.0.0.0/0
```
## `iptables -nL -t nat`
This is the nat table as set up by docker
```
tricia@acerubuntu1804:~$ sudo iptables -nL -t nat
Chain PREROUTING (policy ACCEPT)
target     prot opt source               destination
DOCKER     all  --  0.0.0.0/0            0.0.0.0/0            ADDRTYPE match dst-type LOCAL

Chain INPUT (policy ACCEPT)
target     prot opt source               destination

Chain OUTPUT (policy ACCEPT)
target     prot opt source               destination
DOCKER     all  --  0.0.0.0/0           !127.0.0.0/8          ADDRTYPE match dst-type LOCAL

Chain POSTROUTING (policy ACCEPT)
target     prot opt source               destination
MASQUERADE  all  --  192.168.16.0/20      0.0.0.0/0
MASQUERADE  all  --  172.31.0.0/16        0.0.0.0/0
MASQUERADE  all  --  172.28.0.0/16        0.0.0.0/0
MASQUERADE  all  --  172.17.0.0/16        0.0.0.0/0
MASQUERADE  tcp  --  172.17.0.2           172.17.0.2           tcp dpt:80
MASQUERADE  tcp  --  172.17.0.3           172.17.0.3           tcp dpt:3306

Chain DOCKER (2 references)
target     prot opt source               destination
RETURN     all  --  0.0.0.0/0            0.0.0.0/0
RETURN     all  --  0.0.0.0/0            0.0.0.0/0
RETURN     all  --  0.0.0.0/0            0.0.0.0/0
RETURN     all  --  0.0.0.0/0            0.0.0.0/0
DNAT       tcp  --  0.0.0.0/0            0.0.0.0/0            tcp dpt:8900 to:172.17.0.2:80
DNAT       tcp  --  0.0.0.0/0            0.0.0.0/0            tcp dpt:3306 to:172.17.0.3:3306
```
## connect to the running container database
populate
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/docker-usage-overview$ mysql -u root -p  -h 192.168.0.117 <quickdb.sql
```
access
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/docker-usage-overview$ mysql -u root -p  -h 192.168.0.117
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 10
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
| mysql              |
| performance_schema |
| pets               |
| sys                |
+--------------------+
5 rows in set (0.00 sec)

mysql> use pets;
Reading table information for completion of table and column names
You can turn off this feature to get a quicker startup with -A

Database changed
mysql> show tables;
+----------------+
| Tables_in_pets |
+----------------+
| dogs           |
+----------------+
1 row in set (0.00 sec)

mysql> describe dogs;
+-------+-------------+------+-----+---------+-------+
| Field | Type        | Null | Key | Default | Extra |
+-------+-------------+------+-----+---------+-------+
| name  | varchar(20) | YES  |     | NULL    |       |
| breed | varchar(25) | YES  |     | NULL    |       |
| birth | date        | YES  |     | NULL    |       |
+-------+-------------+------+-----+---------+-------+
3 rows in set (0.01 sec)

mysql> select * from dogs;
+------------+--------------------------+------------+
| name       | breed                    | birth      |
+------------+--------------------------+------------+
| Mr. Floofy | Shih Tzu                 | 2016-05-05 |
| Walter     | Labradoodle              | 2014-10-25 |
| Freddy     | Wheaton Terrier & Poodle | 2018-10-31 |
+------------+--------------------------+------------+
3 rows in set (0.00 sec)

mysql> 
```
