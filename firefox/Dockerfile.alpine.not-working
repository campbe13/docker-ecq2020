# PMC 2020-04-02
# run firefox from a container, small image
FROM alpine:latest

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-04-02"

# alpine uses apk for pkg mgmg
# no cache erases cache so smaller image
# equiv to apk update in the beginning and rm -rf /var/cache/apk/*
RUN apk add --no-cache firefox-esr 

# launch
#ENTRYPOINT [ "/usr/bin/firefox", "https://www.dawsoncollege.qc.ca" ]
# for shelling into the container
CMD sh
