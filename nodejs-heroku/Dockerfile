# dockerfile for nodejs app (to be pushed to heroku
# 2021-05-06
# BUILD   docker build -t nodeh . 
# RUN     docker run  -t nodeh . 


FROM node
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-05-06"
 
# create an app dir 
WORKDIR /app

# populate with the node app
COPY app/ ./

# set up 
RUN npm install
RUN npm run build-ts
RUN adduser -D myuser

USER  myuser

# expose the node port on the container
EXPOSE 3000 

# start  node.js
ENTRYPOINT ["npm", "run", "start"]
