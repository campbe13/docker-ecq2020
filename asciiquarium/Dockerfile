# run asciiquarium in a container
# Author:   P.M. Campbell
# Build: 
#       docker build -t asciiq .
# Usage: 
#    	docker run -t asciiq
# --------------------------------------

# image to download alpine:latest 
FROM alpine

# maintainer/creater info key=value pairs
LABEL maintainer="P.M. Campbell"  email="pcampbell.edu@gmail.com" modified="2021-05"

# install the software, run on the image, creates new layer
RUN apk add asciiquarium

# runtime
CMD [ "asciiquarium" ] 
