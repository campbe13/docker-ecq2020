# springboot + java

* https://spring.io/blog/2018/11/08/spring-boot-in-a-container
* https://spring.io/guides/topicals/spring-boot-docker/
* https://spring.io/guides/gs/spring-boot-docker/

todo complete this README.md for springboot + java

To use this you must have jdk & jre installed & maven & docker

For more details see [Makefile](Makefile) 
## to run from docker hub
n.b.  -p host:container
```
docker run -t tricia/springbootj -p 8080:8080
```

## TL;DR to make & run this container
	```
	$ make all  # uses the [Makefile](Makefile)
	```
	or
	```
	$ mvn compile
	$ mvn package
	$ docker build -t  springbootj .
	$ docker run -p 8080:8080 --name springbootj springbootj
	```
access it through a browser: `localhost:8080` or  `host.ip.addr.ess:8080`
