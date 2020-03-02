# Makefile to deploy to heroku 
# used with an existing image, see Dockerfiles & 
# scripts in this directory for creation of the image itself
#
# heroku deployment using docker & using heroku cli 
# 2020-03-03

include config.make
#export $(shell sed 's/=.*//' $(cnf))
 
# .PHONY used if no options given
.PHONY: help

# HELP
# The awk will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html

help: ## This help.
	@echo vars from config.make:
	@echo Makefile for container $(RUN_NAME) 
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)
	@echo 
	@echo init runs: pull tag login create
	@echo dev runs: fix push release 
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)


# initialize, pull from docker, tag the image, loging to heroku, create app
init: pull tag login create

create: ## create the app on heroku, one time
	heroku create --app $(RUN_NAME)
#	show my apps on heroku
	heroku apps 
	heroku apps:info --app $(RUN_NAME)

login:	## heroku login, one time
	heroku login -i  
pull: ## pull image from docker registry if needed
	docker pull $(CONTAINER_IMAGE)
	docker images
tag: ## tag the image for heroku registry, one time
	docker tag $(CONTAINER_IMAGE) registry.heroku.com/$(RUN_NAME)

# dev cycle fix??, push to registry, release the app 
dev: fix push release
	
fix: ## fix for heroku issue 2020-03-03
	heroku labs:enable --app $(RUN_NAME) runtime-new-layer-extract


push: ## push image to heroku registry
	heroku container:push web --app shakespeare-ec

release: ## heroku release app, done after push
	heroku container:release web  --app $(RUN_NAME)
	@echo if the last step worked load https://$(RUN_NAME).herokuapp.com in a browser
#	also ok: heroku releases --app $(RUN_NAME)

check:  ## check docker run time
	heroku version
