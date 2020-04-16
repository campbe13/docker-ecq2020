# Makefile to build docker image & push to hub.docker.com
# pmcampbell
# 2020-2-20

include config.make
 
# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo Makefile for container $(RUN_NAME) 
	@echo clone: $(GIT_REPO)
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' 	

# clone (need keys, or interactive w uid/pass)
clone: ## 	clone
	if [ -d app ] ; then  rm -rf app; fi
	mkdir app;  git clone $(GIT_REPO) app
	tar -czf app.tgz app
 
build: ##   build container image from Dockerfile
        
	docker build -t $(CONTAINER_IMAGE) . 

run:  ## run the container 
	docker run -d -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
	docker ps 

sh:	shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh

all: clone build run
up:  build run

stop: ## stop and remove the container
	docker stop $(RUN_NAME) ; docker rm $(RUN_NAME) ; docker ps

check:  ## check docker run time
	systemctl status  docker  # hit q to continue
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

clean:  ## clean up extra images
	docker system prune -f    # force, no interactive
