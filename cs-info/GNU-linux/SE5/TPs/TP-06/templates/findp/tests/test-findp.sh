#!/bin/bash

echo_red() {
  if [ -t 1 ] && command -v tput >/dev/null 2>&1 
  then
    echo -n "$(tput setaf 1)$(tput bold)" 2>/dev/null
    echo $@
    echo -n "$(tput sgr0)" 2>/dev/null
  else
    echo $@
  fi
}
echo_yellow() {
  if [ -t 1 ] && command -v tput >/dev/null 2>&1 
  then
    echo -n "$(tput setaf 3)$(tput bold)" 2>/dev/null
    echo $@
    echo -n "$(tput sgr0)" 2>/dev/null
  else
    echo $@
  fi
}

SUCCESS=true

echo_yellow -e "Testing findp (exercise 2)\n"

if ! make --no-print-directory findp; then
  exit 1
fi

echo -n "Running ./findp . key... "

if ./findp . key >/dev/null 2>&1; then
    echo "OK"
else
    echo_red -n "Failed"
    echo ": File key not found"
    SUCCESS=false
fi

echo -n "Running ./findp tests NONEXISTENT... "

rm -f tests/NONEXISTENT
if ./findp tests NONEXISTENT >/dev/null 2>&1; then
    echo_red -n "Failed"
    echo ": Should have exited with EXIT_FAILURE"
    SUCCESS=false
else
    echo "OK"
fi

if $SUCCESS; then
   if command -v valgrind >/dev/null 2>&1; then
     echo -n "Running \`valgrind --leak-check=full ./findp . egg\` ... "
     valgrind --leak-check=full --error-exitcode=33 \
	      ./findp . egg >/dev/null 2>&1
     RES=$?
     if [ "$RES" -eq 33 ]; then
       echo_red "Failed"
       SUCCESS=false
     else
       echo "OK"
     fi
   else
     echo \
       "Could not  run memory leaks check: please install valgrind on this computer if you can, otherwise ignore this line."
   fi
fi



if ! $SUCCESS; then
  exit 1
fi

echo_yellow -e "\nTesting findp with limited descriptors (exercise 3)\n"

LIMIT=6

if [ "$LIMIT" -ne "$(ulimit -n $LIMIT && ulimit -n)" ]; then
  if uname -a | grep -i Cygwin >/dev/null 2>&1; then
    echo "The automated tests for this exercise do not work on Cygwin: I will skip them. You can use WSL instead."
  else
    echo "The automated tests for this exercise do not work on this system: I will skip them."
  fi
else

  echo -n "Running ./findp . egg... "
  if ./findp . egg >/dev/null 2>&1; then
    echo "OK"
  else
    echo_red "Failed"
    SUCCESS=false
  fi
  
  echo -n "Running ./findp . hen... "
  if ! ./findp . hen >/dev/null 2>&1; then
    echo "OK"
  else
    echo_red "Failed"
    SUCCESS=false
  fi
  
  echo "+ ulimit -n $LIMIT..."

  echo -n "Running ./findp . egg... "
  if (exec >/dev/null 2>/dev/null
      ulimit -n "$LIMIT"
      ./findp . egg); then
    echo "OK"
  else
    echo_red "Failed"
    SUCCESS=false
  fi
  
  echo -n "Running ./findp . hen... "
  if ! (exec >/dev/null 2>/dev/null
      ulimit -n "$LIMIT"
      ./findp . hen); then
    echo "OK"
  else
    echo_red "Failed"
    SUCCESS=false
  fi

fi

if ! $SUCCESS; then
  exit 1
fi

echo_yellow -e "\nTesting findp with a long path (exercise 4)\n"

BASE=$(mktemp -d)
if [ ! -d "$BASE" ]; then exit 1; fi

cp findp "$BASE"

cd "$BASE"

D=ABCDEFGHIJKLMNOPQRSTUVWXYZ

# The solution below can crash on WSL because :
#  - bash calls getcwd
#  - on linux, glibc's getcwd calls the getcwd syscall
#  - recent versions of glibc expect the getwd syscall to fail with ENAMETOOLONG if the
#    file name is too long
#  - on older (4.x) kernels, the getcwd syscall fails with ERANGE instead
#  - On wsl, kernel updates are managed by Windows Update: the hosted linux system has no
#    control over them. So it is possible to have both an old kernel (where getcwd gives
#    ERANGE) and a recent glibc (which expects ENAMETOOLONG, and fails an assertion if it
#    gets ERANGE)

# for i in {1..100}; do
#   mkdir "$D$D$D$D"
#   cd "$D$D$D$D"
# done
# touch gold
# cd "$BASE"

# So instead, we have to do it the hard way...

cat > make-tree.c <<EOF
#include <sys/stat.h>
#include <unistd.h>
#include <fcntl.h>
#include <stdio.h>
int main() {
  for (int i = 0; i < 100; i++) {
    if (mkdir("$D$D$D$D", 0777) != 0) {
      perror("mkdir");
      return 1;
    }
    if (chdir("$D$D$D$D") != 0) {
      perror("chdir");
      return 1;
    }
  }
  int fd = open("gold", O_WRONLY | O_CREAT | O_TRUNC, 0666);
  if (fd < 0) {
    perror("chdir");
    return 1;
  }
  close(fd);
  return 0;
}
EOF

if ! gcc -o make-tree make-tree.c || ! ./make-tree ; then SUCCESS=false; fi

# -----

echo -n "Running ./findp . gold... "
if (exec >/dev/null 2>/dev/null
    ulimit -n 20
    ./findp . gold); then
  echo "OK"
else
  echo_red "Failed"
  SUCCESS=false
fi

echo -n "Running ./findp . diamonds... "
if ! (exec >/dev/null 2>/dev/null
    ulimit -n 20
    ./findp . diamonds); then
  echo "OK"
else
  echo_red "Failed"
  SUCCESS=false
fi

rm -rf "$BASE"

exec $SUCCESS
