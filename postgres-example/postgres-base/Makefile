# set up an instance of postgres
# ref https://hub.docker.com/_/postgres

VERSION=latest
NAME=postgres-pmc
HUBUSER=dawsoncollege2020
HOST_PORT=5432
CONTAINER_PORT=5432

# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo set up postgres container
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## build the image
	docker build -t ${NAME} .

#  source file
run:  ## run the image
	docker run -d -p ${HOST_PORT}:${CONTAINER_PORT}  ${NAME} ${NAME} 

debug:  ## run the image
	docker run -p ${HOST_PORT}:${CONTAINER_PORT} -v pgdata:/var/lib/postgresql/data  ${NAME} ${NAME} 


publish: ## publish to docker hub
	docker tag ${NAME} ${HUBUSER}/${NAME}:${VERSION} 
	docker image push ${HUBUSER}/${NAME}:${VERSION}

clean: ## stop & remove the container 
	docker stop $(NAME) ; docker rm $(NAME) ; docker ps

logs:  watch ## watch the logs 
watch: ## watch the logs  
	@echo CTRL-C to end 
	docker logs  ${NAME} 
