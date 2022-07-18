#!/bin/bash

echo "Je dois saluer $# personnes :"
for i in $@
do echo "Bonjour, $i" '!' 
done

