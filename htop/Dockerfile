# running htop from a container
# build: $ docker build -t htopc .

# run:   $ docker run -it --rm --pid=host htopc .
# note:  --pid=host uses the namespace of the host

# run:   $ docker run -it --rm htopc sh
# note:  shell into it & try htop 

FROM alpine:latest
LABEL author="PMCampbell" created="2022-05-03"
LABEL description="trying htop in a container"
run apk add --update htop && rm -rf /var/cache/apk
CMD htop
