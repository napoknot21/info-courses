#ifndef VECTOR_H
#define VECTOR_H

#include <string.h>
#include <stdlib.h>

#define VECTOR_DEFAULT_CAPACITY 0

struct vector 
{
    void *data;

    void* (*copy)(void *);
    void* (*free)(void *);

    size_t elem_size;
    size_t capacity;
    size_t size;
};

struct vector *make_vector (void* (*)(void*), void* (*)(void*), size_t);
struct vector *copy_vector (const struct vector *src);

void capacity (struct vector *vect, size_t cap);

void push_back (struct vector *vect, void *src);
void pop_back (struct vector *vect);

void free_vector (struct vector *vect);
void clear (struct vector *vect);

void * at (struct vector *, size_t i);

#endif
