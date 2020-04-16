#!/bin/bash
# pmc
# 2020-04-15
# see Dockerfile
# using node slim, learn javascript & node.js
# courses https://nodeschool.io/
# this menu is launched when the container is run

ans=0
while [[ $ans != q && $ans != q ]] ; do 
	read -p "j to learn javascript, n to learn node.js r to run your app (q to quit)" ans 
	if [[ $ans == j || $ans == J ]] ; then
		/usr/local/bin/javascripting
	#        exit 0   # should be ans=q	
        fi
	if [[ $ans == n || $ans == N ]] ; then
		/usr/local/bin/learnyounode
	#        exit 0   # should be ans=q	
        fi
	if [[ $ans == r || $ans == R ]] ; then
 		read -p "what is your app must be in ./app/ to be run" app
		if [[  -f /app/$app ]] ; then 
     		  /usr/local/bin/node /app/$app
		else
		  echo /app/$app does not exist
		fi
        fi
  
done
