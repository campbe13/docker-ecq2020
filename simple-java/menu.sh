#!/bin/bash
# autogenerated for a container
# 2020-03-25

echo Select which program you want to run
prog="y"
while [[ $prog != "x" ]]
do 
  echo list:  NewtonRhapson2 Payroll TestGetDigit 
  echo "which program do you want to run ? (x to exit) "
  read prog
  if [[ $prog == "x" ]] ; then continue ; fi
  java $prog 
done 