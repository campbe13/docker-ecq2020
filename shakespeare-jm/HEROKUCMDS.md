# Using makefile init
`tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-jm$ make init`
## pull the image from docker hub
```
docker pull tricia/shakespeare-jm
Using default tag: latest
latest: Pulling from tricia/shakespeare-jm
bc51dd8edc1b: Already exists
a3224e2c3a89: Already exists
be7a066df88f: Already exists
bfdf741d72a9: Already exists
a9e612a5f04c: Already exists
c026d8d0e8cb: Already exists
d94096c4941c: Already exists
0f9653ad58ae: Already exists
1d97d51f6437: Already exists
4ad873fa227d: Already exists
933056a49e3b: Already exists
948195254531: Already exists
e0ab11975556: Already exists
2acb7af78b53: Already exists
b38b4f189038: Pull complete
a1d4de587eae: Pull complete
851c1faf3eb4: Pull complete
3dc19936adc8: Pull complete
c3ce04bb6f9a: Pull complete
63d25d39e6ea: Pull complete
Digest: sha256:1555a4379417433759188719eb50685a1aa05b61f49e8a677ee7d73b2a438718
Status: Downloaded newer image for tricia/shakespeare-jm:latest
docker.io/tricia/shakespeare-jm:latest
```
## show images
```
docker images
REPOSITORY                                         TAG                 IMAGE ID            CREATED             SIZE
stickynotes-jb_php                                 latest              522d19846ec0        40 hours ago        428MB
registry.heroku.com/shakespeare-ec/web             latest              f246516d620b        3 days ago          602MB
registry.heroku.com/blooming-anchorage-54363/web   latest              d712eb92cea3        4 days ago          13.1MB
tricia/goheroku                                    latest              a4fbe8fe535a        4 days ago          13.1MB
mysql                                              5.7.29              4d1bf91a2e39        5 days ago          435MB
mysql                                              latest              c8ad2be69a22        5 days ago          465MB
php                                                7.2-apache          ba07a75a195b        5 days ago          410MB
golang                                             alpine              51e47ee4db58        5 days ago          369MB
<none>                                             <none>              561c7ca0d5b4        8 days ago          552MB
tricia/js-mf                                       latest              a0414309c595        9 days ago          17.5MB
tricia/shakespeare-ec                              latest              8524faf9b7b8        10 days ago         602MB
registry.heroku.com/shakepeare-ec/web              latest              8524faf9b7b8        10 days ago         602MB
registry.heroku.com/shakepeare-ec                  latest              8524faf9b7b8        10 days ago         602MB
tricia/shakespeare-jm                              latest              becc74c4f566        13 days ago         479MB
alpine                                             latest              e7d92cdc71fe        6 weeks ago         5.59MB
phpmyadmin/phpmyadmin                              latest              c24a75debb40        6 weeks ago         469MB
mysql                                              5.7.22              6bb891430fb6        19 months ago       372MB
```
## tag the image
`docker tag tricia/shakespeare-jm registry.heroku.com/shakespeare-jm`
## login to heroku
```
heroku login -i
heroku: Enter your login credentials
Email [pcampbell.edu@gmail.com]:
Password: *********
Logged in as pcampbell.edu@gmail.com
heroku create --app shakespeare-jm
Creating ⬢ shakespeare-jm... done
https://shakespeare-jm.herokuapp.com/ | https://git.heroku.com/shakespeare-jm.git
```
### show the apps
```
heroku apps
=== pcampbell.edu@gmail.com Apps
blooming-anchorage-54363
frozen-cliffs-58488
shakespeare-ec
shakespeare-jm
heroku apps:info --app shakespeare-jm
=== shakespeare-jm
Auto Cert Mgmt: false
Dynos:
Git URL:        https://git.heroku.com/shakespeare-jm.git
Owner:          pcampbell.edu@gmail.com
Region:         us
Repo Size:      0 B
Slug Size:      0 B
Stack:          heroku-18
Web URL:        https://shakespeare-jm.herokuapp.com/
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-jm$
```
# Using makefile dev 
`tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-jm$ make dev`
## fix, maybe only needed one time
```
heroku labs:enable --app shakespeare-jm runtime-new-layer-extract
Enabling runtime-new-layer-extract for shakespeare-jm... done
```
## push to heroku registry (does a build)

need to mod Dockerfile  due to difference btw docker & heroku
`RUN  sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf`

