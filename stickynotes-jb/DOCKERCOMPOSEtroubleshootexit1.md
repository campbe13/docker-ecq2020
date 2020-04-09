# Troubleshooting run time problem
had an error running this on the Fedora box, the php container ends with `Exit 1`

## look at the logs
[tricia@acerfed31 stickynotes-jb]$ docker logs ebf197b6f959
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.3. Set the 'ServerName' directive globally to suppress this message
(2)No such file or directory: AH02291: Cannot access directory '/var/log/apache2/' for main error log
(2)No such file or directory: AH02291: Cannot access directory '/var/log/apache2/' for error log of vhost defined at /etc/apache2/sites-enabled/000-default.conf:1
AH00014: Configuration check failed
Action '-D FOREGROUND' failed.
The Apache error log may have more information.
5 files to edit


```
[tricia@korra dbsetup]$ docker volume ls
DRIVER              VOLUME NAME
local               stickynotes-jb_persistent
```
`docker voluume inspect` can also inspect containers `docker inspect`
```
[tricia@korra dbsetup]$ docker volume inspect stickynotes-jb_persistent
[
    {
        "CreatedAt": "2020-03-03T12:36:45-05:00",
        "Driver": "local",
        "Labels": {
            "com.docker.compose.project": "stickynotes-jb",
            "com.docker.compose.version": "1.25.4",
            "com.docker.compose.volume": "persistent"
        },
        "Mountpoint": "/var/lib/docker/volumes/stickynotes-jb_persistent/_data",
        "Name": "stickynotes-jb_persistent",
        "Options": null,
        "Scope": "local"
    }
]
```
## delete a volume
troubleshooting, persistent volumes, sql not run on startup so must delete in order
to re-init
```
[tricia@korra dbsetup]$ docker volume rm stickynotes-jb_persistent
Error response from daemon: remove stickynotes-jb_persistent: volume is in use - [178301c8ff8cd6f7ab38e215035c857395088015e35d9b1b0fb24e97e7571e1c]
[tricia@korra dbsetup]$ docker-compose stop db
[tricia@korra dbsetup]$ docker volume rm stickynotes-jb_persistent
Error response from daemon: remove stickynotes-jb_persistent: volume is in use - [178301c8ff8cd6f7ab38e215035c857395088015e35d9b1b0fb24e97e7571e1c]
```
had to stop all containers & rm to be sure
```
[tricia@korra dbsetup]$ docker-compose stop
Stopping stickynotes-jb_php_1        ... done
Stopping stickynotes-jb_phpmyadmin_1 ... done
[tricia@korra dbsetup]$ docker-compose rm
Going to remove stickynotes-jb_php_1, stickynotes-jb_phpmyadmin_1, stickynotes-jb_db_1
Are you sure? [yN] y
Removing stickynotes-jb_php_1        ... done
Removing stickynotes-jb_phpmyadmin_1 ... done
Removing stickynotes-jb_db_1         ... done
[tricia@korra dbsetup]$ docker volume rm stickynotes-jb_persistent
stickynotes-jb_persistent
[tricia@korra dbsetup]$ docker volume rm stickynotes-jb_persistent
Error: No such volume: stickynotes-jb_persistent
```
## docker-compose up
```
[tricia@korra stickynotes-jb]$ make -f Makefile.docker-compose up
docker-compose up -d
Creating volume "stickynotes-jb_persistent" with default driver
Creating stickynotes-jb_db_1 ... done
Creating stickynotes-jb_php_1        ... done
Creating stickynotes-jb_phpmyadmin_1 ... done
docker-compose ps
           Name                          Command               State               Ports
----------------------------------------------------------------------------------------------------
stickynotes-jb_db_1           docker-entrypoint.sh --inn ...   Up      0.0.0.0:2004->3306/tcp,
                                                                       33060/tcp
stickynotes-jb_php_1          docker-php-entrypoint /bin ...   Up      0.0.0.0:8700->80/tcp
stickynotes-jb_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8701->80/tcp
[tricia@korra stickynotes-jb]$
```

