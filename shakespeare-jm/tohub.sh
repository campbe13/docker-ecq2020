#!/bin/bash
# pmc
# 2020-02-03
# some commands to push to docker hub

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi

# rename to correct namespace, my dockerid is tricia
#sudo docker image tag name:tag   dockerid/name:tag
#sudo docker image tag whalesay:latest   tricia/whalesay1
# update docker hub image
sudo docker image push tricia/whalesay1
