#!/bin/bash

if [[ ! $# == 1 ]]
	then 
		echo "Vous ne devez imperativement entrer q'un seul parametre"
		exit 1
else	
	if [[ ! -e $1 ]]
		then	
			echo "Le fichier n'exsite pas dans le repértoire courant"
			exit 2
		else
			tmp=$(file $1 | grep "image")
			if [[ !  $tmp ]]
			       	then
					echo "le fichier n'est pas une image"
                                        exit 3	
				else
					SER=$(ls | grep "Miniatures")
				        if [[ ! $SER ]]
						then
							mkdir Miniatures
							convert $1 -thumbnail 100 mini_$1
						       	mv mini_$1 Miniatures
                                                        exit 0
						else
							VAR=$(file Miniatures | grep "directory")
                                                        if [[  $VAR ]]
                                                                then
									convert $1 -thumbnail 100 mini_$1 ; mv mini_$1 ./Miniatures
									exit 0
								else
									echo "Un fichier nomé" '"'Miniatures'"' "existe déja"
									exit 4
							fi
					fi
			fi	
	fi
fi

