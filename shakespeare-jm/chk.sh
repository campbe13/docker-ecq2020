#!/bin/bash
# pmc
# 2020-02-03
# some commands to see what's up with docker  

which docker >/dev/null
if [[ $? -ne 0 ]] ; then
   echo $(basename $0) docker not installed, quitting
   exit 5
fi
systemctl status  docker 
sudo docker version
sudo docker images


