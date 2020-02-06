# PMC 2020-02-06
# run firefox from a container
FROM alpine:latest

LABEL maintainer "P Campbell <pcampbell.edu@gmail.com>"

# alpine uses apk for pkg mgmg
# no cache erases cache so smaller image
# equiv to apk update in the beginning and rm -rf /var/cache/apk/*
RUN apk add --no-cache xeyes\
	dumb-init \
        x11vnc \
        xvfb \
	mesa-dri-intel \
	mesa-gl \
	ttf-freefont
RUN mkdir ~/.vnc
RUN x11vnc -storepasswd helpme ~/.vnc/passwd
# X11 display environment variable needed
# ENV DISPLAY :5

# launch
ENTRYPOINT [ "/usr/bin/dumb-init", "xeyes"]
# RUN xeyes -display $DISPLAY
#CMD ["https://www.dawsoncollege.qc.ca"]
