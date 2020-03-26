# Makefile to build compile some java samples & build a container to deploy them.
#
# using this as reference https://mkyong.com/docker/docker-and-java-application-examples/
#
# pmcampbell
#
# 2020-03-25

include config.make
#export $(shell sed 's/=.*//' $(cnf))
 
# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo set up some simple java examples 
	@echo
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

all: compile build run  ## use compile, build, run

javac: compile ## use compile
compile: ## compile the java file into bytecode
	javac  *.java -target 11
	bash build.interface.sh 

buildrun: build run ## use build then run	
build: ## build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . 

up: run ## use run
run-fg: run  ## use run
run:  ## run the container, interactive 
	docker run -i --name $(RUN_NAME)  $(CONTAINER_IMAGE)
 
sh:	shell  ## use shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh

logs: ## show logs for the containers
	docker logs -f $(RUN_NAME)

restart: stoprun ## use stop then run
stoprun: stop run ## use stop then run
clean:  stop prune ## use stop then prune

stop: ## stop and remove the containers
	docker stop $(RUN_NAME) ; docker rm $(RUN_NAME) ; docker ps

prune:  # clean up unused containers
	docker system prune -f
	docker images

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
 
