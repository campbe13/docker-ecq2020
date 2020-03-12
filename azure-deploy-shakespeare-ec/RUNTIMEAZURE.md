# runtime for azure deployment

## delete group
```
[tricia@korra azure-deploy-shakespeare-ec]$ make deletegroup
az group delete --name testgroup1
Are you sure you want to perform this operation? (y/n): y
```
## create group
```
[tricia@korra azure-deploy-shakespeare-ec]$ make creategroup
az group create --name testgroup1 --location eastus
{
  "id": "/subscriptions/9d9aab4e-c397-4dbc-911e-23589a5c3973/resourceGroups/testgroup1",
  "location": "eastus",
  "managedBy": null,
  "name": "testgroup1",
  "properties": {
    "provisioningState": "Succeeded"
  },
  "tags": null,
  "type": "Microsoft.Resources/resourceGroups"
}
```
## create registry within group
```
[tricia@korra azure-deploy-shakespeare-ec]$ make createregistry
az acr create --resource-group testgroup1 --location eastus --name pmctestregistry1 --sku Basic
{
  "adminUserEnabled": false,
  "creationDate": "2020-03-12T17:09:38.687085+00:00",
  "dataEndpointEnabled": false,
  "dataEndpointHostNames": [],
  "encryption": {
    "keyVaultProperties": null,
    "status": "disabled"
  },
  "id": "/subscriptions/9d9aab4e-c397-4dbc-911e-23589a5c3973/resourceGroups/testgroup1/providers/Microsoft.ContainerRegistry/registries/pmctestregistry1",
  "identity": null,
  "location": "eastus",
  "loginServer": "pmctestregistry1.azurecr.io",
  "name": "pmctestregistry1",
  "networkRuleSet": null,
  "policies": {
    "quarantinePolicy": {
      "status": "disabled"
    },
    "retentionPolicy": {
      "days": 7,
      "lastUpdatedTime": "2020-03-12T17:09:41.249585+00:00",
      "status": "disabled"
    },
    "trustPolicy": {
      "status": "disabled",
      "type": "Notary"
    }
  },
  "privateEndpointConnections": [],
  "provisioningState": "Succeeded",
  "resourceGroup": "testgroup1",
  "sku": {
    "name": "Basic",
    "tier": "Basic"
  },
  "status": null,
  "storageAccount": null,
  "tags": {},
  "type": "Microsoft.ContainerRegistry/registries"
}
```
## login registry
note credentials are cached but if they expire you will be prompted to use you azure userid & password.
```
[tricia@korra azure-deploy-shakespeare-ec]$ make login
az acr login --name=pmctestregistry1
Login Succeeded
```
## get the full name of the registry
Note loginServer is case sensitive, use as is
```
[tricia@korra azure-deploy-shakespeare-ec]$ make show
displaying registry full name
az acr show --name=pmctestregistry1 --query loginServer --output table
Result
---------------------------
pmctestregistry1.azurecr.io
[tricia@korra azure-deploy-shakespeare-ec]$
```
## tag the image
### show my local images
```
[tricia@korra azure-deploy-shakespeare-ec]$ docker images |grep ec
registry.heroku.com/shakespeare-ec/web   latest              25ff9fd85e81        9 days ago          544MB
tricia/shakespeare-ec                    latest              8524faf9b7b8        2 weeks ago         602MB
registry.heroku.com/shakespeare-ec       latest              8524faf9b7b8        2 weeks ago         602MB
mcr.microsoft.com/azure-cli              latest              a04d4fbfec24        3 weeks ago         1.13GB
```
### tag it
```
[tricia@korra azure-deploy-shakespeare-ec]$ make tag
tagging the image for azure
docker tag tricia/shakespeare-ec pmctestregistry1.azurecr.io/shakespeare-ec
[tricia@korra azure-deploy-shakespeare-ec]$ docker images |grep ec
registry.heroku.com/shakespeare-ec/web       latest              25ff9fd85e81        9 days ago          544MB
tricia/shakespeare-ec                        latest              8524faf9b7b8        2 weeks ago         602MB
pmctestregistry1.azurecr.io/shakespeare-ec   latest              8524faf9b7b8        2 weeks ago         602MB
registry.heroku.com/shakespeare-ec           latest              8524faf9b7b8        2 weeks ago         602MB
mcr.microsoft.com/azure-cli                  latest              a04d4fbfec24        3 weeks ago         1.13GB
[tricia@korra azure-deploy-shakespeare-ec]$
```
## docker push to Azure container registry
### push
```
[tricia@korra azure-deploy-shakespeare-ec]$ make push
docker push pmctestregistry1.azurecr.io/shakespeare-ec
The push refers to repository [pmctestregistry1.azurecr.io/shakespeare-ec]
407a07d5677e: Pushed
06f0bf03abbd: Pushed
2791ffca167d: Pushed
aabd4f73716b: Pushed
da963c2c588e: Pushed
4b2d47d63ce6: Pushed
f4e793a59364: Pushed
c3771624535e: Pushed
3e016e2d5575: Pushed
15e64324ff74: Pushed
c0f42f48af8f: Pushed
0a86f8bd2920: Pushed
63bdd471b6c2: Pushed
68ec2faa35f5: Pushed
1d9b8efc8fda: Pushed
f6240605700a: Pushed
e501e93022bc: Pushed
00ad11a7d941: Pushed
488dfecc21b1: Pushed
latest: digest: sha256:d65be32b2a2b31db3d650907cf308e2aa3d82ffd2a75c3de12d6ac8fc0418215 size: 4300
```
### show results ??
```
[tricia@korra azure-deploy-shakespeare-ec]$ make list
az acr repository list --name=pmctestregistry1 --output table
Result
--------------
shakespeare-ec
az acr repository show-tags --verbose --name pmctestregistry1 --repository shakespeare-ec --output
able
Configured default 'pmctestregistry1' for arg registry_name
Attempting to retrieve AAD refresh token...
Result
--------
latest
command ran in 2.189 seconds.
[tricia@korra azure-deploy-shakespeare-ec]$
```
## create container app 
todo fix problemes creating container app
```
[tricia@korra azure-deploy-shakespeare-ec]$ make createapp
az container create --resource-group testgroup1 --name shakespeare-ec --image pmctestregistry1.azurecr.io/shakespeare-ec  --cpu 1 --memory 1 --registry-login-server pmctestregistry1.azurecr.io --registry-username tricia --ports 80
Image registry password:
The image 'pmctestregistry1.azurecr.io/shakespeare-ec' in container group 'shakespeare-ec' is not accessible. Please check the image and registry credential.
make: *** [createapp] Error 1
[tricia@korra azure-deploy-shakespeare-ec]$ fg
-bash: fg: current: no such job
[tricia@korra azure-deploy-shakespeare-ec]$ vi Makefile

[1]+  Stopped                 vim Makefile
[tricia@korra azure-deploy-shakespeare-ec]$ make createapp
az container create --resource-group testgroup1 --name pmctestregistry1 --image pmctestregistry1.azurecr.io/shakespeare-ec  --cpu 1 --memory 1 --registry-login-server pmctestregistry1.azurecr.io --registry-username tricia --ports 80
Image registry password:
The image 'pmctestregistry1.azurecr.io/shakespeare-ec' in container group 'pmctestregistry1' is not accessible. Please check the image and registry credential.
make: *** [createapp] Error 1
[tricia@korra azure-deploy-shakespeare-ec]$
```

