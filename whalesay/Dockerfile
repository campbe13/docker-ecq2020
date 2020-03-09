# simple dockerfile
FROM docker/whalesay:latest
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-29"
RUN apt-get -y update 
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get -y install figlet && apt-get -y install fortune
CMD /usr/games/fortune -a | cowsay ; figlet "I love docker" 
