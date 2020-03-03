#!/bin/bash

# find all todo in markdown files 

fn=TODOREADME.md

echo "# All todos from the markdown files:" >$fn  

echo "do not edit, this will be clobbered">>$fn

echo "Created  $(date +%F) $(date +%r)">>$fn
echo -e "\n## list of todos\n">>$fn

grep -i todo `find ./ -name "*.md"` 2>/dev/null >> $fn

