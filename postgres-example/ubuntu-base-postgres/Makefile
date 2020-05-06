# set up a postgres  image

VERSION=latest
NAME=postgres-ubuntu-pmc
HUBUSER=dawsoncollege2020
HOST_PORT=5432
CONTAINER_PORT=5432

# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo set up pandoc container
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## build the image
	docker build -t ${NAME} .

#  source file
run:  ## run the image
#        docker run -t  tty true  -i interactive true
	docker run -d -p ${HOST_PORT}:${CONTAINER_PORT} --name ${NAME} ${NAME}

publish: ## publish to docker hub
	docker tag ${NAME} ${HUBUSER}/${NAME}:${VERSION} 
	docker image push ${HUBUSER}/${NAME}:${VERSION}

clean: ## stop & remove the container 
	docker stop $(NAME) ; docker rm $(NAME) ; docker ps
