# see 
# https://docs.microsoft.com/en-us/azure/container-instances/container-instances-tutorial-deploy-app#deploy-container
az container create --resource-group testgroup1 --name shakespeare-ec --image pmctestregistry1.azurecr.io/shakespeare-ec --cpu 1 --memory 1 --registry-login-server pmctestregistry1.azurecr.io --registry-username pcampbell@dawsoncollege.qc.ca  --registry-password  
