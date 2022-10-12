#!/usr/bin/python3

import collections


graph = {
        'a': ['b', 'c'],
        'b': ['d', 'e'],
        'c': [],
        'd': ['e'],
        'e': ['c']
        }

def bfs (graph) :
    mark = []
    list = []
