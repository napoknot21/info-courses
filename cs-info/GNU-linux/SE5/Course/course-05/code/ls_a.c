#include <stdio.h>
#include <stdlib.h>
#include <sys/types.h>
#include <dirent.h>

void ls(char *dir){
  struct dirent *entry;
  DIR *dirp = opendir(dir);
 
  if (dirp == NULL) {
    perror("opendir");
    exit(1);
  }
  
  while((entry=readdir(dirp))){
    printf("%lld\t%s\n", entry->d_ino, entry->d_name);
  }

  closedir(dirp);
}

int main(int argc, char ** argv){
  if (argc==1) ls(".");
  else ls(argv[1]);
  
  return 0;
}
