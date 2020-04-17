#!/bin/sh
# pcampbell
# 2020-04-17 
# trying to make pandoc easier ???

# the "beauty" of global vars ?
# all are either sourced from the config
# or read in 
panconvert () {
   	if [[ ! -e $IN ]] ; then
	   echo $sn cannot run $IN does not exist
	   exit 5
        fi
	/usr/bin/pandoc -s $IN -o $OUT -t $TYPE
	if [[ $? -eq 0 ]] ; then
	    echo $sn see converted file $OUT in the current working directory
        fi
}
dir=/data
sn=$(basename $0)
if [[ -e $dir/config.pandoc ]] ; then
      cd $dir
      source config.pandoc
      if [[ ! -z $CMDLINE ]] ; then 
	 /usr/bin/pandoc $CMDLINE
      else 
	panconvert 
      fi
else 
      echo $sn file to convert must be in current working directory
      echo 
      echo "source file to convert file name "
      read  IN
      echo "destination file name "
      read OUT
      echo  "convert to type ex markdown " 
      read  TYPE

      panconvert
#      /usr/bin/pandoc --help
#      echo $sn no config.pandoc found 
fi
