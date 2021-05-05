# dockerfile for lighttpd host javascript example code 
# 2021-05-05
# BUILD   docker build -t weatherapp . 
# RUN     docker run  -t weatherapp . 


FROM alpine
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-05-05"

# install lighthttpd
# ref https://wiki.alpinelinux.org/wiki/Lighttpd
RUN apk add lighttpd
# Used for testing enable directory listing
#RUN apk add lighttpd;echo 'server.dir-listing = "enable"'>> /etc/lighttpd/lighttpd.conf 
 
# DocumentRoot for lighttpd
WORKDIR /var/www/localhost/htdocs/

# install app from host to container
COPY app/* ./

# expose the website port on the container
EXPOSE 80
# start  web server  (rc-service not installed on this image )
ENTRYPOINT ["/usr/sbin/lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
