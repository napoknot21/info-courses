#include "vector.h"

struct vector * make_vector (void* (* copy)(void *), void* (*free)(void *), size_t elem_size)
{
    struct vector *vect = malloc(sizeof(struct vector));
    memset(vect, 0x00, sizeof(struct vector));

    vect->capacity = VECTOR_DEFAULT_CAPACITY;
    vect->elem_size = elem_size;
    vect->data = malloc(vect->elem_size * vect->capacity);

    vect->copy = copy;
    vect->free = free;

    return vect;
}


struct vector * copy_vector (const struct vector * src)
{
    struct vector *copy = make_vector(src->copy, src->free, src->elem_size);
    capacity(copy, src->capacity);

    copy->size = src->size;

    memmove(copy->data, src->data, copy->size * copy->elem_size);

    return copy;
}


void capacity (struct vector *vect, size_t cap)
{
    vect->capacity = cap;
    vect->data = realloc(vect->data, cap * vect->elem_size);
}


void push_back (struct vector *vect, void *src)
{
    while (vect->size +1 >= vect->capacity) {

        vect->capacity *= 2;
        vect->data = realloc(vect->data, vect->capacity);

    }

    void *elem = (vect->copy) ? vect->copy(src) : src;

    memmove((char *) vect->data + vect->size, elem, vect->elem_size);
    vect->size++;
}


void pop_back (struct vector *vect) 
{
    if (!vect->size) return;

    void *elem = (void *)((char *) vect->data + --vect->size);
    vect->free(elem);
}


void free_vector (struct vector *vect)
{
    clear(vect);
    free(vect);
}


void clear (struct vector *vect)
{
    for (size_t i = 0; vect->free && i < vect->size; i++) {
    
        void *elem = (void *)((char *) vect->data + i * vect->elem_size);
        if (!elem) continue;
        vect->free(elem);

    }

    vect->size = 0;
    memset(vect->data, 0x00, vect->capacity);
}


void * at (struct vector *vect, size_t i)
{
    if (i >= vect->capacity) return NULL;

    return (void *)((char *) vect->data + i*vect->elem_size);
}


