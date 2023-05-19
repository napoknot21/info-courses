#!/bin/bash

if [[ $# -ge 1 ]]
then 
	echo "Je dois saluer $# personne(s) :"
	echo "Bonjour," "$@" '!'
else
	echo "If faut ecrire au moins un parametre"
fi

