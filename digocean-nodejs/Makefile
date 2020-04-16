# makefile to build a container
# pmcampbell
# 2020-04-16

include	 config.make

# .PHONY used if no options given
.PHONY: help

help: ## put help info here
	@echo set up node shark demo app container
	@echo
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

all: build run ## build and run
build: ## build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . 


run-fg:  ## run the container, logs to stdout
	docker run -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
 
run:  ## run the container, detached (in the background)
	docker run -d -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
 
sh:	shell  ## use shell
	# --rm removed so container remains & we can shell into it
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) -e DISPLAY=${DISPLAY} -v ${XAUTH}:/root/.Xauthority sh

logs: ## show logs for the containers
	docker logs -f $(RUN_NAME)

restart: stoprun ## use stop then run
clean:  stop prune ## use stop then prune

stop: ## stop and remove the containers
	docker stop $(RUN_NAME) ; docker rm $(RUN_NAME) ; docker ps

prune:  # clean up unused containers
	docker system prune -f ; docker images

check:  ## check docker run time
	systemctl status  docker
	docker info
	docker version
	docker images
	docker ps
	docker-compose version

publish:   
	@echo publish to  docker hub, interactive 
	@echo be sure to tag it first with my repo tricia/imagename
        ifdef DOCKER_USER
		docker login   -u $(DOCKER_USER)
        else
		docker login 
        endif
	docker image push $(CONTAINER_IMAGE):latest
