# digital ocean demo
# 2020-04-16
# pmcampbell
# https://hub.docker.com/_/node/
FROM node:13.13.0-alpine3.10
RUN mkdir -p /home/node/app/node_modules && chown -R node:node /home/node/app
WORKDIR /home/node/app
COPY package.json ./
USER node
RUN npm install
COPY --chown=node:node . ./
EXPOSE 8111
ENTRYPOINT [ "node", "app.js" ]
