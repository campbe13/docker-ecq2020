#!/bin/sh
# pcampbell
# 2020-04-17 
# trying to make pandoc easier ???
# 2020-04-20
# allow for config.pandoc.txt (windows may add the .txt by default)

# the "beauty" of global vars ?
# all are either sourced from the config
# or read in 
panconvert () {
	echo "                                             end"
        if [[ -z $IN ]] || [[ -z $OUT ]] || [[ -z $TYPE ]] ; then
	   echo $sn cannot run, missing either '$IN $OUT or $TYPE'
	   return 4
	else 
	    # xargs needed to strip whitespace chars ex ^M (cr lf) 
            # windows interop filesystem issue
	    IN=$(echo $IN|xargs)
	    #echo '$IN' $IN
	    OUT=$(echo $OUT|xargs)
	    #echo '$OUT' $OUT
	    TYPE=$(echo $TYPE|xargs)
	    #echo '$TYPE' $TYPE
        fi
	echo $sn about to convert source $IN to $TYPE destination $OUT
   	if [[ ! -e $IN ]] ; then
	   echo $sn cannot run, file missing $IN 
	   return 5
        fi
   	if [[ -e $OUT ]] ; then
	   echo $sn cannot run, will clobber file $OUT 
	   return 6
        fi
	/usr/bin/pandoc -s $IN -o $OUT -t $TYPE
	if [[ $? -eq 0 ]] ; then
	    echo $sn see converted file $OUT in the current working directory
        fi
}
dir=/data
sn=$(basename $0)
if [[ -e $dir/config.pandoc ]] || [[ -e $dir/config.pandoc.txt ]] ; then
      cd $dir
      source config.pandoc*
      if [[ ! -z $CMDLINE ]] ; then 
	 CMDLINE=$(echo $CMDLINE|xargs) #strip out whitespace
	 /usr/bin/pandoc $CMDLINE
      else 
	panconvert 
      fi
else 
      echo $sn file to convert must be in current working directory
      echo no config.pandoc file, going interactive: 
      echo 
      echo "source file to convert file name:"
      read  IN
      echo "destination file name:"
      read  OUT
      echo  "convert to type ex markdown:" 
      read  TYPE
      panconvert
fi
