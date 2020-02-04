# simple dockerfile
FROM docker/whalesay:latest
RUN apt-get -y update 
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get -y install figlet && apt-get -y install fortune
CMD /usr/games/fortune -a | cowsay ; figlet "I love docker" 
