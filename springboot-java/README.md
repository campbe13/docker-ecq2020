# springboot + java

This is an hello world type of app, not complex. 

Refs: 
* https://spring.io/blog/2018/11/08/spring-boot-in-a-container
* https://spring.io/guides/topicals/spring-boot-docker/
* https://spring.io/guides/gs/spring-boot-docker/

todo complete this README.md for springboot + java

See [run on windows Docker Desktop from docker hub](RUNFROMHUB.md)

For more details see [Makefile](Makefile) 
## to run from docker hub
*  `-p` hostport:containerport  (you must use 8080 as container port as that is defined in the image)
* add `-d` if you want it to run in the background

__WARNING__ if you are running on windows a quirk of docker for windows is that the -p for port forwarding must be 1st, or, frustration will ensue, port will not be forwarded.
```
docker run -p 8080:8080 tricia/springbootj 
```

## to make & run this container
To do  this you must have jdk & jre installed & maven & docker

1. clone the repo
2. use make or manualy compile & run
	```
	$ make all  # uses the Makefile
	```
	or
	```
	$ mvn compile
	$ mvn package
	$ docker build -t  springbootj .
	$ docker run -p 8080:8080 --name springbootj springbootj
	```
3. access it through a browser: `localhost:8080` or  `host.ip.addr.ess:8080`
