# set up a django image
# ref https://docs.docker.com/compose/django/

VERSION=0.1.1
NAME=django
HUBUSER=dawsoncollege2020

# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo set up pandoc container
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

all: build publish
build: ## build the image
	docker-compose --verbose build 

# port forwarding is in the yaml file
up: run
run:  ## bring up all containers, detached (~in the background )
	docker-compose up -d
	docker-compose ps 

publish: ## publish to docker hub
	docker tag ${NAME} ${HUBUSER}/${NAME}:${VERSION} 
	docker image push ${HUBUSER}/${NAME}:${VERSION}

