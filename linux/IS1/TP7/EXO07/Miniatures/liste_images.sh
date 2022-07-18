#!/bin/bash

cd $1
for i in *
do 
	var=$(file $i | grep "image data")
	if [[ $var ]]
		then
			echo $i
	fi
done