```
heroku container:push web --app shakespeare-ec
=== Building web (/home/tricia/ecq/docker-ecq2020/shakespeare-jm/Dockerfile)
Sending build context to Docker daemon  7.359MB
Step 1/12 : FROM php:7.2-apache
 ---> ba07a75a195b
Step 2/12 : MAINTAINER P Campbell pcampbell.edu@gmail.com
 ---> Using cache
 ---> 9d8a33c06a7a
Step 3/12 : ENV DEBIAN_FRONTEND noninteractive
 ---> Using cache
 ---> 2d6f0f9eeccf
Step 4/12 : RUN apt-get -y update && apt-get -y install zip unzip curl && apt-get clean
 ---> Running in ddb34b10a773
Get:1 http://deb.debian.org/debian buster InRelease [122 kB]
Get:3 http://deb.debian.org/debian buster-updates InRelease [49.3 kB]
Get:2 http://security-cdn.debian.org/debian-security buster/updates InRelease [65.4 kB]
Get:4 http://deb.debian.org/debian buster/main amd64 Packages [7907 kB]
Get:5 http://security-cdn.debian.org/debian-security buster/updates/main amd64 Packages [181 kB]
Get:6 http://deb.debian.org/debian buster-updates/main amd64 Packages [7380 B]
Fetched 8332 kB in 13s (638 kB/s)
Reading package lists...
Reading package lists...
Building dependency tree...
Reading state information...
curl is already the newest version (7.64.0-4+deb10u1).
The following package was automatically installed and is no longer required:
  sensible-utils
Use 'apt autoremove' to remove it.
The following NEW packages will be installed:
  unzip zip
0 upgraded, 2 newly installed, 0 to remove and 0 not upgraded.
Need to get 405 kB of archives.
After this operation, 1202 kB of additional disk space will be used.
Get:1 http://deb.debian.org/debian buster/main amd64 unzip amd64 6.0-23+deb10u1 [172 kB]
Get:2 http://deb.debian.org/debian buster/main amd64 zip amd64 3.0-11+b1 [234 kB]
debconf: delaying package configuration, since apt-utils is not installed
Fetched 405 kB in 1s (465 kB/s)
Selecting previously unselected package unzip.
(Reading database ... 13530 files and directories currently installed.)
Preparing to unpack .../unzip_6.0-23+deb10u1_amd64.deb ...
Unpacking unzip (6.0-23+deb10u1) ...
Selecting previously unselected package zip.
Preparing to unpack .../zip_3.0-11+b1_amd64.deb ...
Unpacking zip (3.0-11+b1) ...
Setting up unzip (6.0-23+deb10u1) ...
Setting up zip (3.0-11+b1) ...
Processing triggers for mime-support (3.62) ...
Removing intermediate container ddb34b10a773
 ---> 1468c66839fa
Step 5/12 : RUN apt-get -y install redis-server && apt-get clean
 ---> Running in 36fbcfe6da51
Reading package lists...
Building dependency tree...
Reading state information...
The following package was automatically installed and is no longer required:
  sensible-utils
Use 'apt autoremove' to remove it.
The following additional packages will be installed:
  libhiredis0.14 libjemalloc2 liblua5.1-0 lua-bitop lua-cjson redis-tools
Suggested packages:
  ruby-redis
The following NEW packages will be installed:
  libhiredis0.14 libjemalloc2 liblua5.1-0 lua-bitop lua-cjson redis-server
  redis-tools
0 upgraded, 7 newly installed, 0 to remove and 0 not upgraded.
Need to get 995 kB of archives.
After this operation, 3885 kB of additional disk space will be used.
Get:1 http://deb.debian.org/debian buster/main amd64 libhiredis0.14 amd64 0.14.0-3 [33.8 kB]
Get:2 http://deb.debian.org/debian buster/main amd64 libjemalloc2 amd64 5.1.0-3 [225 kB]
Get:3 http://deb.debian.org/debian buster/main amd64 liblua5.1-0 amd64 5.1.5-8.1+b2 [111 kB]
Get:4 http://deb.debian.org/debian buster/main amd64 lua-bitop amd64 1.0.2-5 [6936 B]
Get:5 http://deb.debian.org/debian buster/main amd64 lua-cjson amd64 2.1.0+dfsg-2.1 [17.5 kB]
Get:6 http://deb.debian.org/debian buster/main amd64 redis-tools amd64 5:5.0.3-4+deb10u1 [523 kB]
Get:7 http://deb.debian.org/debian buster/main amd64 redis-server amd64 5:5.0.3-4+deb10u1 [78.4 kB]
debconf: delaying package configuration, since apt-utils is not installed
Fetched 995 kB in 1s (681 kB/s)
Selecting previously unselected package libhiredis0.14:amd64.
(Reading database ... 13564 files and directories currently installed.)
Preparing to unpack .../0-libhiredis0.14_0.14.0-3_amd64.deb ...
Unpacking libhiredis0.14:amd64 (0.14.0-3) ...
Selecting previously unselected package libjemalloc2:amd64.
Preparing to unpack .../1-libjemalloc2_5.1.0-3_amd64.deb ...
Unpacking libjemalloc2:amd64 (5.1.0-3) ...
Selecting previously unselected package liblua5.1-0:amd64.
Preparing to unpack .../2-liblua5.1-0_5.1.5-8.1+b2_amd64.deb ...
Unpacking liblua5.1-0:amd64 (5.1.5-8.1+b2) ...
Selecting previously unselected package lua-bitop:amd64.
Preparing to unpack .../3-lua-bitop_1.0.2-5_amd64.deb ...
Unpacking lua-bitop:amd64 (1.0.2-5) ...
Selecting previously unselected package lua-cjson:amd64.
Preparing to unpack .../4-lua-cjson_2.1.0+dfsg-2.1_amd64.deb ...
Unpacking lua-cjson:amd64 (2.1.0+dfsg-2.1) ...
Selecting previously unselected package redis-tools.
Preparing to unpack .../5-redis-tools_5%3a5.0.3-4+deb10u1_amd64.deb ...
Unpacking redis-tools (5:5.0.3-4+deb10u1) ...
Selecting previously unselected package redis-server.
Preparing to unpack .../6-redis-server_5%3a5.0.3-4+deb10u1_amd64.deb ...
Unpacking redis-server (5:5.0.3-4+deb10u1) ...
Setting up libjemalloc2:amd64 (5.1.0-3) ...
Setting up lua-cjson:amd64 (2.1.0+dfsg-2.1) ...
Setting up lua-bitop:amd64 (1.0.2-5) ...
Setting up liblua5.1-0:amd64 (5.1.5-8.1+b2) ...
Setting up libhiredis0.14:amd64 (0.14.0-3) ...
Setting up redis-tools (5:5.0.3-4+deb10u1) ...
Setting up redis-server (5:5.0.3-4+deb10u1) ...
invoke-rc.d: could not determine current runlevel
invoke-rc.d: policy-rc.d denied execution of start.
Processing triggers for libc-bin (2.28-10) ...
Removing intermediate container 36fbcfe6da51
 ---> a155a168c0a5
Step 6/12 : COPY app.tgz /var/www/html/
 ---> 6fe9d625d322
Step 7/12 : RUN cd /var/www/html/ ; tar -xzf app.tgz ; rm app.tgz ; mv app/index.html .
 ---> Running in 5149a991034f
Removing intermediate container 5149a991034f
 ---> ba8ef6640623
Step 8/12 : RUN cd /var/www/html/app ; curl -sS https://getcomposer.org/installer|php; ./composer.phar require predis/predis
 ---> Running in 523fbaad3943
All settings correct for using Composer
Downloading...

Composer (version 1.9.3) successfully installed to: /var/www/html/app/composer.phar
Use it: php composer.phar

Using version ^1.1 for predis/predis
./composer.json has been updated
Loading composer repositories with package information
Updating dependencies (including require-dev)
Package operations: 1 install, 0 updates, 0 removals
  - Installing predis/predis (v1.1.1): Downloading (100%)
predis/predis suggests installing ext-phpiredis (Allows faster serialization and deserialization of the Redis protocol)
Generating autoload files
Removing intermediate container 523fbaad3943
 ---> 8e7f2b250e50
Step 9/12 : WORKDIR /var/www/html/app
 ---> Running in 21ca40c4856f
Removing intermediate container 21ca40c4856f
 ---> 30cd239703f4
Step 10/12 : EXPOSE 80
 ---> Running in 27ff13b375d5
Removing intermediate container 27ff13b375d5
 ---> 53de86f6788e
Step 11/12 : RUN redis-server /etc/redis/redis.conf ; php load_model.php 3 6 10
 ---> Running in 60ededd143fe
Starting Shakespeare text model loading.
Connection to data storage successful. Flushed previous results and now attempting to insert data
Model created with length of key of 3
Inserting of model data was successful.
Model created with length of key of 6
Inserting of model data was successful.
Model created with length of key of 10
Inserting of model data was successful.
Inserting of all data was successful terminating program
Removing intermediate container 60ededd143fe
 ---> 5331132b0015
Step 12/12 : CMD redis-server /etc/redis/redis.conf ; apachectl -D  FOREGROUND
 ---> Running in 78f21d1d7e0f
Removing intermediate container 78f21d1d7e0f
 ---> 84ef0b229268
Successfully built 84ef0b229268
Successfully tagged registry.heroku.com/shakespeare-ec/web:latest
=== Pushing web (/home/tricia/ecq/docker-ecq2020/shakespeare-jm/Dockerfile)
The push refers to repository [registry.heroku.com/shakespeare-ec/web]
84a31ad6c303: Pushing [===========================>                       ]  42.86MB/77.26MB
80bee78ac996: Retrying in 1 second
f6999503d357: Retrying in 1 second
ff4eff315317: Retrying in 1 second
eb123ce60eb9: Pushing [==================================================>]  4.996MB/4.996MB
21ca635741b4: Pushing [==================================================>]  19.48MB/19.48MB
6565bce2d5e5: Pushing [==================================================>]  4.608kB
2159d2f64d7e: Retrying in 1 second
7c111aa3fc84: Waiting
1bc9b7122630: Waiting
bc4aa4d1d971: Waiting
```




