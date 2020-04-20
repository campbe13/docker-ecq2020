#  pandocker
You don't have to install pandoc, the idea here is to set up a container with a shared volume so that
you can use pandoc from a container.

If you use a [config.pandoc](config.pandoc) file to indicate the 
1. input file name
2. output file name
3. output file format

or

4. Instead: a single option to put in the full options

Configured with help from https://github.com/pandoc/dockerfiles#basic-usage

See the supporting [Dockerfile](Dockerfile) and the  [Makefile](Makefile)

Use pandoc core image (alpine based)

**__Note__** If you are newly learning docker I __strongly__ suggest you use the command line interface as it may be used anywhere: windoze, *nix, and cloud shells.  No need to learn new interfaces every time.

## TL;DR
### To run this app
1. install docker https://docs.docker.com/install/ 
    * on *nix you will need to add your user to the docker group to run as a regular user `sudo usermod -aG docker youruserid`
2. cd to the directory that holds your doc to convert, & config.pandoc if you're using it.
3. `docker run -ti --rm --volume "$(pwd):/data" dawsoncollege2020/pandocker`  

## run time
This image can be run interactively or using a file see example [config.pandoc](full.example.config.pandoc).  If config.pandoc* exists, it will be used, if not it will be interactive, the script will ask for source, destination files and the conversion type. 

* See *nix [runtime example](RUNFROMHUB.md) for complete information.  
* See the [windows how to](WINHOWTO.md) for running on windows

## docker registry image repo
Instructions also in [docker hub for pandocker](https://hub.docker.com/r/dawsoncollege2020/pandocker)
## create & run the container image
You will first have to clone this repo and cd into this directory, the build assumes the Dockerfile is in the current working directory. check the [Makefile](Makefile) for version info etc.
1. `make build`
2. `make run`
### docker commands
see  [common docker commands](../docker-usage-overview/DOCKERCMDS.md) 
### docker-compose commands
see  [common docker commands](../docker-usage-overview/DOCKERCOMPOSECMDS.md)


