#!/usr/bin/python3
import node as nd
import edge as ed

class Graph :

    def __init__ (self, V, E) :
        self.V = V if not V == None else []
        self.E = E if not E == None else []

    def getV (self) :
        return self.V

    def getE (self) :
        return self.E

    def isNodePresent (self, node) :
        if len(self.V) == 0 : return False
        for i in range (len(self.V)) :
            if self.V[i] == node : return True
        return False

    def isEdgePresent (self, edge) :
        if len (self.E) == 0 : return False
        for i in range (len(self.E)) :
            if self.E[i] == edge : return True
        return False

    def addNode (self, node) :
        if not self.isNodePresent(node) : 
            self.V.append(node)
            return True
        return False

    # Case for simple graph (no cycles, etc)
    def addEdge (self, edge) :
        if not self.isEdgePresent(edge) :
            self.E.append(edge)
            return True
        return False

    def addSonNode (self, node_source, node_son) :
        return self.addNode(node_son) and self.addEdge(ed.Edge(node_source,node_son, False))

    def addParentNode (self, node_parent, node_source) :
        return self.addNode(node_parent) and self.addEdge(ed.Edge(node_parent, node_source, False))

    def addSonNodeFromValue (self, node_source, value) :
        return self.addSonNode (node_source, nd.Node(value,1))

    def getSons (self, node_u) :
        list = []
        for i in range (len(self.E)) :
            if self.E[i].getNode_u() == node_u :
                list.append(self.E[i].getNode_v())
        return list

    def getParents (self, node_v) :
        list = []
        for i in range (len(self.E)) :
            if self.E[i].getNode_v() == node_v :
                list.append(self.E[i].getNode_u())
        return list


    # ============================ Print functions =============================

    def printArrayG (self, list) :
        if len(list) == 0 :
            print("[]")
            return
        print("[")
        for i in range (len(list)) :
            list[i].toString()
        print("]")

    def printV (self) :
        if len(self.V) == 0 : 
            print("[]")
            return
        print("[")
        for i in range (len(self.V)) :
            self.V[i].toString()
        print("]")

    def printE (self) :
        if len(self.E) == 0 :
            print("[]")
            return
        print("[")
        for i in range (len(self.E)) :
            self.E[i].toString()
        print("]")
