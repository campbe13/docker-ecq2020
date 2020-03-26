#  simple java
This is a proof of concept containerized simple java program(s) at the level of an intro to programming in java course.  The code was written by various teachers including myself and is intended to give examples of the use of various concepts in programming with java. 

## TL;DR
### To run this app
1. install docker https://docs.docker.com/install/ 
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. run `docker run -i tricia/samplejava` 

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

## docker registry image repo
The app image is available as a public image in my repo

https://hub.docker.com/repository/docker/tricia/javasamples

### running this image
If you don't want to clone this repo to use my Makefile you can run this image (provided docker is installed) use this command:
The `-i` makes it interactive as the menu prompts you, this is needed. 
```
docker run -i tricia/javasamples 
``` 
The result will be something like:
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/simple-java$ make run
docker run -i --name javasamples  tricia/javasamples
GNU bash, version 4.2.46(2)-release (x86_64-redhat-linux-gnu)
Copyright (C) 2011 Free Software Foundation, Inc.
License GPLv3+: GNU GPL version 3 or later <http://gnu.org/licenses/gpl.html>

This is free software; you are free to change and redistribute it.
There is NO WARRANTY, to the extent permitted by law.
openjdk version "11.0.2" 2019-01-15
OpenJDK Runtime Environment 18.9 (build 11.0.2+9)
OpenJDK 64-Bit Server VM 18.9 (build 11.0.2+9, mixed mode, sharing)
Select which program you want to run
list: NewtonRhapson2 Payroll TestGetDigit
which program do you want to run ? (x to exit)
Payroll
What is your name? me
How many hours did you work this week? 15
What is your hourly pay rate? 12.35
Hello, me
Your gross pay is $185.25
list: NewtonRhapson2 Payroll TestGetDigit
which program do you want to run ? (x to exit)
x
tricia@acerubuntu1804:~/ecq/docker-ecq2020/simple-java$
```
See here for the [Dockerfile](Dockerfile.md) with explanations that was used to create the container for this app.

### docker commands
see  [common docker commands](../docker-usage-overview/DOCKERCMDS.md) 
### docker-compose commands
see  [common docker commands](../docker-usage-overview/DOCKERCOMPOSECMDS.md)


