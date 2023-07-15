#include <stdio.h>

int main() {
  char buf[32];
  FILE * f = fopen("/tmp/tutu", "w+");

  fprintf(f, "essai 1 ");
  fprintf(f, "essai 2 ");
  fprintf(f, "essai 3 ");

  fseek(f, 0, SEEK_SET);

  fread(buf, 8, 1, f);
  printf("marque\n");
  fprintf(f, "ESSAI 4 ");
  printf("marque\n");
  fread(buf, 8, 1, f);

  fclose(f);
}
