# dockerfile for express & nodejs app 
# 2022-10-16
# BUILD   docker build -t mupps . 
# RUN     docker run  -d -p <host port>:3099  mupps
# 
# TODO deploy to heroku

FROM node
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2022-10-16"
 
# create an app dir  (also does a cd)
WORKDIR /app

# populate with the node app
ADD server/ ./

# set up 
# installs from package.json
RUN npm install   
#  don't need a userid
#RUN adduser -D myuser
#USER  myuser

# expose the node port on the container
EXPOSE 3099

# start  node.js
ENTRYPOINT ["node", "app.mjs"]
