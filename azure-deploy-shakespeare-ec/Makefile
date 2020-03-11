# Makefile to deploy to azure
# tested locally and on heroku
#
# using shakespeare-ec 
#
# registry name group name etc in config.make
include config.make

# .PHONY used if no options given
.PHONY: help
#
# help
# The awk will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
#
HELP: help 
help: ## This help.
	@echo deploy to azure using shakespeare-ec
	@echo
	@echo see below content of config.make file 
	@cat config.make
	@echo
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

accountset: ## set account id from azure website
	@echo setting my Free tier subs account 
	az account set -s 9d9aab4e-c397-4dbc-911e-23589a5c3973

login: logon
logon: ## login to azure container registry
	az acr login --name=$(REGISTRY) 


list: ## list repo
	az acr repository list --name=$(REGISTRY) --output table
	az acr repository show --verbose --repository $(REGISTRY)

creategroup: ## create the resource group
	az group create --name=$(GROUP) --location=$(LOCATION)

createreg: createregistry
createregistry: ## create the registry
	az acr create --resource-group=$(GROUP) --location=$(LOCATION) --name=$(REGISTRY) -sku Basic 

showname: ## show registry full name
	@echo displaying registry full name
	az acr show --name=$(REGISTRY) --queryLoginServer --output table
tagimage: ## tag the image with repository
	@echo tagging the image for azure
	docker tag $(IMAGELOCAL) $(REGISTRYFULL)/$(IMAGE)
	docker images

push: ## push to azure
	az acr push $(REGISTRYFULL)/$(IMAGE)
# dollar slash newline ignores white space
# https://www.gnu.org/software/make/manual/html_node/Splitting-Lines.html
createapp: ## create the app / container on azure
	az container create --resource-group=$(GROUP) $\
	    --name=$(IMAGE) $\ 
	    --image=$(REGISTRYFULL)/$(IMAGE) $\
	    --cpu 1 --memory 1 $\
	    --registry-login-server $(REGISTRYFULL) $\
	    --registry-username $(USER) 
