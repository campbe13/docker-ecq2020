# specify the node base image with your desired version node:<version>
# the https://hub.docker.com/_/node/ image notes recommend you use node:latest
# but in this case we could probably use alpine or slim???
FROM node:latest
RUN npm install -g javascripting && npm install -g learnyounode
WORKDIR /usr/local/bin
COPY menu.sh .
# shell for testing the image
# CMD sh
CMD ./menu.sh

