#!/bin/bash

if [[ $# -ge 1 ]]
then
	echo "Je dois saluer $# personnes :"
	echo "Bonjour," "$@" '!'
	exit 0
else
	echo "If faut ecrire au moins un parametre"
	exit 42
fi
