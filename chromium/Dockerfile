# PMC 2020-04-16
# run chromium from a container
FROM alpine:edge 

LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-04-16"

# install chromium  (latest supported by alpine is v 77)
RUN apk add --no-cache \
      chromium \
      nss \
      freetype \
      freetype-dev \
      harfbuzz \
      ca-certificates \
      ttf-freefont \
      nodejs \
      yarn

RUN addgroup browser && adduser browser -D -G browser
USER browser
# launch
ENTRYPOINT [ "/usr/bin/chromium-browser", "https://www.facebook.com" ]
# for shelling into the container
# CMD sh
