#!/bin/bash
# pmc
# 2020-02-06
# see Dockerfile
# using alpine image
# launch firefox

# is docker installed ?
which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

image="tricia/xeyes"

runimage () {
  # host.docker.internal:0  uses docker host machine
  docker run -e DISPLAY=host.docker.internal:0 \  
    -v /tmp/.X11-unix:/tmp/.X11-unix \
    $image 
}  
	
if [[ $# -ne 0 ]] && [[ $1 -eq "run" ]] ; then 
     runimage
     exit
fi
    
read -p "hit enter to build $image"
docker build -t $image .

# show all images
docker images

read -p "hit enter to run $image"
runimage
