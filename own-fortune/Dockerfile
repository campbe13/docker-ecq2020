FROM alpine:latest
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-04-03"
RUN apk add --no-cache fortune \
    figlet
cmd /usr/bin/fortune|figlet;echo; echo container hostname: `hostname` ; echo ; echo container network:; echo; ip addr show

