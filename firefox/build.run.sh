#!/bin/bash
# pmc
# 2020-02-06
# see Dockerfile
# using alpine image
# launch firefox

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

image="tricia/firefox"
read -p "hit enter to build $image"
docker build -t $image .

# show all images
docker images

read -p "hit enter to run $image"

# docker run $image  -p 6000:6063
# docker run -e DISPLAY=$DISPLAY  $image
docker run -e DISPLAY=unix$DISPLAY  $image \
 -v /tmp/.X11-unix:/tmp/.X11-unix
