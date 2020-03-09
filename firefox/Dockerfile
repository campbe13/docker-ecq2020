# PMC 2020-02-06
# run firefox from a container
FROM alpine:latest

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-26"

# alpine uses apk for pkg mgmg
# no cache erases cache so smaller image
# equiv to apk update in the beginning and rm -rf /var/cache/apk/*
RUN apk add --no-cache firefox-esr \
	dumb-init \
        dbus-x11 \
	mesa-dri-intel \
	mesa-gl \
	xvfb \
	ttf-freefont

# X11 display environment variable needed
# ENV DISPLAY :5

# launch
ENTRYPOINT [ "/usr/bin/dumb-init", "/usr/bin/firefox"]
#CMD ["https://www.dawsoncollege.qc.ca"]
