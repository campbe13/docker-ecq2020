# all steps

__Note1:__ I had to troubleshoot the db before this would work, see [DOCKER COMPOSE Troubleshooting db issues](DOCKERCOMPOSEtroubleshoot.md) </br>
__Note2:__ I tried to run this on another computer and the php container crashed on run (spoiler: due to missing directory mapped to the host) see [DOCKER troubleshoot startup error](DOCKERCOMPOSEtroubleshootexit1.md)

Steps to test:
1. [docker-compose build][build] 
2. [docker images][images]
3. [docker-compose up -d](docker-compose up -d)
4. [docker-compose logs db](docker-compose logs db)
4. [docker-compose logs php](docker-compose logs php)
4. [docker-compose logs phpmyadmin](docker-compose logs phpmyadmin) && tail /var/log/apache2/access.log && tail /var/log/apache2/error.log
4. [docker volume](docker volume)  show container volumes
4. [docker network](docker network) show container networks

Testing complete, now push (only the php image) to docker registry:
1. [login](docker login) 
5. [tag](docker tag)
7. [push](docker push)

## [build]: docker-compose build
```
[tricia@korra stickynotes-jb]$ make -f Makefile.docker-compose build
docker-compose build
db uses an image, skipping
phpmyadmin uses an image, skipping
Building php
Step 1/8 : FROM php:7.2-apache
 ---> ba07a75a195b
Step 2/8 : MAINTAINER P Campbell pcampbell.edu@gmail.com
 ---> Using cache
 ---> 324716aad9d6
Step 3/8 : ENV DEBIAN_FRONTEND noninteractive
 ---> Using cache
 ---> fb2ad4a027fa
Step 4/8 : RUN apt-get -y update && apt-get clean
 ---> Running in 1ac70cb3191c
Get:2 http://deb.debian.org/debian buster InRelease [122 kB]
Get:3 http://deb.debian.org/debian buster-updates InRelease [49.3 kB]
Get:1 http://security-cdn.debian.org/debian-security buster/updates InRelease [65.4 kB]
Get:4 http://deb.debian.org/debian buster/main amd64 Packages [7907 kB]
Get:5 http://security-cdn.debian.org/debian-security buster/updates/main amd64 Packages [181 kB]
Get:6 http://deb.debian.org/debian buster-updates/main amd64 Packages [7380 B]
Fetched 8332 kB in 4s (2273 kB/s)
Reading package lists...
Removing intermediate container 1ac70cb3191c
 ---> 18cee05a396f
Step 5/8 : RUN docker-php-ext-install mysqli pdo pdo_mysql
 ---> Running in 4155e26807db
Configuring for:
PHP Api Version:         20170718
Zend Module Api No:      20170718
Zend Extension Api No:   320170718
checking for grep that handles long lines and -e... /bin/grep
checking for egrep... /bin/grep -E
checking for a sed that does not truncate output... /bin/sed
checking for cc... cc
checking whether the C compiler works... yes
checking for C compiler default output file name... a.out
checking for suffix of executables...
checking whether we are cross compiling... no
checking for suffix of object files... o
checking whether we are using the GNU C compiler... yes
checking whether cc accepts -g... yes
checking for cc option to accept ISO C89... none needed
checking how to run the C preprocessor... cc -E
checking for icc... no
checking for suncc... no
checking whether cc understands -c and -o together... yes
checking for system library directory... lib
checking if compiler supports -R... no
checking if compiler supports -Wl,-rpath,... yes
checking build system type... x86_64-pc-linux-gnu
checking host system type... x86_64-pc-linux-gnu
checking target system type... x86_64-pc-linux-gnu
checking for PHP prefix... /usr/local
checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20170718
checking for PHP installed headers prefix... /usr/local/include/php
checking if debug is enabled... no
checking if zts is enabled... no
checking for re2c... re2c
checking for re2c version... 1.1.1 (ok)
checking for gawk... no
checking for nawk... nawk
checking if nawk is broken... no
checking for MySQLi support... yes, shared
checking whether to enable embedded MySQLi support... no
checking for specified location of the MySQL UNIX socket... no
checking for MySQL UNIX socket location... no
checking for ld used by cc... /usr/bin/ld
checking if the linker (/usr/bin/ld) is GNU ld... yes
checking for /usr/bin/ld option to reload object files... -r
checking for BSD-compatible nm... /usr/bin/nm -B
checking whether ln -s works... yes
checking how to recognize dependent libraries... pass_all
checking for ANSI C header files... yes
checking for sys/types.h... yes
checking for sys/stat.h... yes
checking for stdlib.h... yes
checking for string.h... yes
checking for memory.h... yes
checking for strings.h... yes
checking for inttypes.h... yes
checking for stdint.h... yes
checking for unistd.h... yes
checking dlfcn.h usability... yes
checking dlfcn.h presence... yes
checking for dlfcn.h... yes
checking the maximum length of command line arguments... 1572864
checking command to parse /usr/bin/nm -B output from cc object... ok
checking for objdir... .libs
checking for ar... ar
checking for ranlib... ranlib
checking for strip... strip
checking if cc supports -fno-rtti -fno-exceptions... no
checking for cc option to produce PIC... -fPIC
checking if cc PIC flag -fPIC works... yes
checking if cc static flag -static works... yes
checking if cc supports -c -o file.o... yes
checking whether the cc linker (/usr/bin/ld -m elf_x86_64) supports shared libraries... yes
checking whether -lc should be explicitly linked in... no
checking dynamic linker characteristics... GNU/Linux ld.so
checking how to hardcode library paths into programs... immediate
checking whether stripping libraries is possible... yes
checking if libtool supports shared libraries... yes
checking whether to build shared libraries... yes
checking whether to build static libraries... no

creating libtool
appending configuration tag "CXX" to libtool
configure: creating ./config.status
config.status: creating config.h
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli.c -o mysqli.lo
mkdir .libs
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli.c  -fPIC -DPIC -o .libs/mysqli.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main
TWOHERE 
/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_api.c -o mysqli_api.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_api.c  -fPIC -DPIC -o .libs/mysqli_api.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_prop.c -o mysqli_prop.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_prop.c  -fPIC -DPIC -o .libs/mysqli_prop.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_nonapi.c -o mysqli_nonapi.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_nonapi.c  -fPIC -DPIC -o .libs/mysqli_nonapi.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_fe.c -o mysqli_fe.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_fe.c  -fPIC -DPIC -o .libs/mysqli_fe.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_report.c -o mysqli_report.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_report.c  -fPIC -DPIC -o .libs/mysqli_report.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_driver.c -o mysqli_driver.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_driver.c  -fPIC -DPIC -o .libs/mysqli_driver.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_warning.c -o mysqli_warning.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_warning.c  -fPIC -DPIC -o .libs/mysqli_warning.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_exception.c -o mysqli_exception.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_exception.c  -fPIC -DPIC -o .libs/mysqli_exception.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=compile cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/mysqli/mysqli_result_iterator.c -o mysqli_result_iterator.lo
 cc -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/mysqli -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/mysqli/mysqli_result_iterator.c  -fPIC -DPIC -o .libs/mysqli_result_iterator.o
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=link cc -DPHP_ATOM_INC -I/usr/src/php/ext/mysqli/include -I/usr/src/php/ext/mysqli/main -I/usr/src/php/ext/mysqli -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64  -Wl,-O1 -Wl,--hash-style=both -pie  -o mysqli.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/mysqli/modules  mysqli.lo mysqli_api.lo mysqli_prop.lo mysqli_nonapi.lo mysqli_fe.lo mysqli_report.lo mysqli_driver.lo mysqli_warning.lo mysqli_exception.lo mysqli_result_iterator.lo
cc -shared  .libs/mysqli.o .libs/mysqli_api.o .libs/mysqli_prop.o .libs/mysqli_nonapi.o .libs/mysqli_fe.o .libs/mysqli_report.o .libs/mysqli_driver.o .libs/mysqli_warning.o .libs/mysqli_exception.o .libs/mysqli_result_iterator.o   -Wl,-O1 -Wl,--hash-style=both -Wl,-soname -Wl,mysqli.so -o .libs/mysqli.so
creating mysqli.la
(cd .libs && rm -f mysqli.la && ln -s ../mysqli.la mysqli.la)
/bin/bash /usr/src/php/ext/mysqli/libtool --mode=install cp ./mysqli.la /usr/src/php/ext/mysqli/modules
cp ./.libs/mysqli.so /usr/src/php/ext/mysqli/modules/mysqli.so
cp ./.libs/mysqli.lai /usr/src/php/ext/mysqli/modules/mysqli.la
PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/mysqli/modules
----------------------------------------------------------------------
Libraries have been installed in:
   /usr/src/php/ext/mysqli/modules

If you ever happen to want to link against installed libraries
in a given directory, LIBDIR, you must either use libtool, and
specify the full pathname of the library, or use the `-LLIBDIR'
flag during linking and do at least one of the following:
   - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
     during execution
   - add LIBDIR to the `LD_RUN_PATH' environment variable
     during linking
   - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
   - have your system administrator add LIBDIR to `/etc/ld.so.conf'

