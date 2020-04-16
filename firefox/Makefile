# makefile to build a container to run firefox
# pmcampbell
# 2020-04-16

include	 config.make
XAUTH := ~/.Xauthority

# .PHONY used if no options given
.PHONY: help
	@echo set up xeyes container  
help: ## put help info here
	@echo
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

all: build run ## build and run
build: ## build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . -f $(DOCKERFILE)

run:  ## run the container, interactive
# -i interactive  (used for testing)
# --rm container is ephemeral (used for testing)
# -t pseudo tty attached to stdin of container (defaults to false) 
# not needed, host has authority
# xhost + 
# if you omit the --net=host, you will get the error:
# Error: Can't open display:
	docker run --net=host --rm -e DISPLAY=${DISPLAY} -v ${XAUTH}:/root/.Xauthority --name $(RUN_NAME)  $(CONTAINER_IMAGE)
 
sh:	shell  ## use shell
	# --rm removed so container remains & we can shell into it
shell:  ## shell into the container
	docker run -ti --net=host -e DISPLAY=${DISPLAY} -v ${XAUTH}:/root/.Xauthority --name $(RUN_NAME)  $(CONTAINER_IMAGE)
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
