# Using pandocker on Windows
This container will allow you to run [pandoc](pandoc.org) whenever you need it, without installing it on your windows box. 

It puts a simple bash script as a front end to pandoc.  You give it have an input file, pandoc will determine the type, output file name and the output file conversion type.  Or you can give it, fullm more complex pandoc options see the [example](#example)

__Note__ The container works by "sharing" a volume on your windows computer, in the run statement.  That volume needs to contain your *source file* to be converted and _optionally_ a *config.pandoc file* to instruct the container what to convert. 

There are 2 ways of using this container:

1. using a config file (`config.pandoc` or `config.pandoc.txt`) the bash script reads the config & performs the requested actions
2. interactively, clunky, type in your info to a bash script

The container is public and in the organization [dawsoncollege2020](https://hub.docker.com/u/dawsoncollege2020).

## One time prep	
This will have to be done once only, afterward & if you've already set up docker go to the [run](#run) section.
1.  Install [Docker Desktop on Windows](https://docs.docker.com/docker-for-windows/install/)
2.  Create a [docker hub account](https://hub.docker.com/)  can also be done via Docker Desktop
3.  Sign into docker hub via Docker Desktop (click on the docker icon, then `Sign in / Create Docker ID`)
4.  Drives are not automatically shared with Docker Desktop so you must change the config before you start the container. Click on the docker icon, select settings, a window will launch, select resources, you will see, make sure the drive that you want to use is selected. ![Docker settings - resources](docker-desktop-share-volumes-c.PNG)

## Run
### headless using config.pandoc 
Determine where the file to be converted and the config.pandoc file are on your windows system the example below assumes in your Documents directory, example `C:\Users\pcampbell\Documents>`  

The easiest way to use this is using a config file
1. Create a file in your Documents directory,  `config.pandoc` or `config.pandoc.txt`, example contents:
     ```
     OUT=win-my-word.md		# destination file name
     IN=win-my-word.docx      	# file to be converted
     TYPE=markdown		# conversion type
     ```
1. Open a Command Prompt
2. Run the following in a Command Window `docker run --rm --volume "%USERPROFILE%\Documents:/data"  -ti dawsoncollege2020/pandocker`

Did you get a weird `No such file or directory` when it's clearly there?  Just retry, see [error](#no-such-file)

Note the first time you run this it will take longer as it has to download the image (~300MB,) subsequent runs will use the local copy. 

That\'s it, if there are no typos you will see `myword.md` in the same Documents directory.
### headless run time example
```
PS C:\Users\pcampbell\Documents> docker run --rm --volume "$env:USERPROFILE\Documents:/data"  -ti dawsoncollege2020/pandocker
                                             end
pandoc.sh about to convert source win-my-word.docx to markdown destination win-my-word.md
pandoc.sh see converted file win-my-word.md in the current working directory
PS C:\Users\pcampbell\Documents> ls win-my*


    Directory: C:\Users\pcampbell\Documents


Mode                LastWriteTime         Length Name
----                -------------         ------ ----
-a----        11/4/2019   2:26 PM          14945 win-my-word.docx
-a----        4/20/2020   6:15 PM          14526 win-my-word.md
 
```

### interactively ( config.pandoc  does not exist )
Your file must be in the shared volume, if a config.pandoc exists it will be used, so delete if you don't want it.
1. Open a Command Prompt
2. Run the following in a Command Window `docker run --rm --volume "%USERPROFILE%\Documents:/data"  -ti dawsoncollege2020/pandocker`
3. respond to the text prompts

### interactive runtime example
```
C:\Users\pcampbell\Documents>docker run --rm --volume "%USERPROFILE%\Documents:/data"  -ti dawsoncollege2020/pandocker
pandoc.sh file to convert must be in current working directory

source file to convert file name
win-my-word.docx
destination file name
out.md
convert to type ex markdown
markdown
pandoc.sh see converted file out.md in the current working directory
C:\Users\pcampbell\Documents>dir win-my*
 Volume in drive C is Windows x64 Bit
 Volume Serial Number is D096-AD0C

 Directory of C:\Users\pcampbell\Documents

11/04/2019  03:26 PM            14,945 win-my-word.docx
04/20/2020  06:15 PM            14,526 win-my-word.md
               2 File(s)         29,471 bytes
               0 Dir(s)  823,968,378,880 bytes free
```

## example config file named config.pandoc or config.pandoc.txt
[config.pandoc](full.example.config.pandoc)
```
# this config file must be  in the same directory as the files to be converted
# anything begining with a hashtag is a comment
# 2 options
# Option 1 give the complete command line options, if this exists, the rest will be ignored
CMDLINE='-s moodlequiz.docx -o moodlequiz.text  -t mediawiki'

# Option 2 individual options
IN="420-241-DW-01-02-Campbell_2019.docx"
OUT=test.txt
#TYPE=mediawiki
TYPE=markdown
```
## Sharing drives
Drives are not automatically shared so you must change the config before you start the container.
Click on the docker icon, select settings, a window will launch, select resources you will see, make sure the drive that you want to use is selected.  
![Docker settings - resources](docker-desktop-share-volumes-c.PNG)


## Errors 
### file not found
There is an intermittent open  bug Docker for Windows where files are not found, there is no fix as of 2020-04-20 so just run again if you get `No such file or directory` when it's clearly there.   

Open Bug https://github.com/docker/for-win/issues/5959 

   ```
   PS C:\Users\pcampbell\Documents> docker run --rm --volume "$env:USERPROFILE\Documents:/data"  -ti dawsoncollege2020/pandocker
   /usr/bin/pandoc.sh: source: line 44: can't open 'config.pandoc.txt': No such file or directory
   PS C:\Users\pcampbell\Documents> ls .\config.pandoc.txt


       Directory: C:\Users\pcampbell\Documents


   Mode                LastWriteTime         Length Name
   ----                -------------         ------ ----
   -a----        4/20/2020   2:08 PM            212 config.pandoc.txt
   ```


### drive not shared 
The following is what you will  see if the drive is not shared:

via cmd window
```
C:\Users\pcampbell>echo %USERPROFILE%
C:\Users\pcampbell
C:\Users\pcampbell>docker run --rm --volume "%USERPROFILE%\Documents:/data"  -ti dawsoncollege2020/pandocker
docker: Error response from daemon: status code not OK but 500: {"Message":"Unhandled exception: Drive has not been shared"}.
See 'docker run --help'.
```
via PowerShell
```
PS C:\Users\pcampbell\Documents> echo $env:USERPROFILE
C:\Users\pcampbell
PS C:\Users\pcampbell\Documents> docker run --rm --volume "$env:USERPROFILE\Documents:/data"  -ti dawsoncollege2020/pandocker
C:\Program Files\Docker\Docker\resources\bin\docker.exe: Error response from daemon: status code not OK but 500: {"Message":"Unhandled exception: Drive has not been shared"}.
See 'C:\Program Files\Docker\Docker\resources\bin\docker.exe run --help'.
PS C:\Users\pcampbell\Documents>
```
### not logged on or name typo
via cmd window
```
C:\Users\pcampbell>docker run --rm --volume "%USERPROFILE%\Documents:/data"  -ti dawsoncollege2020/pandokcer
Unable to find image 'dawsoncollege2020/pandokcer:latest' locally
docker: Error response from daemon: pull access denied for dawsoncollege2020/pandokcer, repository does not exist or may require 'docker login': denied: requested access to the resource is denied.
See 'docker run --help'.
```

