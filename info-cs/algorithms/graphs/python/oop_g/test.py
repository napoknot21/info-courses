#!/usr/bin/python3
import node as nd
import edge as ed
import graph as gh

node_1 = nd.Node (1, 1)
node_2 = nd.Node (2, 1)
node_3 = nd.Node (3, 1)
node_4 = nd.Node (4, 1)

ed_1 = ed.Edge(node_1, node_2, False)
ed_2 = ed.Edge(node_1, node_3, False)
ed_3 = ed.Edge(node_2, node_3, False)
ed_4 = ed.Edge(node_2, node_4, False)

V = [node_1, node_2, node_3, node_4]
E = [ed_1, ed_2, ed_3, ed_4]

for i in range (len(V)) :
    V[i].toString()

print("================================")

for i in range (len(E)) :
    E[i].toString()

print("\n")

G = gh.Graph(V,E)

G.printV()
print("\n")
G.printE()

print("================================")

print("[*] Sons of each node...")
for i in range (len(G.getV())) :
    G.printArrayG(G.getSons(G.getV()[i]))
    print("\n")

print("[*] Parent(s) of each node...")
for i in range (len(G.getV())) :
    G.printArrayG(G.getParents(G.getV()[i]))
    print("\n")
