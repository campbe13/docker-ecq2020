# running this image from docker hub  (on *nix @ cli)

The first time it has to pull the image

Note where you see `$(pwd)` this uses command substitution to give the current working directory.
```
[tricia@acerfed31 Documents]$ docker run --rm --volume "$(pwd):/data" dawsoncollege2020/pandocker:0.1.0
Unable to find image 'dawsoncollege2020/pandocker:0.1.0' locally
0.1.0: Pulling from dawsoncollege2020/pandocker
aad63a933944: Already exists
aad63a933944: Already exists
2dc6126e53cd: Pull complete
73b1999d78d6: Pull complete
209b3e3194d9: Pull complete
c0f6814a4329: Pull complete
754f709cd244: Pull complete
68250184cd37: Pull complete
Digest: sha256:aa9ed1186fe307fc811d03af5b6120313b218124b82b78c87df8541ce932ee87
Status: Downloaded newer image for dawsoncollege2020/pandocker:0.1.0
```

Subsequent runs are faster 
```
[tricia@acerfed31 Documents]$ docker run -ti --rm --volume "$(pwd):/data" dawsoncollege2020/pandocker:0.1.1
pandoc.sh file to convert must be in current working directory

source file to convert file name
myword.docx
destination file name
out.txt
convert to type ex markdown
markdown
pandoc.sh see converted file out.txt in the current working directory
[tricia@acerfed31 Documents]$ ls myword.docx out.txt  -la
-rw-rw-r--. 1 tricia tricia 33213 Apr 17 16:12 myword.docx
-rw-r--r--. 1 tricia tricia 20393 Apr 17 16:28 out.txt
[tricia@acerfed31 Documents]$

````
You can use a config file, here is an example
```
# this config file must be 
# >>> in the same directory as the files to be converted
# >>> named config.pandoc

# 2 options for using it:

# Option 1 give the complete command line options, if this exists, the rest will be ignored
CMDLINE='-s moodlequiz.docx -o moodlequiz.text  -t mediawiki'


# Option 2 individual options
IN="420-241-DW-01-02-Campbell_2019.docx"
OUT=test.txt
#TYPE=mediawiki
TYPE=markdown
```
Example run using config.pandoc
```
[tricia@acerfed31 Documents]$ docker run -ti --rm --volume "$(pwd):/data" dawsoncollege2020/pandocker:0.1.1
pandoc.sh see converted file myword.md in the current working directory
[tricia@acerfed31 Documents]$ cat config.pandoc
IN=myword.docx
OUT=myword.md
TYPE=markdown
[tricia@acerfed31 Documents]$ head myword.md
---
subtitle: |
  Dawson College\
  Computer Science Department\
  Course Outline
title: Introduction to Programming
---

**Course Number:** 420-BXC-03**\
Ponderation:** 1.5-1.5-3\
```
