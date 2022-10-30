#!/usr/bin/python3

class Edge :

    def __init__ (self, node_u, node_v, mark) :
        self.node_u = node_u
        self.node_v = node_v
        self.mark = False

    def getNode_u (self) :
        return self.node_u

    def getNode_v (self) :
        return self.node_v

    def getMark (self) :
        return self.mark

    def setNode_u (self, node_u) :
        self.node_u = node_u

    def setNode_v (self, node_v) :
        self.node_v = node_v

    def setMark (self, bool) :
        self.mark = bool

    def toString (self) :
        #source = self.node_u.toString() if not self.node_u == None else "Undefinied"
        #target = self.node_v.toString() if not self.node_v == None else "Undefinied"
        print("Edge : ")
        print("\tsource: ", end='')
        self.node_u.toString()
        print("\tTarget: ", end='')
        self.node_v.toString()
