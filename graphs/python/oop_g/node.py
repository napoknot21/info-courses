#!/usr/bin/python3

class Node () :

    def __init__ (self, value, color) :
        self.value = value # a' type
        self.color = color # Integer: 1 = blanc et 0 noir

    def getValue (self) :
        return self.value

    def getColor (self) :
        return self.color

    def setValue (self, value) :
        if not self.value == value :
            self.value = value

    def setColor (self, color) :
        if not self.color == color :
            self.color = color

    def toString (self) :
        val = self.value if not self.value == None else "Not Defined"
        color = self.color if not self.color == None else "Not Defined"
        print ("Node => val: " + str(val) + ", " + "color: " + str(color))
