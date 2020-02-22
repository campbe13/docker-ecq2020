# dockerfile for lighttpd host javascript example code 
# 2020-2-21

FROM alpine:latest
MAINTAINER 2020-02-21 P Campbell pcampbell.edu@gmail.com

# install lighthttpd
# ref https://wiki.alpinelinux.org/wiki/Lighttpd
# & enable directory listing
RUN apk add lighttpd;echo 'server.dir-listing = "enable"'>> /etc/lighttpd/lighttpd.conf 
 
# DocumentRoot for lighttpd
WORKDIR /var/www/localhost/htdocs/

# install app
COPY app.tgz .
RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git
#RUN echo "<body><head><title>testhtml</title></head><h1>If you can see this lighttpd works</h1></body>" > index.html

# expose the website port
EXPOSE 80

# start  web server  (rc-service not installed on this image )
ENTRYPOINT ["/usr/sbin/lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
