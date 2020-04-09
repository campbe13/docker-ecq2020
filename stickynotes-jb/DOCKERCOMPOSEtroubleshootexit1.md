# Troubleshooting run time problem
This is the process I used to troubleshoot & fix an error I had running this
on another box.



Had an error running this on the Fedora box, the php container ends with `Exit 1`
```
[tricia@acerfed31 stickynotes-jb]$ docker-compose ps
           Name                          Command               State                  Ports
----------------------------------------------------------------------------------------------------------
stickynotes-jb_db_1           docker-entrypoint.sh --inn ...   Up       0.0.0.0:32768->3306/tcp, 33060/tcp
stickynotes-jb_php_1          docker-php-entrypoint /bin ...   Exit 1
stickynotes-jb_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up       0.0.0.0:8701->80/tcp
```
Hmmm what's running ??
```
[tricia@acerfed31 stickynotes-jb]$ docker ps
CONTAINER ID        IMAGE                   COMMAND                  CREATED             STATUS              PORTS                                NAMES
237a9c549dc1        phpmyadmin/phpmyadmin   "/docker-entrypoint.…"   About an hour ago   Up About an hour    0.0.0.0:8701->80/tcp                 stickynotes-jb_phpmyadmin_1
eb5182faa86f        mysql:latest            "docker-entrypoint.s…"   About an hour ago   Up About an hour    33060/tcp, 0.0.0.0:32768->3306/tcp   stickynotes-jb_db_1
```
Hmmm what's not running
```
[tricia@acerfed31 stickynotes-jb]$ docker ps -a
CONTAINER ID        IMAGE                   COMMAND                  CREATED             STATUS                         PORTS                                NAMES
237a9c549dc1        phpmyadmin/phpmyadmin   "/docker-entrypoint.…"   About an hour ago   Up About an hour               0.0.0.0:8701->80/tcp                 stickynotes-jb_phpmyadmin_1
ebf197b6f959        stickynotes-jb_php      "docker-php-entrypoi…"   About an hour ago   Exited (1) About an hour ago                                        stickynotes-jb_php_1
eb5182faa86f        mysql:latest            "docker-entrypoint.s…"   About an hour ago   Up About an hour               33060/tcp, 0.0.0.0:32768->3306/tcp   stickynotes-jb_db_1
7d1168e27962        tricia/js-mf            "/usr/sbin/lighttpd …"   6 weeks ago         Exited (0) 6 weeks ago                                              nifty_blackwell
f871f3b8c90a        tricia/shakespeare-ec   "docker-php-entrypoi…"   7 weeks ago         Exited (137) 6 weeks ago  
```
So I need to troubleshoot, the first step is *always* look at the log files
## look at the logs
first I tried the named container
```
[tricia@acerfed31 stickynotes-jb]$ docker logs stickynotes-jb_php
Error: No such container: stickynotes-jb_php
[tricia@acerfed31 stickynotes-jb]$ docker logs stickynotes-jb_php1
Error: No such container: stickynotes-jb_php1
```
but it's not running so I have to use the id
```
[tricia@acerfed31 stickynotes-jb]$ docker logs ebf197b6f959
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.3. Set the 'ServerName' directive globally to suppress this message
(2)No such file or directory: AH02291: Cannot access directory '/var/log/apache2/' for main error log
(2)No such file or directory: AH02291: Cannot access directory '/var/log/apache2/' for error log of vhost defined at /etc/apache2/sites-enabled/000-default.conf:1
AH00014: Configuration check failed
Action '-D FOREGROUND' failed.
The Apache error log may have more information.
```
AHA, lets dig deeper
```
[tricia@acerfed31 stickynotes-jb]$ ls -ld /var/log/apache*
ls: cannot access '/var/log/apache*': No such file or directory
```
### fix it
That's the problem the php image has the following host:container mapping
```
    volumes:
#       use cwd for website (dev & debugging only)
        - ./jeffstickyphp/:/var/www/html
#       log to localhost (debugging only)
        - /var/log:/var/log
```
So I can change that in the yaml, or create an apache2 directory in /var/log.

I decided to change it in the yaml, adding a directory requires root access which I have in this case but it's not always possible.  
1.  `md ~/apache2`
2.  change the yaml:
    ```
           - ~/:/var/log
    ```
## test `docker-compose up`
```
[tricia@acerfed31 stickynotes-jb]$ docker-compose up -d
stickynotes-jb_db_1 is up-to-date
Recreating stickynotes-jb_php_1 ...
Recreating stickynotes-jb_php_1 ... done
```
show running containers
```
[tricia@acerfed31 stickynotes-jb]$ docker-compose ps
           Name                          Command               State                 Ports
---------------------------------------------------------------------------------------------------------
stickynotes-jb_db_1           docker-entrypoint.sh --inn ...   Up      0.0.0.0:32768->3306/tcp, 33060/tcp
stickynotes-jb_php_1          docker-php-entrypoint /bin ...   Up      0.0.0.0:8700->80/tcp
stickynotes-jb_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8701->80/tcp
```
show the logs
```
[tricia@acerfed31 ~]$ cd apache2/
[tricia@acerfed31 apache2]$ ls
access.log  error.log  other_vhosts_access.log
[tricia@acerfed31 apache2]$ tail error.log
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.3. Set the 'ServerName' directive globally to suppress this message
[Thu Apr 09 17:20:22.073097 2020] [mpm_prefork:notice] [pid 8] AH00163: Apache/2.4.38 (Debian) PHP/7.2.29 configured -- resuming normal operations
[Thu Apr 09 17:20:22.073224 2020] [core:notice] [pid 8] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
[tricia@acerfed31 apache2]$ tail access.log
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET / HTTP/1.1" 200 1536 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET /style.css HTTP/1.1" 200 1252 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET /login.js HTTP/1.1" 200 1416 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET /StickyNote.js HTTP/1.1" 200 694 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET /sticky-note.api-plugin.js HTTP/1.1" 200 1417 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:56 +0000] "GET /script.js HTTP/1.1" 200 3668 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:22:59 +0000] "POST /login.php HTTP/1.1" 401 466 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
192.168.0.192 - - [09/Apr/2020:17:23:01 +0000] "GET /favicon.ico HTTP/1.1" 404 493 "http://192.168.0.112:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
127.0.0.1 - - [09/Apr/2020:17:23:04 +0000] "OPTIONS * HTTP/1.0" 200 126 "-" "Apache/2.4.38 (Debian) PHP/7.2.29 (internal dummy connection)"
127.0.0.1 - - [09/Apr/2020:17:23:09 +0000] "OPTIONS * HTTP/1.0" 200 126 "-" "Apache/2.4.38 (Debian) PHP/7.2.29 (internal dummy connection)"
[tricia@acerfed31 apache2]$
```
