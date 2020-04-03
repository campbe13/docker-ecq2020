# running docker build 
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/whalesay$ docker build  .
Sending build context to Docker daemon  10.75kB
Step 1/6 : FROM docker/whalesay:latest
 ---> 6b362a9f73eb
Step 2/6 : LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-29"
 ---> Running in 02f4bea3cfe7
Removing intermediate container 02f4bea3cfe7
 ---> 2853ac697722
Step 3/6 : RUN apt-get -y update
 ---> Running in ab1582019472
Ign http://archive.ubuntu.com trusty InRelease
Get:1 http://archive.ubuntu.com trusty-updates InRelease [65.9 kB]
Get:2 http://archive.ubuntu.com trusty-security InRelease [65.9 kB]
Hit http://archive.ubuntu.com trusty Release.gpg
Hit http://archive.ubuntu.com trusty Release
Get:3 http://archive.ubuntu.com trusty-updates/main Sources [532 kB]
Get:4 http://archive.ubuntu.com trusty-updates/restricted Sources [6444 B]
Get:5 http://archive.ubuntu.com trusty-updates/universe Sources [288 kB]
Get:6 http://archive.ubuntu.com trusty-updates/main amd64 Packages [1460 kB]
Get:7 http://archive.ubuntu.com trusty-updates/restricted amd64 Packages [21.4 kB]
Get:8 http://archive.ubuntu.com trusty-updates/universe amd64 Packages [671 kB]
Get:9 http://archive.ubuntu.com trusty-security/main Sources [220 kB]
Get:10 http://archive.ubuntu.com trusty-security/restricted Sources [5050 B]
Get:11 http://archive.ubuntu.com trusty-security/universe Sources [126 kB]
Get:12 http://archive.ubuntu.com trusty-security/main amd64 Packages [1032 kB]
Get:13 http://archive.ubuntu.com trusty-security/restricted amd64 Packages [18.1 kB]
Get:14 http://archive.ubuntu.com trusty-security/universe amd64 Packages [377 kB]
Hit http://archive.ubuntu.com trusty/main Sources
Hit http://archive.ubuntu.com trusty/restricted Sources
Hit http://archive.ubuntu.com trusty/universe Sources
Hit http://archive.ubuntu.com trusty/main amd64 Packages
Hit http://archive.ubuntu.com trusty/restricted amd64 Packages
Hit http://archive.ubuntu.com trusty/universe amd64 Packages
Fetched 4889 kB in 18s (261 kB/s)
Reading package lists...
Removing intermediate container ab1582019472
 ---> 54801cc113dd
Step 4/6 : ENV DEBIAN_FRONTEND=noninteractive
 ---> Running in 702749a1eee3
Removing intermediate container 702749a1eee3
 ---> 0f07a92c7769
Step 5/6 : RUN apt-get -y install figlet && apt-get -y install fortune
 ---> Running in 9a30c2235927
Reading package lists...
Building dependency tree...
Reading state information...
The following NEW packages will be installed:
  figlet
0 upgraded, 1 newly installed, 0 to remove and 124 not upgraded.
Need to get 190 kB of archives.
After this operation, 744 kB of additional disk space will be used.
Get:1 http://archive.ubuntu.com/ubuntu/ trusty/universe figlet amd64 2.2.5-2 [190 kB]
Fetched 190 kB in 0s (219 kB/s)
Selecting previously unselected package figlet.
(Reading database ... 13116 files and directories currently installed.)
Preparing to unpack .../figlet_2.2.5-2_amd64.deb ...
Unpacking figlet (2.2.5-2) ...
Setting up figlet (2.2.5-2) ...
update-alternatives: using /usr/bin/figlet-figlet to provide /usr/bin/figlet (figlet) in auto mode
Reading package lists...
Building dependency tree...
Reading state information...
The following extra packages will be installed:
  fortunes-min librecode0
Suggested packages:
  fortunes x11-utils bsdmainutils
The following NEW packages will be installed:
  fortune-mod fortunes-min librecode0
0 upgraded, 3 newly installed, 0 to remove and 124 not upgraded.
Need to get 872 kB of archives.
After this operation, 2206 kB of additional disk space will be used.
Get:1 http://archive.ubuntu.com/ubuntu/ trusty/main librecode0 amd64 3.6-21 [771 kB]
Get:2 http://archive.ubuntu.com/ubuntu/ trusty/universe fortune-mod amd64 1:1.99.1-7 [39.5 kB]
Get:3 http://archive.ubuntu.com/ubuntu/ trusty/universe fortunes-min all 1:1.99.1-7 [61.8 kB]
Fetched 872 kB in 2s (396 kB/s)
Selecting previously unselected package librecode0:amd64.
(Reading database ... 13193 files and directories currently installed.)
Preparing to unpack .../librecode0_3.6-21_amd64.deb ...
Unpacking librecode0:amd64 (3.6-21) ...
Selecting previously unselected package fortune-mod.
Preparing to unpack .../fortune-mod_1%3a1.99.1-7_amd64.deb ...
Unpacking fortune-mod (1:1.99.1-7) ...
Selecting previously unselected package fortunes-min.
Preparing to unpack .../fortunes-min_1%3a1.99.1-7_all.deb ...
Unpacking fortunes-min (1:1.99.1-7) ...
Setting up librecode0:amd64 (3.6-21) ...
Setting up fortune-mod (1:1.99.1-7) ...
Setting up fortunes-min (1:1.99.1-7) ...
Processing triggers for libc-bin (2.19-0ubuntu6.6) ...
Removing intermediate container 9a30c2235927
 ---> 30f9d05eb058
Step 6/6 : CMD /usr/games/fortune -a | cowsay ; figlet "I love docker"
 ---> Running in 46179f4eb9fb
Removing intermediate container 46179f4eb9fb
 ---> ddef8e1b60de
Successfully built ddef8e1b60de
tricia@acerubuntu1804:~/ecq/docker-ecq2020/whalesay$
```
