# dockerfile for apache  host javascript example code 
# 2021-05-12
# BUILD   see Dockerfile.local for testing
# RUN     this file is for deploying to heroku
# USE     


# heroku mod, need server to bind to value in PORT env var


FROM httpd

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-05-05"

 
# DocumentRoot for apache2
WORKDIR /usr/local/apache2/htdocs/


# install app from host to container
COPY app/* ./

#for heroku ONLY
# the port used for the web server is via the PORT environment variable
# this file has Listen ${PORT}
# instead of the default  Listen 80
COPY my-httpd.conf /usr/local/apache2/conf/httpd.conf
