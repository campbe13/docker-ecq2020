# docker is installed on Fedora 31, run the image from docker hub
n.b note I do not use -d detach so I see the apache log output, if you don't want that, use -d
```
[tricia@acerfed31 ~]$ docker run -p 8088:80 tricia/shakespeare-jm
Unable to find image 'tricia/shakespeare-jm:latest' locally
latest: Pulling from tricia/shakespeare-jm
bc51dd8edc1b: Pull complete
a3224e2c3a89: Pull complete
be7a066df88f: Pull complete
bfdf741d72a9: Pull complete
a9e612a5f04c: Pull complete
c026d8d0e8cb: Pull complete
d94096c4941c: Pull complete
0f9653ad58ae: Pull complete
1d97d51f6437: Pull complete
4ad873fa227d: Pull complete
933056a49e3b: Pull complete
948195254531: Pull complete
e0ab11975556: Pull complete
2acb7af78b53: Pull complete
b38b4f189038: Pull complete
a1d4de587eae: Pull complete
851c1faf3eb4: Pull complete
3dc19936adc8: Pull complete
c3ce04bb6f9a: Pull complete
63d25d39e6ea: Pull complete
Digest: sha256:1555a4379417433759188719eb50685a1aa05b61f49e8a677ee7d73b2a438718
Status: Downloaded newer image for tricia/shakespeare-jm:latest
Starting Shakespeare text model loading.
Connection to data storage successful. Flushed previous results and now attempting to insert data
Model created with length of key of 3
Inserting of model data was successful.
Model created with length of key of 6
Inserting of model data was successful.
Model created with length of key of 10
Inserting of model data was successful.
Inserting of all data was successful terminating program
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.2. Set the 'ServerName' directive globally to suppress this message
[Mon Feb 17 23:45:21.114192 2020] [mpm_prefork:notice] [pid 18] AH00163: Apache/2.4.38 (Debian) PHP/7.2.27 configured -- resuming normal operations
[Mon Feb 17 23:45:21.114279 2020] [core:notice] [pid 18] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
192.168.0.193 - - [17/Feb/2020:23:48:20 +0000] "GET / HTTP/1.1" 200 779 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:21 +0000] "GET /favicon.ico HTTP/1.1" 404 493 "http://192.168.0.112:8088/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:23 +0000] "GET /app/index.php HTTP/1.1" 200 890 "http://192.168.0.112:8088/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:24 +0000] "GET /app/styles/main_styling.css HTTP/1.1" 200 1521 "http://192.168.0.112:8088/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:24 +0000] "GET /app/images/spotlight.png HTTP/1.1" 200 129405 "http://192.168.0.112:8088/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:24 +0000] "GET /app/images/shakespeare.png HTTP/1.1" 200 273706 "http://192.168.0.112:8088/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:24 +0000] "GET /app/images/backgroundPattern.png HTTP/1.1" 200 3000 "http://192.168.0.112:8088/app/styles/main_styling.css" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:27 +0000] "POST /app/index.php HTTP/1.1" 200 1531 "http://192.168.0.112:8088/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
192.168.0.193 - - [17/Feb/2020:23:48:31 +0000] "POST /app/index.php HTTP/1.1" 200 1548 "http://192.168.0.112:8088/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.106 Safari/537.36"
```
