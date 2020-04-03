# PMC 2020-04-02
# run a bunch of xeyes from a tiny container
FROM alpine:latest
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-04-02"

# alpine uses apk for pkg mgmg
# no cache erases cache so smaller image
# equiv to apk update in the beginning and rm -rf /var/cache/apk/*
RUN apk add --no-cache xeyes

ENTRYPOINT [ "/usr/bin/xeyes", "-fg", "purple" ]
# todo, play with stacking multiple xeyes to determine when container process ends
# todo & what happens to output, when I launch in bg as below, noting is displayed but container persists
# CMD /usr/bin/xeyes -fg blue  
#; /usr/bin/xeyes -fg green & ; 
# /usr/bin/xeyes -fg brown & ; \
#       /usr/bin/xeyes -fg purple & ; /usr/bin/xeyes -fg pink &
