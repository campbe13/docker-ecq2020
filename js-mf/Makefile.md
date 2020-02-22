## Imported by the Make`file 
see the `include config.make`

```
CONTAINER_IMAGE=tricia/shakespeare-ec
RUN_NAME=shakespeare-ec
HOST_PORT=8800
CONTAINER_PORT=80
GIT_REPO=git@github.com:campbe13/ecq2020-shakespeare-ec.git
DOCKER_REPO=$CONTAINER_IMAGE
```
## Makefile
```
# Makefile to build docker image & push to hub.docker.com
# very helpful original :
# https://gist.github.com/mpneuried/0594963ad38e68917ef189b4e6a269db
# pmcampbell
# 2020-2-19 / 2020-2-21

include config.make
#export $(shell sed 's/=.*//' $(cnf))
```
# help message
```
# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo Makefile for container $(RUN_NAME) 
	@echo clone: $(GIT_REPO)
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)	
```
# section to clone & package the repo, build assumes the app is in a tarball `./app.tgz``
```
# clone (need keys, or interactive w uid/pass)
clone: ## 	clone
#	if [ -d app ] ; then  rm -rf app; fi
#	mkdir app;  git clone $(GIT_REPO) app
	tar -czf app.tgz app
```
# build docker image, if we use a compiled language will need more builds
``` 
build: ##   build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . 
```
# run the container image: alternate run, omits `-d`  so console has control of console, logs to stdout
```
run-fg:  ## run the container logs to stdout
	docker run -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
```
# run the container image, detach `-d` then show running docker containers `ps`
```
run:  ## run the container detached (~in the background )
	docker run -d -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
	docker ps 
```
# shell into the app sh or shell
```
sh:	shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh
```
# combinations of 
```
all: clone build run
up:  build run

clean:  stop prune
stoprun: stop run
```

```
stop: ## stop and remove the container
	docker stop $(RUN_NAME) ; docker rm $(RUN_NAME) ; docker ps
```

```
prune:  # clean up unused containers
	docker system prune -f
	docker images
```

```
check:  ## check docker run time
	systemctl status  docker
	docker version
	docker images
	docker ps
```
push your code to a registry, depends what is configured on your system
```
publish:   
	@echo publish to  docker hub, interactive 
        ifdef DOCKER_USER
		docker login   -u $(DOCKER_USER)
        else
		docker login 
        endif
	docker image push $(CONTAINER_IMAGE):latest
```
