# dockerfile for lighttpd host javascript example code 
```
# dockerfile for lighttpd host javascript example code 
# 2020-2-21
FROM alpine:latest
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-xx-xx"
```
* \# comments, as with bash scripts
* FROM the base image to be pulled from docker hub,  you choose a base image that has most of what you want or your start with a basic image alpine, ubuntu etc
* LABEL user defined meta data for the container image
```
# install lighthttpd
# ref https://wiki.alpinelinux.org/wiki/Lighttpd
# & enable directory listing
RUN apk add lighttpd;echo 'server.dir-listing = "enable"'>> /etc/lighttpd/lighttpd.conf 
``` 
* RUN: commands to be run on the image, each RUN creates a new layer on the docker image
```
# DocumentRoot for lighttpd
WORKDIR /var/www/localhost/htdocs/
```
* WORKDIR this is effectiveley a cd on the container filesystem
```
# install app
COPY app.tgz .
RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git
#RUN echo "<body><head><title>testhtml</title></head><h1>If you can see this lighttpd works</h1></body>" > index.html
```
* COPY copy from the local host to the container (AFAICT not possible to do a recursive copy) -- as this is a simple example we copy one file.

```
# expose the website port
EXPOSE 80
```
* EXPOSE: by default ports are internal to docker networks only, unless they are explicitly exposed to the host, EXPOSE means that we can access this port from the host for the docker engine
```
# start  web server  (rc-service not installed on this image )
ENTRYPOINT ["/usr/sbin/lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
```
* ENTRYPOINT to be run when the container is run, using `[]` command(s) is(are) executed, if ommitted format is different and a shell is launched, CMD vs ENTRYPOINT is nuanced


