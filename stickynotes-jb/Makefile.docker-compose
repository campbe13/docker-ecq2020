# Makefile to build use docker-compose to build container images & push to hub.docker.com
# pmcampbell
# 2020-03-03

include config.make
#export $(shell sed 's/=.*//' $(cnf))
 
# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo vars set via config.make
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo containers $(CONTAINER1)  $(CONTAINER2)  $(CONTAINER3)
	@echo port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)	
	@echo
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

	
build: ## build container images from docker-compose.yaml
	docker-compose build 

# port forwarding is in the yaml file
up: run
run:  ## bring up all containers, detached (~in the background )
	docker-compose up -d
	docker-compose ps 

logs: ## show logs for the containers
	docker-compose logs -f

logsdb: ## show logs for the containers
	docker-compose db  logs -f

run-fg:  ## bring up all containers, logs to stdout, console unavailable
	docker-compose up

runone:  ## bring up $(CONTAINER1), logs to stdout, console unavailable
	@echo bringing up $(CONTAINER1)
	docker-compose up $(CONTAINER1)

runtwo:  ## bring up $(CONTAINER2), logs to stdout, console unavailable
	@echo bringing up $(CONTAINER2)
	docker-compose up $(CONTAINER2)

runthree:  ## bring up $(CONTAINER3), logs to stdout, console unavailable
	@echo bringing up $(CONTAINER3)
	docker-compose up $(CONTAINER3)

sh:	shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh

all: clone build run

stoprun: stop run
clean:  stop prune

stop: ## stop and remove the containers
	docker-compose stop ; docker-compose rm ; docker ps

prune:  # clean up unused containers
	docker system prune -f
	docker images

check:  ## check docker run time
	systemctl status  docker
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
 
