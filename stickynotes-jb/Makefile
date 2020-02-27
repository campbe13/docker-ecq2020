# Makefile to build docker image & push to hub.docker.com
# very helpful original :
# https://gist.github.com/mpneuried/0594963ad38e68917ef189b4e6a269db
# pmcampbell
# 2020-2-19

include config.make
#export $(shell sed 's/=.*//' $(cnf))
 
# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo Makefile for container $(RUN_NAME) 
	@echo clone: $(GIT_REPO)
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)	

# clone (need keys, or interactive w uid/pass)
clone: ## 	clone
	if [ -d app ] ; then  rm -rf app; fi
	mkdir app;  git clone $(GIT_REPO) app
	tar -czf app.tgz app
 
build: ##   build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . 

run-fg:  ## run the container logs to stdout
	docker run -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)

run:  ## run the container detached (~in the background )
	docker run -d -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
	docker ps 

sh:	shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh

all: clone build run
up:  build run

stoprun: stop run
clean:  stop prune

stop: ## stop and remove the container
	docker stop $(RUN_NAME) ; docker rm $(RUN_NAME) ; docker ps

prune:  # clean up unused containers
	docker system prune -f
	docker images

check:  ## check docker run time
	systemctl status  docker
	docker version
	docker images
	docker ps

publish:   
	@echo publish to  docker hub, interactive 
        ifdef DOCKER_USER
		docker login   -u $(DOCKER_USER)
        else
		docker login 
        endif
	docker image push $(CONTAINER_IMAGE):latest
