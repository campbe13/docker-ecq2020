# whalesay
This is a proof of concept container to test creating simple containers. I found it through some tutorial, lost the link.  The base image is docker/whalesay.  This container runs with a one time output the cowsay app, using a whale image, and then displays a text from fortune using figlet.

## TL;DR run this app
1. [Install docker](https://docs.docker.com/install/)
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. run `docker run tricia/whalesay1`, you will see 
```
[tricia@acerfed31 ~]$ docker run tricia/whalesay1
 _____________________________________
/ Everything will be just tickety-boo \
\ today.                              /
 -------------------------------------
    \
     \
      \
                    ##        .
              ## ## ##       ==
           ## ## ## ##      ===
       /""""""""""""""""___/ ===
  ~~~ {~~ ~~~~ ~~~ ~~~~ ~~ ~ /  ===- ~~~
       \______ o          __/
        \    \        __/
          \____\______/
 ___   _                      _            _
|_ _| | | _____   _____    __| | ___   ___| | _____ _ __
 | |  | |/ _ \ \ / / _ \  / _` |/ _ \ / __| |/ / _ \ '__|
 | |  | | (_) \ V /  __/ | (_| | (_) | (__|   <  __/ |
|___| |_|\___/ \_/ \___|  \__,_|\___/ \___|_|\_\___|_|

[tricia@acerfed31 ~]$
```
## build this image
See the [Dockerfile](Dockerfile) for how it was created, it uses the base image [github whalesay](https://github.com/docker/whalesay) which is a base image of alpine with cowsay installed, but the image on [docker hub](https://hub.docker.com/r/docker/whalesay) may be ubuntu

## Scripts
There are three scripts in this directory
* [build & run container locally](build.run.sh)
* [check docker on your system](chk.sh)
* [push to docker hub registry](tohub.sh)

##  Docker hub
The image is in my registry so it may be run from the command line

https://hub.docker.com/repository/docker/tricia/whalesay1
