# maybe to be used in future (uses jlink to shrink jdk)
# https://blog.gilliard.lol/2018/11/05/alpine-jdk11-images.html
# I tried to find a v 11 alpine image but was unable to, hence ^ byo
# this is based on debian, the alpine v 8 jkd is 100MB, this one is 400MB
FROM openjdk:11-oracle
WORKDIR /usr/local/myapp
COPY *.class ./
COPY menu.sh .
#RUN chmod +x menu.sh
#ENTRYPOINT ["java","-jar","app.jar"]
CMD sh --version;java -version ; sh menu.sh