See any operating system documentation about shared libraries for
more information, such as the ld(1) and ld.so(8) manual pages.
----------------------------------------------------------------------

Build complete.
Don't forget to run 'make test'.

Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20170718/
Installing header files:          /usr/local/include/php/
find . -name \*.gcno -o -name \*.gcda | xargs rm -f
find . -name \*.lo -o -name \*.o | xargs rm -f
find . -name \*.la -o -name \*.a | xargs rm -f
find . -name \*.so | xargs rm -f
find . -name .libs -a -type d|xargs rm -rf
rm -f libphp.la       modules/* libs/*
Configuring for:
PHP Api Version:         20170718
Zend Module Api No:      20170718
Zend Extension Api No:   320170718
checking for grep that handles long lines and -e... /bin/grep
checking for egrep... /bin/grep -E
checking for a sed that does not truncate output... /bin/sed
checking for cc... cc
checking whether the C compiler works... yes
checking for C compiler default output file name... a.out
checking for suffix of executables...
checking whether we are cross compiling... no
checking for suffix of object files... o
checking whether we are using the GNU C compiler... yes
checking whether cc accepts -g... yes
checking for cc option to accept ISO C89... none needed
checking how to run the C preprocessor... cc -E
checking for icc... no
checking for suncc... no
checking whether cc understands -c and -o together... yes
checking for system library directory... lib
checking if compiler supports -R... no
checking if compiler supports -Wl,-rpath,... yes
checking build system type... x86_64-pc-linux-gnu
checking host system type... x86_64-pc-linux-gnu
checking target system type... x86_64-pc-linux-gnu
checking for PHP prefix... /usr/local
checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20170718
checking for PHP installed headers prefix... /usr/local/include/php
checking if debug is enabled... no
checking if zts is enabled... no
checking for re2c... re2c
checking for re2c version... 1.1.1 (ok)
checking for gawk... no
checking for nawk... nawk
checking if nawk is broken... no
checking whether to enable PDO support... yes, shared
checking for ld used by cc... /usr/bin/ld
checking if the linker (/usr/bin/ld) is GNU ld... yes
checking for /usr/bin/ld option to reload object files... -r
checking for BSD-compatible nm... /usr/bin/nm -B
checking whether ln -s works... yes
checking how to recognize dependent libraries... pass_all
checking for ANSI C header files... yes
checking for sys/types.h... yes
checking for sys/stat.h... yes
checking for stdlib.h... yes
checking for string.h... yes
checking for memory.h... yes
checking for strings.h... yes
checking for inttypes.h... yes
checking for stdint.h... yes
checking for unistd.h... yes
checking dlfcn.h usability... yes
checking dlfcn.h presence... yes
checking for dlfcn.h... yes
checking the maximum length of command line arguments... 1572864
checking command to parse /usr/bin/nm -B output from cc object... ok
checking for objdir... .libs
checking for ar... ar
checking for ranlib... ranlib
checking for strip... strip
checking if cc supports -fno-rtti -fno-exceptions... no
checking for cc option to produce PIC... -fPIC
checking if cc PIC flag -fPIC works... yes
checking if cc static flag -static works... yes
checking if cc supports -c -o file.o... yes
checking whether the cc linker (/usr/bin/ld -m elf_x86_64) supports shared libraries... yes
checking whether -lc should be explicitly linked in... no
checking dynamic linker characteristics... GNU/Linux ld.so
checking how to hardcode library paths into programs... immediate
checking whether stripping libraries is possible... yes
checking if libtool supports shared libraries... yes
checking whether to build shared libraries... yes
checking whether to build static libraries... no

creating libtool
appending configuration tag "CXX" to libtool
configure: creating ./config.status
config.status: creating config.h
/bin/bash /usr/src/php/ext/pdo/libtool --mode=compile cc  -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo/pdo.c -o pdo.lo
mkdir .libs
 cc -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo/pdo.c  -fPIC -DPIC -o .libs/pdo.o
/bin/bash /usr/src/php/ext/pdo/libtool --mode=compile cc  -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo/pdo_dbh.c -o pdo_dbh.lo
 cc -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo/pdo_dbh.c  -fPIC -DPIC -o .libs/pdo_dbh.o
/bin/bash /usr/src/php/ext/pdo/libtool --mode=compile cc  -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo/pdo_stmt.c -o pdo_stmt.lo
 cc -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo/pdo_stmt.c  -fPIC -DPIC -o .libs/pdo_stmt.o
/bin/bash /usr/src/php/ext/pdo/libtool --mode=compile cc  -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo/pdo_sql_parser.c -o pdo_sql_parser.lo
 cc -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo/pdo_sql_parser.c  -fPIC -DPIC -o .libs/pdo_sql_parser.o


ONEHERE
r/src/php/ext/pdo/pdo_sql_parser.c  -fPIC -DPIC -o .libs/pdo_sql_parser.o
/bin/bash /usr/src/php/ext/pdo/libtool --mode=compile cc  -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo/pdo_sqlstate.c -o pdo_sqlstate.lo
 cc -I. -I/usr/src/php/ext/pdo -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo/pdo_sqlstate.c  -fPIC -DPIC -o .libs/pdo_sqlstate.o
/bin/bash /usr/src/php/ext/pdo/libtool --mode=link cc -DPHP_ATOM_INC -I/usr/src/php/ext/pdo/include -I/usr/src/php/ext/pdo/main -I/usr/src/php/ext/pdo -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64  -Wl,-O1 -Wl,--hash-style=both -pie  -o pdo.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/pdo/modules  pdo.lo pdo_dbh.lo pdo_stmt.lo pdo_sql_parser.lo pdo_sqlstate.lo
cc -shared  .libs/pdo.o .libs/pdo_dbh.o .libs/pdo_stmt.o .libs/pdo_sql_parser.o .libs/pdo_sqlstate.o   -Wl,-O1 -Wl,--hash-style=both -Wl,-soname -Wl,pdo.so -o .libs/pdo.so
creating pdo.la
(cd .libs && rm -f pdo.la && ln -s ../pdo.la pdo.la)
/bin/bash /usr/src/php/ext/pdo/libtool --mode=install cp ./pdo.la /usr/src/php/ext/pdo/modules
cp ./.libs/pdo.so /usr/src/php/ext/pdo/modules/pdo.so
cp ./.libs/pdo.lai /usr/src/php/ext/pdo/modules/pdo.la
PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/pdo/modules
----------------------------------------------------------------------
Libraries have been installed in:
   /usr/src/php/ext/pdo/modules

If you ever happen to want to link against installed libraries
in a given directory, LIBDIR, you must either use libtool, and
specify the full pathname of the library, or use the `-LLIBDIR'
flag during linking and do at least one of the following:
   - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
     during execution
   - add LIBDIR to the `LD_RUN_PATH' environment variable
     during linking
   - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
   - have your system administrator add LIBDIR to `/etc/ld.so.conf'

See any operating system documentation about shared libraries for
more information, such as the ld(1) and ld.so(8) manual pages.
----------------------------------------------------------------------

Build complete.
Don't forget to run 'make test'.

Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20170718/
Installing header files:          /usr/local/include/php/
Installing PDO headers:           /usr/local/include/php/ext/pdo/

warning: pdo (pdo.so) is already loaded!

find . -name \*.gcno -o -name \*.gcda | xargs rm -f
find . -name \*.lo -o -name \*.o | xargs rm -f
find . -name \*.la -o -name \*.a | xargs rm -f
find . -name \*.so | xargs rm -f
find . -name .libs -a -type d|xargs rm -rf
rm -f libphp.la       modules/* libs/*
Configuring for:
PHP Api Version:         20170718
Zend Module Api No:      20170718
Zend Extension Api No:   320170718
checking for grep that handles long lines and -e... /bin/grep
checking for egrep... /bin/grep -E
checking for a sed that does not truncate output... /bin/sed
checking for cc... cc
checking whether the C compiler works... yes
checking for C compiler default output file name... a.out
checking for suffix of executables...
checking whether we are cross compiling... no
checking for suffix of object files... o
checking whether we are using the GNU C compiler... yes
checking whether cc accepts -g... yes
checking for cc option to accept ISO C89... none needed
checking how to run the C preprocessor... cc -E
checking for icc... no
checking for suncc... no
checking whether cc understands -c and -o together... yes
checking for system library directory... lib
checking if compiler supports -R... no
checking if compiler supports -Wl,-rpath,... yes
checking build system type... x86_64-pc-linux-gnu
checking host system type... x86_64-pc-linux-gnu
checking target system type... x86_64-pc-linux-gnu
checking for PHP prefix... /usr/local
checking for PHP includes... -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib
checking for PHP extension directory... /usr/local/lib/php/extensions/no-debug-non-zts-20170718
checking for PHP installed headers prefix... /usr/local/include/php
checking if debug is enabled... no
checking if zts is enabled... no
checking for re2c... re2c
checking for re2c version... 1.1.1 (ok)
checking for gawk... no
checking for nawk... nawk
checking if nawk is broken... no
checking for MySQL support for PDO... yes, shared
checking for the location of libz... no
checking for MySQL UNIX socket location...
checking for PDO includes... checking for PDO includes... /usr/local/include/php/ext
checking for ld used by cc... /usr/bin/ld
checking if the linker (/usr/bin/ld) is GNU ld... yes
checking for /usr/bin/ld option to reload object files... -r
checking for BSD-compatible nm... /usr/bin/nm -B
checking whether ln -s works... yes
checking how to recognize dependent libraries... pass_all
checking for ANSI C header files... yes
checking for sys/types.h... yes
checking for sys/stat.h... yes
checking for stdlib.h... yes
checking for string.h... yes
checking for memory.h... yes
checking for strings.h... yes
checking for inttypes.h... yes
checking for stdint.h... yes
checking for unistd.h... yes
checking dlfcn.h usability... yes
checking dlfcn.h presence... yes
checking for dlfcn.h... yes
checking the maximum length of command line arguments... 1572864
checking command to parse /usr/bin/nm -B output from cc object... ok
checking for objdir... .libs
checking for ar... ar
checking for ranlib... ranlib
checking for strip... strip
checking if cc supports -fno-rtti -fno-exceptions... no
checking for cc option to produce PIC... -fPIC
checking if cc PIC flag -fPIC works... yes
checking if cc static flag -static works... yes
checking if cc supports -c -o file.o... yes
checking whether the cc linker (/usr/bin/ld -m elf_x86_64) supports shared libraries... yes
checking whether -lc should be explicitly linked in... no
checking dynamic linker characteristics... GNU/Linux ld.so
checking how to hardcode library paths into programs... immediate
checking whether stripping libraries is possible... yes
checking if libtool supports shared libraries... yes
checking whether to build shared libraries... yes
checking whether to build static libraries... no

creating libtool
appending configuration tag "CXX" to libtool
configure: creating ./config.status
config.status: creating config.h
/bin/bash /usr/src/php/ext/pdo_mysql/libtool --mode=compile cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo_mysql/pdo_mysql.c -o pdo_mysql.lo
mkdir .libs
 cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo_mysql/pdo_mysql.c  -fPIC -DPIC -o .libs/pdo_mysql.o
/bin/bash /usr/src/php/ext/pdo_mysql/libtool --mode=compile cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo_mysql/mysql_driver.c -o mysql_driver.lo
 cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo_mysql/mysql_driver.c  -fPIC -DPIC -o .libs/mysql_driver.o
/bin/bash /usr/src/php/ext/pdo_mysql/libtool --mode=compile cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64   -c /usr/src/php/ext/pdo_mysql/mysql_statement.c -o mysql_statement.lo
 cc -I/usr/local/include/php/ext -DZEND_ENABLE_STATIC_TSRMLS_CACHE=1 -I. -I/usr/src/php/ext/pdo_mysql -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -c /usr/src/php/ext/pdo_mysql/mysql_statement.c  -fPIC -DPIC -o .libs/mysql_statement.o
/bin/bash /usr/src/php/ext/pdo_mysql/libtool --mode=link cc -DPHP_ATOM_INC -I/usr/src/php/ext/pdo_mysql/include -I/usr/src/php/ext/pdo_mysql/main -I/usr/src/php/ext/pdo_mysql -I/usr/local/include/php -I/usr/local/include/php/main -I/usr/local/include/php/TSRM -I/usr/local/include/php/Zend -I/usr/local/include/php/ext -I/usr/local/include/php/ext/date/lib  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64 -DHAVE_CONFIG_H  -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64  -Wl,-O1 -Wl,--hash-style=both -pie  -o pdo_mysql.la -export-dynamic -avoid-version -prefer-pic -module -rpath /usr/src/php/ext/pdo_mysql/modules  pdo_mysql.lo mysql_driver.lo mysql_statement.lo
cc -shared  .libs/pdo_mysql.o .libs/mysql_driver.o .libs/mysql_statement.o   -Wl,-O1 -Wl,--hash-style=both -Wl,-soname -Wl,pdo_mysql.so -o .libs/pdo_mysql.so
creating pdo_mysql.la
(cd .libs && rm -f pdo_mysql.la && ln -s ../pdo_mysql.la pdo_mysql.la)
/bin/bash /usr/src/php/ext/pdo_mysql/libtool --mode=install cp ./pdo_mysql.la /usr/src/php/ext/pdo_mysql/modules
cp ./.libs/pdo_mysql.so /usr/src/php/ext/pdo_mysql/modules/pdo_mysql.so
cp ./.libs/pdo_mysql.lai /usr/src/php/ext/pdo_mysql/modules/pdo_mysql.la
PATH="$PATH:/sbin" ldconfig -n /usr/src/php/ext/pdo_mysql/modules
----------------------------------------------------------------------
Libraries have been installed in:
   /usr/src/php/ext/pdo_mysql/modules

If you ever happen to want to link against installed libraries
in a given directory, LIBDIR, you must either use libtool, and
specify the full pathname of the library, or use the `-LLIBDIR'
flag during linking and do at least one of the following:
   - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
     during execution
   - add LIBDIR to the `LD_RUN_PATH' environment variable
     during linking
   - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
   - have your system administrator add LIBDIR to `/etc/ld.so.conf'

See any operating system documentation about shared libraries for
more information, such as the ld(1) and ld.so(8) manual pages.
----------------------------------------------------------------------

Build complete.
Don't forget to run 'make test'.

Installing shared extensions:     /usr/local/lib/php/extensions/no-debug-non-zts-20170718/
find . -name \*.gcno -o -name \*.gcda | xargs rm -f
find . -name \*.lo -o -name \*.o | xargs rm -f
find . -name \*.la -o -name \*.a | xargs rm -f
find . -name \*.so | xargs rm -f
find . -name .libs -a -type d|xargs rm -rf
rm -f libphp.la       modules/* libs/*
Removing intermediate container 4155e26807db
 ---> a8c247992d0e
Step 6/8 : WORKDIR /var/www/html/
 ---> Running in 8080acc50083
Removing intermediate container 8080acc50083
 ---> 49787f5e1147
Step 7/8 : EXPOSE 80
 ---> Running in 022c7a267d97
Removing intermediate container 022c7a267d97
 ---> 8ddd6943368a
Step 8/8 : CMD apachectl -D  FOREGROUND
 ---> Running in 00d0a004026c
Removing intermediate container 00d0a004026c
 ---> 9197aaadf76b

Successfully built 9197aaadf76b
Successfully tagged stickynotes-jb_php:latest

```
## [images]: docker images
```
[tricia@korra stickynotes-jb]$ docker images
REPOSITORY                               TAG                 IMAGE ID            CREATED             SIZE
stickynotes-jb_php                       latest              9197aaadf76b        4 minutes ago       428MB
registry.heroku.com/shakespeare-jm/web   latest              cba946926c78        22 hours ago        549MB
registry.heroku.com/shakespeare-ec/web   latest              25ff9fd85e81        22 hours ago        544MB
registry.heroku.com/shakespeare-jm/web   <none>              25ff9fd85e81        22 hours ago        544MB
php                                      7.2-apache          ba07a75a195b        6 days ago          410MB
tricia/shakespeare-ec                    latest              8524faf9b7b8        11 days ago         602MB
registry.heroku.com/shakespeare-ec       latest              8524faf9b7b8        11 days ago         602MB
hello-world                              latest              fce289e99eb9        14 months ago       1.84kB
```
## docker-compose up -d
```
[tricia@korra stickynotes-jb]$ make -f Makefile.docker-compose run
docker-compose up -d
Creating network "stickynotes-jb_backend" with the default driver
Creating network "stickynotes-jb_frontend" with the default driver
Creating volume "stickynotes-jb_persistent" with default driver
Pulling db (mysql:latest)...
latest: Pulling from library/mysql
6d28e14ab8c8: Pull complete
dda15103a86a: Pull complete
55971d75ab8c: Pull complete
f1d4ea32020b: Pull complete
61420072af91: Pull complete
05c10e6ccca5: Pull complete
7e0306b13322: Pull complete
900b113c001e: Pull complete
06cd07c30bf4: Pull complete
df0d65aee5aa: Pull complete
108d207bdce2: Pull complete
b33faea3a1af: Pull complete
Digest: sha256:230d501a0c971221aef647661b331c56587fc5bd4a465dfa132c4d2b45835163
Status: Downloaded newer image for mysql:latest
Pulling phpmyadmin (phpmyadmin/phpmyadmin:)...
latest: Pulling from phpmyadmin/phpmyadmin
8ec398bc0356: Pull complete
85cf4fc86478: Pull complete
970dadf4ccb6: Pull complete
8c04561117a4: Pull complete
d6b7434b63a2: Pull complete
83d8859e9744: Pull complete
9c3d824d0ad5: Pull complete
0ff2f3c2c8ab: Pull complete
f7a2cdcb0840: Pull complete
fe8c2411b50b: Pull complete
aa0cb4375001: Pull complete
96198bf1ad68: Pull complete
5fe54d7827f9: Pull complete
b14701794f98: Pull complete
017ea991a64c: Pull complete
b9fac930b192: Pull complete
1807d0d7270b: Pull complete
5fe7c1ba6fbd: Pull complete
Digest: sha256:2eccbe375bffb5ddd9cf63a4544c9a48a78b1a8138b728cb0af1e0d4937a340a
Status: Downloaded newer image for phpmyadmin/phpmyadmin:latest
Creating stickynotes-jb_db_1 ...
Creating stickynotes-jb_db_1 ... error

ERROR: for stickynotes-jb_db_1  Cannot start service db: driver failed programming external connectivity on endpoint stickynotes-jb_db_1 (89c9f06f95a749d85dcad43610bf7d009b9373bb7f205d018e18ebb66ae6e69b): Error starting userland proxy: listen tcp 0.0.0.0:3306: bind: address already in use

ERROR: for db  Cannot start service db: driver failed programming external connectivity on endpoint stickynotes-jb_db_1 (89c9f06f95a749d85dcad43610bf7d009b9373bb7f205d018e18ebb66ae6e69b): Error starting userland proxy: listen tcp 0.0.0.0:3306: bind: address already in use
ERROR: Encountered errors while bringing up the project.
make: *** [run] Error 1
```
See erro above, port bound on host machine, so removed the port forwarding from yaml
& run again
```
[tricia@korra stickynotes-jb]$ make -f Makefile.docker-compose run
docker-compose up -d
Recreating stickynotes-jb_db_1 ... done
Creating stickynotes-jb_phpmyadmin_1 ... done
Creating stickynotes-jb_php_1        ... done
```
## docker-compose ps 
show running containers
```
docker-compose ps
           Name                          Command               State               Ports
----------------------------------------------------------------------------------------------------
stickynotes-jb_db_1           docker-entrypoint.sh --inn ...   Up      0.0.0.0:2000->3306/tcp,
                                                                       33060/tcp
stickynotes-jb_php_1          docker-php-entrypoint /bin ...   Up      0.0.0.0:8700->80/tcp
stickynotes-jb_phpmyadmin_1   /docker-entrypoint.sh apac ...   Up      0.0.0.0:8701->80/tcp
```
## docker-compose logs db
```
[tricia@korra stickynotes-jb]$ docker-compose logs db
Attaching to stickynotes-jb_db_1
db_1          | 2020-03-03 17:45:47+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-03 17:45:47+00:00 [Note] [Entrypoint]: Switching to dedicated user 'mysql'
db_1          | 2020-03-03 17:45:47+00:00 [Note] [Entrypoint]: Entrypoint script for MySQL Server 8.0.19-1debian9 started.
db_1          | 2020-03-03 17:45:47+00:00 [Note] [Entrypoint]: Initializing database files
db_1          | 2020-03-03T17:45:47.899240Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-03T17:45:47.899325Z 0 [System] [MY-013169] [Server] /usr/sbin/mysqld (mysqld 8.0.19) initializing of server in progress as process 46
db_1          | 2020-03-03T17:45:51.053162Z 5 [Warning] [MY-010453] [Server] root@localhost is created with an empty password ! Please consider switching off the --initialize-insecure option.
db_1          | 2020-03-03 17:45:53+00:00 [Note] [Entrypoint]: Database files initialized
db_1          | 2020-03-03 17:45:53+00:00 [Note] [Entrypoint]: Starting temporary server
db_1          | 2020-03-03T17:45:53.432696Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-03T17:45:53.432816Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 96
db_1          | 2020-03-03T17:45:53.941711Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
db_1          | 2020-03-03T17:45:53.959168Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
db_1          | 2020-03-03T17:45:53.979139Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 0  MySQL Community Server - GPL.
db_1          | 2020-03-03 17:45:53+00:00 [Note] [Entrypoint]: Temporary server started.
db_1          | 2020-03-03T17:45:54.084470Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock'
db_1          | Warning: Unable to load '/usr/share/zoneinfo/iso3166.tab' as time zone. Skipping it.
db_1          | Warning: Unable to load '/usr/share/zoneinfo/leap-seconds.list' as time zone. Skipping it.
db_1          | Warning: Unable to load '/usr/share/zoneinfo/zone.tab' as time zone. Skipping it.
db_1          | Warning: Unable to load '/usr/share/zoneinfo/zone1970.tab' as time zone. Skipping it.
db_1          | 2020-03-03 17:45:57+00:00 [Note] [Entrypoint]: Creating database assignment2
db_1          | 2020-03-03 17:45:57+00:00 [Note] [Entrypoint]: Creating user student
db_1          | 2020-03-03 17:45:57+00:00 [Note] [Entrypoint]: Giving user student access to schema assignment2
db_1          |
db_1          | 2020-03-03 17:45:57+00:00 [Note] [Entrypoint]: /usr/local/bin/docker-entrypoint.sh: running /docker-entrypoint-initdb.d/dbsetup.sql
db_1          |
db_1          |
db_1          | 2020-03-03 17:45:57+00:00 [Note] [Entrypoint]: Stopping temporary server
db_1          | 2020-03-03T17:45:57.788070Z 15 [System] [MY-013172] [Server] Received SHUTDOWN from user root. Shutting down mysqld (Version: 8.0.19).
db_1          | 2020-03-03T17:45:58.844864Z 0 [System] [MY-010910] [Server] /usr/sbin/mysqld: Shutdown complete (mysqld 8.0.19)  MySQL Community Server - GPL.
db_1          | 2020-03-03 17:45:59+00:00 [Note] [Entrypoint]: Temporary server stopped
db_1          |
db_1          | 2020-03-03 17:45:59+00:00 [Note] [Entrypoint]: MySQL init process done. Ready for start up.
db_1          |
db_1          | 2020-03-03T17:46:00.079051Z 0 [Warning] [MY-011070] [Server] 'Disabling symbolic links using --skip-symbolic-links (or equivalent) is the default. Consider not using this option as it' is deprecated and will be removed in a future release.
db_1          | 2020-03-03T17:46:00.079194Z 0 [System] [MY-010116] [Server] /usr/sbin/mysqld (mysqld 8.0.19) starting as process 1
db_1          | 2020-03-03T17:46:00.500156Z 0 [Warning] [MY-010068] [Server] CA certificate ca.pem is self signed.
db_1          | 2020-03-03T17:46:00.600651Z 0 [Warning] [MY-011810] [Server] Insecure configuration for --pid-file: Location '/var/run/mysqld' in the path is accessible to all OS users. Consider choosing a different directory.
db_1          | 2020-03-03T17:46:00.621649Z 0 [System] [MY-010931] [Server] /usr/sbin/mysqld: ready for connections. Version: '8.0.19'  socket: '/var/run/mysqld/mysqld.sock'  port: 3306  MySQL Community Server - GPL.
db_1          | 2020-03-03T17:46:00.683288Z 0 [System] [MY-011323] [Server] X Plugin ready for connections. Socket: '/var/run/mysqld/mysqlx.sock' bind-address: '::' port: 33060
db_1          | mbind: Operation not permitted
db_1          | mbind: Operation not permitted
```
## docker-compose logs php
Note for this container logs are mapped to localhost 
```
[tricia@korra stickynotes-jb]$ docker-compose logs php
Attaching to stickynotes-jb_php_1
php_1         | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.3. Set the 'ServerName' directive globally to suppress this message
```
access.log
```
[tricia@korra stickynotes-jb]$ tail /var/log/apache2/access.log
10.226.49.145 - - [03/Mar/2020:17:24:53 +0000] "POST /login.php HTTP/1.1" 200 491 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:25:06 +0000] "POST /login.php HTTP/1.1" 401 403 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:25:57 +0000] "-" 408 0 "-" "-"
10.226.49.145 - - [03/Mar/2020:17:46:33 +0000] "POST /login.php HTTP/1.1" 200 480 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:46:48 +0000] "POST /login.php HTTP/1.1" 200 463 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:46:48 +0000] "GET /StickyNotesAPI.php?username=tricia&method=retrieve HTTP/1.1" 500 465 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:46:59 +0000] "POST /StickyNotesAPI.php HTTP/1.1" 200 557 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:47:06 +0000] "POST /StickyNotesAPI.php HTTP/1.1" 200 558 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:47:09 +0000] "POST /StickyNotesAPI.php HTTP/1.1" 200 478 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
10.226.49.145 - - [03/Mar/2020:17:47:12 +0000] "POST /StickyNotesAPI.php HTTP/1.1" 200 478 "http://korra.dawsoncollege.qc.ca:8700/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
```
error.log
```
[tricia@korra stickynotes-jb]$ tail /var/log/apache2/error.log
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.4. Set the 'ServerName' directive globally to suppress this message
[Tue Mar 03 17:21:11.286537 2020] [mpm_prefork:notice] [pid 8] AH00163: Apache/2.4.38 (Debian) PHP/7.2.28 configured -- resuming normal operations
[Tue Mar 03 17:21:11.286618 2020] [core:notice] [pid 8] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.3. Set the 'ServerName' directive globally to suppress this message
[Tue Mar 03 17:45:49.711816 2020] [mpm_prefork:notice] [pid 8] AH00163: Apache/2.4.38 (Debian) PHP/7.2.28 configured -- resuming normal operations
[Tue Mar 03 17:45:49.711866 2020] [core:notice] [pid 8] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
```
## docker-compose logs phpmyadmin
```
[tricia@korra stickynotes-jb]$ docker-compose logs phpmyadmin
Attaching to stickynotes-jb_phpmyadmin_1
phpmyadmin_1  | phpMyAdmin not found in /var/www/html - copying now...
phpmyadmin_1  | Complete! phpMyAdmin has been successfully copied to /var/www/html
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.4. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.18.0.4. Set the 'ServerName' directive globally to suppress this message
phpmyadmin_1  | [Tue Mar 03 17:45:50.239330 2020] [mpm_prefork:notice] [pid 1] AH00163: Apache/2.4.38 (Debian) PHP/7.4.1 configured -- resuming normal operations
phpmyadmin_1  | [Tue Mar 03 17:45:50.239378 2020] [core:notice] [pid 1] AH00094: Command line: 'apache2 -D FOREGROUND'
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:16 +0000] "GET /db_structure.php?server=1&db=assignment2 HTTP/1.1" 200 5191 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:17 +0000] "GET /favicon.ico HTTP/1.1" 200 22788 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:20 +0000] "POST /index.php HTTP/1.1" 302 1308 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:20 +0000] "GET /index.php?db=assignment2&target=db_structure.php HTTP/1.1" 200 12541 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1 HTTP/1.1" 200 20598 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/arrow_ltr.png HTTP/1.1" 200 384 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/s_asc.png HTTP/1.1" 200 429 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/s_desc.png HTTP/1.1" 200 430 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/b_no_favorite.png HTTP/1.1" 200 662 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/bd_browse.png HTTP/1.1" 200 556 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/bd_select.png HTTP/1.1" 200 610 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/b_insrow.png HTTP/1.1" 200 441 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/bd_empty.png HTTP/1.1" 200 611 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/b_drop.png HTTP/1.1" 200 921 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/b_print.png HTTP/1.1" 200 923 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /themes/pmahomme/img/b_tblanalyse.png HTTP/1.1" 200 435 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "POST /ajax.php HTTP/1.1" 200 2724 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "POST /navigation.php?ajax_request=1 HTTP/1.1" 200 3417 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "POST /ajax.php HTTP/1.1" 200 2828 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "POST /ajax.php HTTP/1.1" 200 2718 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:21 +0000] "GET /navigation.php?ajax_request=1&aPath=cm9vdA%3D%3D.YXNzaWdubWVudDI%3D&vPath=cm9vdA%3D%3D.YXNzaWdubWVudDI%3D&pos=0&pos2_name=&pos2_value=&searchClause=&searchClause2=&_nocache=1583257577380617123&token=584d4b75706f5d6e4c706e7e21324024 HTTP/1.1" 200 3115 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /sql.php?server=1&db=assignment2&table=sticky_notes&pos=0&ajax_request=true&ajax_page_request=true&_nocache=158325758076434026&token=584d4b75706f5d6e4c706e7e21324024 HTTP/1.1" 200 5966 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /themes/pmahomme/img/b_browse.png HTTP/1.1" 200 770 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /themes/pmahomme/img/b_tblexport.png HTTP/1.1" 200 798 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /themes/pmahomme/img/b_tblimport.png HTTP/1.1" 200 840 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /themes/pmahomme/img/s_success.png HTTP/1.1" 200 749 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /themes/pmahomme/img/b_view_add.png HTTP/1.1" 200 962 "http://korra.dawsoncollege.qc.ca:8701/themes/pmahomme/css/theme.css?v=5.0.1&nocache=6319120768ltr&server=1" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /js/vendor/jquery/jquery.uitablefilter.js?v=5.0.1 HTTP/1.1" 200 1741 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /js/multi_column_sort.js?v=5.0.1 HTTP/1.1" 200 1619 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /js/gis_data_editor.js?v=5.0.1 HTTP/1.1" 200 4044 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:24 +0000] "GET /index.php?ajax_request=1&recent_table=1&no_debug=true&_nocache=1583257580906832549&token=584d4b75706f5d6e4c706e7e21324024 HTTP/1.1" 200 2780 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:28 +0000] "GET /sql.php?server=1&db=assignment2&table=users&pos=0&ajax_request=true&ajax_page_request=true&_nocache=1583257583398719992&token=584d4b75706f5d6e4c706e7e21324024 HTTP/1.1" 200 5950 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 10.226.49.145 - - [03/Mar/2020:17:46:28 +0000] "GET /index.php?ajax_request=1&recent_table=1&no_debug=true&_nocache=1583257584415615411&token=584d4b75706f5d6e4c706e7e21324024 HTTP/1.1" 200 2796 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"
phpmyadmin_1  | 127.0.0.1 - - [03/Mar/2020:17:46:31 +0000] "OPTIONS * HTTP/1.0" 200 126 "-" "Apache/2.4.38 (Debian) PHP/7.4.1 (internal dummy connection)"
phpmyadmin_1  | 127.0.0.1 - - [03/Mar/2020:17:46:32 +0000] "OPTIONS * HTTP/1.0" 200 126 "-" "Apache/2.4.38 (Debian) PHP/7.4.1 (internal dummy connection)"
phpmyadmin_1  | 127.0.0.1 - - [03/Mar/2020:17:46:34 +0000] "OPTIONS * HTTP/1.0" 200 126 "-" "Apache/2.4.38 (Debian) PHP/7.4.1 (internal dummy connection)"
```
## docker volume # show volume info
### list all volumes
```
[tricia@acerfed31 stickynotes-jb]$ docker volume ls
DRIVER              VOLUME NAME
local               stickynotes-jb_persistent
```
### docker volume inspect 
```
[tricia@acerfed31 stickynotes-jb]$ docker volume inspect stickynotes-jb_persistent
[
    {
        "CreatedAt": "2020-04-09T11:41:34-04:00",
        "Driver": "local",
        "Labels": {
            "com.docker.compose.project": "stickynotes-jb",
            "com.docker.compose.version": "1.25.4",
            "com.docker.compose.volume": "persistent"
        },
        "Mountpoint": "/var/lib/docker/volumes/stickynotes-jb_persistent/_data",
        "Name": "stickynotes-jb_persistent",
        "Options": null,
        "Scope": "local"
    }
]
```
## docker network # show network info
### `docker network ls ` list all networks
```
[tricia@acerfed31 stickynotes-jb]$ docker network ls
NETWORK ID          NAME                      DRIVER              SCOPE
d561a6579943        bridge                    bridge              local
2fe32b75f7bb        host                      host                local
091b69fcf3d3        none                      null                local
f85012b2c913        stickynotes-jb_backend    bridge              local
e11b5625acab        stickynotes-jb_frontend   bridge              local
```
### `docker inspect backend`
```
[tricia@acerfed31 stickynotes-jb]$ docker network inspect stickynotes-jb_backend
[
    {
        "Name": "stickynotes-jb_backend",
        "Id": "f85012b2c9130b0fbe69025a6bff21085f66940865422be3a61208de6d2c6ea1",
        "Created": "2020-04-09T11:33:05.023011357-04:00",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": [
                {
                    "Subnet": "172.18.0.0/16",
                    "Gateway": "172.18.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": true,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Containers": {
            "237a9c549dc1b71d486a5a5ef56c316fdf438cf859fb3b7b945d7f0f3898b2c7": {
                "Name": "stickynotes-jb_phpmyadmin_1",
                "EndpointID": "4f40d1725699e9a32acc48c81ff6f59475c7ab312a14349424b99994202fc59c",
                "MacAddress": "02:42:ac:12:00:04",
                "IPv4Address": "172.18.0.4/16",
                "IPv6Address": ""
            },
            "3cf97006e12bee01d67c2517eea7f0ceef190987d07627c48d2a0c59135bb3f1": {
                "Name": "stickynotes-jb_php_1",
                "EndpointID": "cb0e4617c93defd3199849d43b5cbb187a84108fd617398077567d4c9667ab42",
                "MacAddress": "02:42:ac:12:00:03",
                "IPv4Address": "172.18.0.3/16",
                "IPv6Address": ""
            },
            "eb5182faa86f6018278317db39a86a338c96214ed930a92fc9621b39b9e7e711": {
                "Name": "stickynotes-jb_db_1",
                "EndpointID": "eec45414343a8eed4e5c0e13505cb1783c7f63a4d4d4f528cf8b9069cf577395",
                "MacAddress": "02:42:ac:12:00:02",
                "IPv4Address": "172.18.0.2/16",
                "IPv6Address": ""
            }
        },
        "Options": {},
        "Labels": {
            "com.docker.compose.network": "backend",
            "com.docker.compose.project": "stickynotes-jb",
            "com.docker.compose.version": "1.25.4"
        }
    }
]
```
### `docker inspect frontend`
```
[tricia@acerfed31 stickynotes-jb]$ docker network inspect stickynotes-jb_frontend
[
    {
        "Name": "stickynotes-jb_frontend",
        "Id": "e11b5625acab34f108f3baac7c6260aaa08d1ec993a9eb5191bec56fc6659f37",
        "Created": "2020-04-09T11:33:05.639754062-04:00",
        "Scope": "local",
        "Driver": "bridge",
        "EnableIPv6": false,
        "IPAM": {
            "Driver": "default",
            "Options": null,
            "Config": [
                {
                    "Subnet": "172.19.0.0/16",
                    "Gateway": "172.19.0.1"
                }
            ]
        },
        "Internal": false,
        "Attachable": true,
        "Ingress": false,
        "ConfigFrom": {
            "Network": ""
        },
        "ConfigOnly": false,
        "Containers": {
            "237a9c549dc1b71d486a5a5ef56c316fdf438cf859fb3b7b945d7f0f3898b2c7": {
                "Name": "stickynotes-jb_phpmyadmin_1",
                "EndpointID": "70ec149a3bd41ab8058aa44e4758a92318a463687d4a2d01e4c78cc8dca2cd78",
                "MacAddress": "02:42:ac:13:00:03",
                "IPv4Address": "172.19.0.3/16",
                "IPv6Address": ""
            },
            "3cf97006e12bee01d67c2517eea7f0ceef190987d07627c48d2a0c59135bb3f1": {
                "Name": "stickynotes-jb_php_1",
                "EndpointID": "032f87e812a601efd58bcdf2430790700671bbae86dc3989786c77ee95b43d8f",
                "MacAddress": "02:42:ac:13:00:02",
                "IPv4Address": "172.19.0.2/16",
                "IPv6Address": ""
            }
        },
        "Options": {},
        "Labels": {
            "com.docker.compose.network": "frontend",
            "com.docker.compose.project": "stickynotes-jb",
            "com.docker.compose.version": "1.25.4"
        }
    }
]
```
## docker login
```
[tricia@korra stickynotes-jb]$ docker login
Login with your Docker ID to push and pull images from Docker Hub. If you don't have a Docker ID, head over to https://hub.docker.com to create one.
Username: tricia
Password:
WARNING! Your password will be stored unencrypted in /home/tricia/.docker/config.json.
Configure a credential helper to remove this warning. See
https://docs.docker.com/engine/reference/commandline/login/#credentials-store

Login Succeeded
```
## docker tag
```
[tricia@korra stickynotes-jb]$ docker images
REPOSITORY                               TAG                 IMAGE ID            CREATED             SIZE
stickynotes-jb_php                       latest              9197aaadf76b        About an hour ago   428MB
mysql                                    latest              7a3923452254        18 hours ago        465MB
registry.heroku.com/shakespeare-jm/web   latest              cba946926c78        23 hours ago        549MB
[tricia@korra stickynotes-jb]$ docker tag stickynotes-jb_php:latest tricia/stickynotes-jb_php
[tricia@korra stickynotes-jb]$ docker images
REPOSITORY                               TAG                 IMAGE ID            CREATED             SIZE
stickynotes-jb_php                       latest              9197aaadf76b        About an hour ago   428MB
tricia/stickynotes-jb_php                latest              9197aaadf76b        About an hour ago   428MB
mysql                                    latest              7a3923452254        18 hours ago        465MB
registry.heroku.com/shakespeare-jm/web   latest              cba946926c78        23 hours ago        549MB
```
## docker push
```
[tricia@korra stickynotes-jb]$ docker push tricia/stickynotes-jb_php:latest
The push refers to repository [docker.io/tricia/stickynotes-jb_php]
7a9a9ebb9ac1: Pushed
9c7d58334000: Pushed
6565bce2d5e5: Mounted from library/php
2159d2f64d7e: Mounted from library/php
7c111aa3fc84: Mounted from library/php
1bc9b7122630: Mounted from library/php
bc4aa4d1d971: Mounted from library/php
8b81b9cd95de: Mounted from library/php
85dc2281e45a: Mounted from library/php
0fc284fc9cf5: Mounted from library/php
732057c800a3: Mounted from library/php
4cc11613548d: Mounted from library/php
df6c050501b6: Mounted from library/php
b4bfb20b5f05: Mounted from library/php
2e8cc9f5313f: Mounted from library/php
f2cb0ecef392: Mounted from library/php
latest: digest: sha256:874ef0ef1e02a9f5001df1ba0096785fd8ffe61c6bb8baf6540a2ef8ce6ee402 size: 3664
```
