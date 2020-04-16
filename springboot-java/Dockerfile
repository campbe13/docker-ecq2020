FROM openjdk:8-jdk-alpine
RUN addgroup -S spring && adduser spring -G spring --disabled-password
USER spring:spring
ARG JAR_FILE=target/*.jar
COPY ${JAR_FILE} app.jar
ENTRYPOINT ["java","-jar","/app.jar"]
# I can unpack the jar and use it like this:
# first (in Makefile): $ mkdir -p target/dependency && (cd target/dependency; jar -xf ../*.jar)
# ARG DEPENDENCY=target/dependency
# COPY ${DEPENDENCY}/BOOT-INF/lib /app/lib
# COPY ${DEPENDENCY}/META-INF /app/META-INF
# COPY ${DEPENDENCY}/BOOT-INF/classes /app
#ENTRYPOINT ["java","-cp","app:app/lib*", "hello.Application"]
