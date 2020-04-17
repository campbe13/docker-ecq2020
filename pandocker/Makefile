# set up a pandoc image
# ref https://github.com/pandoc/dockerfiles#basic-usage

VERSION=0.1.1
NAME=pandocker
HUBUSER=dawsoncollege2020

# .PHONY used if no options given
.PHONY: help
help: ## put help info here
	@echo set up pandoc container
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

build: ## build the image
	docker build -t ${NAME} .

# note the following must be in ./
#  config.pandoc
#  source file
run:  ## run the image
	docker run --rm --volume "`pwd`:/data"  -ti ${NAME}

publish: ## publish to docker hub
	docker tag ${NAME} ${HUBUSER}/${NAME}:${VERSION} 
	docker image push ${HUBUSER}/${NAME}:${VERSION}

