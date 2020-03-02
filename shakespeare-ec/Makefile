# Makefile to build docker image & push to hub.docker.com
# very helpful original :
# https://gist.github.com/mpneuried/0594963ad38e68917ef189b4e6a269db
# pmcampbell
# 2020-02-19
# add heroku deployment using docker & using heroku 
# 2020-02-27

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
	@echo clone: $(GIT_REPO)
	@echo build: $(CONTAINER_IMAGE) 
	@echo run: $(RUN_NAME)
	@echo  port forward on run container:$(CONTAINER_PORT) to host:$(HOST_PORT)
	@echo 
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)


# clone (need keys, or interactive w uid/pass)
clone: ## clone & zip the repo into app.tgz
	if [ -d app ] ; then  rm -rf app; fi
	mkdir app;  git clone $(GIT_REPO) app
	tar -czf app.tgz app
 
build: ## build container image from Dockerfile
	docker build -t $(CONTAINER_IMAGE) . 

run-fg:  ## run the container logs to stdout
	docker run -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)

run:  ## run the container detached (~in the background )
	docker run -d -p $(HOST_PORT):$(CONTAINER_PORT) --name $(RUN_NAME)  $(CONTAINER_IMAGE)
	docker ps 

sh:	shell
shell:  ## shell into the container
	docker exec -ti $(RUN_NAME) sh

all: clone build run
up:  build run

stoprun: stop run
clean:  stop prune

stop: ## stop and remove the container
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

publish:   
	@echo publish to  docker hub, interactive 
        ifdef DOCKER_USER
		docker login   -u $(DOCKER_USER)
        else
		docker login 
        endif
	docker image push $(CONTAINER_IMAGE):latest

heroku-all: build tag heroku
heroku-tag: ## using heroku commands
heroku: ## using heroku commands
	@echo interactive login to heroku
	heroku login -i 
	@echo create app on heroku 
	heroku create $(RUN_NAME) 
	@echo push to the heroku repo
	heroku container:push web --app $(RUN_NAME)
	@echo release app
	heroku container:release web --app $(RUN_NAME)
	@echo if the last step worked load https://$(RUN_NAME).herokuapp.com in a browser

define tokenfile =
fn=heroku-auth-token.txt
heroku auth:token >> $fn
TOKEN=$(cat $fn)
endef 
# needed for bash script
# https://www.gnu.org/software/make/manual/html_node/One-Shell.html
.ONESHELL:

heroku-via-docker:  	## use heroku cli to generate token  not working, abandoned
	$(tokenfile)
	docker login --username=_ -- password=$(TOKEN) registry.heroku.com
	docker build -t registry.heroku.com/$(RUN_NAME)/web .
	docker push registry.heroku.com/$(RUN_NAME)/web
