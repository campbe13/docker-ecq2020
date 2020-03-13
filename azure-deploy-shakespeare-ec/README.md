# deploy to Azure
This directory has a [Makfile](Makefile) with the instructions needed to deploy to Azure

We are using the [shakespeare-ec](../shakespeare-ec) app.
The image was created and tested locally, using a docker engine, see the link, the steps involved here are for deployment. 

Note the [azure cli must be installed](https://docs.microsoft.com/en-us/cli/azure/install-azure-cli?view=azure-cli-latest) to use this Makfile.

Note: acr is the Azure Container Registry

Refs
* https://docs.microsoft.com/en-us/azure/container-instances/container-instances-tutorial-prepare-acr
* https://docs.microsoft.com/en-us/azure/container-instances/container-instances-tutorial-deploy-app

See also [runtime for the steps below](RUNTIMEAZURE.md)

## push image to acr 
In order to run an app it must be in the container registry for Azure, these steps push to the registry:

1. create a resource group `az group create` 
2. create an Azure container registry `az acr create`
2. login to container registry `az acr login` 
3. tag the local image with the registry name 
    1. get the full name `az acr show`
    2. tag the image `docker tag`
4. push the image to Azure Container registry `docker push`
## deploy application
Once the app is in Azure Container registry you can deploy it. 

6. deploy the container `az container create`
7. verify deployment & get the FQDN `az container show`
8. test the app using FQDN in a browser
9. view the container logs `az container logs`
## clean up resources
Since you are paying for everything, if you don't need this app and once you have finished with your app (or your tests) you must clean up by deleting everything.

Note: If you wish to depoloy permanently you would not do this step.

10. delete the group `az group delete`
 

