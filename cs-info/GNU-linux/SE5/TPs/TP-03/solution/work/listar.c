#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <fcntl.h>
#include <string.h>
#include "tarutils.h"

struct posix_header hd;

int main(int argc, char **argv){

    int fd, ret = 0;
    unsigned int filesize, filemode, nblocks;
    struct posix_header * phd = &hd;

    if (argc != 2) {
        fprintf(stderr, "Usage : %s file.tar\n", argv[0]);
        exit(1);
    }

    /* opening the tar file */
    fd = open(argv[1], O_RDONLY);
    if (fd < 0) {
        perror("open");
        exit(1);
    }

    /* main loop */
    while (1) {
        /* Reading the header; ensuring the read is complete */
        ssize_t rd = read(fd, phd, BLOCKSIZE);
        if (rd < 0) {
            perror("read\n");
            ret = -1;
            break;
        }

        if (rd != 512) {
            perror("File corrupted\n");
            ret = 1;
            break;
        }

        /* End of the archive is reached if the block is filled with zeros, 
         * and in particular if name == "" */
        if (phd->name[0] == 0) {
            ret = 0;
            break;
        }

        /* Checking the checksum (optional) */
        if (!check_checksum(phd)) {
            fprintf(stderr, "Checksum erronée : %s\n", phd -> chksum);
            ret = 1;
            break;
        }

        /* calculation of rights, size and number of occupied blocks */
        sscanf(phd->mode, "%o", &filemode);
        sscanf(phd->size, "%o", &filesize);
        nblocks = (filesize + BLOCKSIZE - 1) >> BLOCKBITS;

        /* displaying header information: rights in octal, size 
        * in decimal, number of blocks in decimal, file name */
        printf("%o\t%d\t%d\t%s\n", filemode, filesize, nblocks, phd -> name);

        /* jump to the next header */
        lseek(fd, nblocks * BLOCKSIZE, SEEK_CUR);
    }

    /* closing the tar file */
    close(fd);

    exit(ret);
}
