# dockerfile for node.js + sample app from docker 
# 2020-2-20

FROM node:current-slim
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-20"

# env var for apt-get otherwise I get the TERM not set error
ENV DEBIAN_FRONTEND noninteractive

WORKDIR /usr/src/app/

# install app
COPY app/*/package.json .

# install node stuff / app from package.json
RUN npm install 

# install the app
# not sure copy works properly ....
COPY app/*/*  .

# expose the website port
EXPOSE 8080

# start  redis server & train the model & launch apache   (systemctl not installed on this image )
CMD [ "npm", "start" ]
