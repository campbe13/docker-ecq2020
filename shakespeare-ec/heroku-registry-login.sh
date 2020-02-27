#!/bin/bash
# login to heroku registry
# using api key from dashboard.heroku.com for my userid 

token=`cat heroku-auth-token.txt`
#docker login --username=_ --password=$(heroku auth:token) registry.heroku.com
docker login --username=_ --password=$token registry.heroku.com
