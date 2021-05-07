#!/bin/bash 
# run the weatherapp container
# docker must be installedo for this to work
# pmcampbell
# 2021-05-06

which docker 2>&1 > /dev/null
if [[ $? -ne 0 ]] ; then
    echo docker not installed, cannot launch weatherapp 
fi

port=8765
if [[ $# -eq 0 ]] ; then 
   echo using default port $port
else 
   port=$1
fi
echo using port $port

docker run -d -p $port:80 tricia/weatherapp

if [[ $? -eq 0 ]] ; then
    echo access the weatherapp http://127.0.0.1:$port
fi
