# build stage
FROM golang:alpine AS build-env
ADD . /src
RUN cd /src && go build -o goapp
LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-03-06"

# final stage
FROM alpine
WORKDIR /app
COPY --from=build-env /src/goapp /app/
CMD ./goapp
