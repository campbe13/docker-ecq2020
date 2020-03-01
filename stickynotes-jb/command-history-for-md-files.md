 1112  exit
 1113  fg
 1114  exit
 1115  docker ps 
 1116  docker exec -ti jeff-php-mysql_db_1 bash
 1117  docker ps
 1118  history
 1119  docker exec -ti jeff-php-mysql_db_1 bash
 1120  docker exec -ti jeff-php-mysql_db_1 bash 
 1121  ls 
 1122  docker images
 1123  docker system prune
 1124  ls 
 1125  docker ps
 1126  docker exec -ti jeff-php-mysql_db_1 bash 
 1127  docker ps
 1128  docker exec -ti stickynotes-jb_db_1 bash 
 1129  docker ps
 1130  gedit ecq/docker-ecq2020/DOCKERCMDS.md 
 1131  bg
 1132  man docker system
 1133  man docker system prune
 1134  docker system prune -h
 1135  man docker images
 1136  docker version
 1137  tricia@acerubuntu1804:~$ docker version
 1138  Client: Docker Engine - Community
 1139  Server: Docker Engine - Community
 1140  jobs
 1141  jobs
 1142  docker version
 1143  docker info
 1144  systemctl status docker 
 1145  cd ecq/docker-ecq2020/jeff-php-mysql/
 1146  ls
 1147  docker-compose 
 1148  docker-compose docker-compose.yml 
 1149  docker-compose config docker-compose.yml 
 1150  docker-compose config --services  docker-compose.yml 
 1151  docker-compose config --services 
 1152  vi docker-compose.yml 
 1153  fg
 1154  gedit docker-compose.yml 
 1155  bg
 1156  cd /tmp
 1157  vi Dockerfile 
 1158  docker images
 1159  fg
 1160  cat Dockerfile 
 1161  cd -
 1162  docker-compose config --services 
 1163  gedit README.md &
 1164  docker-compose --version
 1165  docker --version
 1166  gedit ../README.md 
 1167  docker-compose config --services
 1168  docker-compose config 
 1169  ls 
 1170  vi docker-compose.yml 
 1171  docker-compose config 
 1172  man docker-compose
 1173  man docker compose
 1174  docker-compose config -D
 1175  docker-compose -D config
 1176  docker-compose build 
 1177  ls 
 1178  docker ps
 1179  docker logs js-mf
 1180  docker logs shakespeare-jm 
 1181  gedit ../DOCKERCMDS.md 
 1182  tricia@acerubuntu1804:~/ecq/docker-ecq2020/jeff-php-mysql$ docker logs shakespeare-jm
 1183  AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.3. Set the 'ServerName' directive globally to suppress this message
 1184  AH00558: apache2: Could not reliably determine the server's fully qualified domain name, using 172.17.0.3. Set the 'ServerName' directive globally to suppress this message
 1185  [Sat Feb 22 22:21:46.276748 2020] [mpm_prefork:notice] [pid 13] AH00163: Apache/2.4.38 (Debian) PHP/7.2.27 configured -- resuming normal operations
 1186  [Sat Feb 22 22:21:46.277134 2020] [core:notice] [pid 13] AH00094: Command line: '/usr/sbin/apache2 -D FOREGROUND'
 1187  192.168.0.192 - - [22/Feb/2020:22:21:52 +0000] "GET / HTTP/1.1" 200 779 "-" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1188  192.168.0.192 - - [22/Feb/2020:22:21:53 +0000] "GET /favicon.ico HTTP/1.1" 404 493 "http://192.168.0.117:8080/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1189  192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/index.php HTTP/1.1" 200 890 "http://192.168.0.117:8080/" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1190  192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/styles/main_styling.css HTTP/1.1" 200 1521 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1191  192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/images/shakespeare.png HTTP/1.1" 304 183 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1192  192.168.0.192 - - [22/Feb/2020:22:21:55 +0000] "GET /app/images/spotlight.png HTTP/1.1" 304 183 "http://192.168.0.117:8080/app/index.php" "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.116 Safari/537.36"
 1193  ls 
 1194  cd mysql/
 1195  ls
 1196  cat ../*y*
 1197  mv ../docker-compose.yml ../docker-compose.yaml
 1198  ls 
 1199  cat Dockerfile 
 1200  ls 
 1201  cat tables.php 
 1202  ls 
 1203  vi config.ini  
 1204  ls
 1205  vi Dockerfile 
 1206  ls
 1207  cat Dockerfile 
 1208  cat tables.php >> dbseed.sql
 1209  vi dbseed.sql 
 1210  cd ..
 1211  docker-compose up 
 1212  ls 
 1213  vi php/Dockerfile 
 1214  docker-compose build
 1215  docker-compose up
 1216  docker images
 1217  docker ps 
 1218  ls 
 1219  cd php/ 
 1220  ls
 1221  docker build -t mysqlme .
 1222  vi Dockerfile 
 1223  cd ../mysql/
 1224  ls
 1225  vi Dockerfile 
 1226  docker build -t mysqlme .
 1227  docker ps
 1228  history |grep run
 1229  docker images
 1230  docker run mysqlme -ti sh
 1231  ls 
 1232  docker run -d -ti mysqlme bash
 1233  docker ps
 1234  docker exec -ti festive_greider
 1235  docker exec -ti festive_greider bash
 1236  ls 
 1237  docker rm festive_greider bash
 1238  docker stop festive_greider 
 1239  docker rm festive_greider bash
 1240  ls
 1241  cd ..
 1242  docker-compose up
 1243  docker-compose -d up
 1244  docker-compose up -d
 1245  docker ps
 1246  ln ../../jeff-php-mysql/ . -s
 1247  ls
 1248  ls jeff-php-mysql
 1249  ls
 1250  ls jeff-php-mysql/
 1251  cd jeff-php-mysql
 1252  ls
 1253  cd ..
 1254  rm jeff-php-mysql
 1255  cd ..
 1256  ls
 1257  cd jeff-php-mysql/
 1258  ls
 1259  cd ..
 1260  rm jeff-php-mysql/ -rf
 1261  cd proj2php/
 1262  ls
 1263  cd jeffstickyphp/
 1264  ls
 1265  cd ../../
 1266  cd docker-ecq2020/
 1267  ls
 1268  ls 
 1269  cd ..
 1270  cd jeffstickyphp.bak/
 1271  ls
 1272  cd ..
 1273  cd docker-ecq2020/jeff-php-mysql/ls 
 1274  cd docker-ecq2020/jeff-php-mysql/ 
 1275  ls
 1276  vi docker-compose.yaml 
 1277  fg
 1278  docker-compose 
 1279  docker-compose logs
 1280  docker-compose stop 
 1281  docker images 
 1282  docker-compose 
 1283  docker ps
 1284  docker-compose 
 1285  docker images
 1286  docker system prune
 1287  docker-compose up -d 
 1288  ls 
 1289  docker ps 
 1290  docker logs
 1291  docker-compose logs 
 1292  ls 
 1293  cd ..
 1294  ls 
 1295  cd -
 1296  ls 
 1297  cd ../../proj2php/jeffstickyphp/
 1298  ls
 1299  cat LoginConstants.php 
 1300  ls 
 1301  cat login.php 
 1302  ls 
 1303  less login.php 
 1304  ls 
 1305  cat login.php 
 1306  less login.php 
 1307  ls
 1308  less login.php 
 1309  grep proj2 `find ./ -name "*.php"`
 1310  grep include `find ./ -name "*.php"`
 1311  grep include `find ./ -name "*.php"`> all.txt
 1312  gedit all.txt &
 1313  ls 
 1314  grep proj2 `find ./ -name "*.php"`>all.txt
 1315  vi login.php 
 1316  vi StickyNotesAPI.
 1317  vi StickyNotesAPI.php 
 1318  vi controller/Authentication.php 
 1319  vi controller/UserStickyNotesDAO.php 
 1320  vi controller/UserStickyNotesDAOInterface.php 
 1321  cat database-utils/config.ini
 1322  grep proj2 `find ./ -name "*.php"`>all.txt
 1323  rm all.txt 
 1324  ls
 1325  vi index.html 
 1326  cd -
 1327  docker-compose stop 
 1328  docker ps
 1329  docker images
 1330  docker rmi mysqlme
 1331  docker rmi jeff-php-mysql_php 
 1332  docker ps
 1333  docker rm jeff-php-mysql_php 
 1334  docker rm jeff-php-mysql_php1 
 1335  docker system prune 
 1336  docker-compose up -d 
 1337  cd -
 1338  cat README.md 
 1339  ls 
 1340  vi index.html 
 1341  grep pmc *
 1342  grep -i pmc *
 1343  fg
 1344  bg
 1345  vi index.html 
 1346  docker logs
 1347  docker-compose logs
 1348  cd -
 1349  docker-compose logs
 1350  gedit mysql/dbseed.sql 
 1351  docker-compose build db
 1352  docker-compose stop 
 1353  docker-compose build
 1354  docker-compose up -d
 1355  docker-compose stop 
 1356  ls 
 1357  docker-compose build
 1358  docker-compose up db
 1359  cat mysql/dbseed.sql 
 1360  head  mysql/dbseed.sql 
 1361  cd mysql/
 1362  docker build 
 1363  docker build  .
 1364  cd ..
 1365  docker-compose stop
 1366  docker-compose  up -d 
 1367  docker-compose logs
 1368  docker-compose logs -f
 1369  cd mysql/
 1370  head dbseed.sql 
 1371  mv dbseed.sql dbsetup.sql
 1372  vi Dockerfile 
 1373  cat Dockerfile 
 1374  cd ..
 1375  cd -
 1376  ls 
 1377  docker build .
 1378  cd ..
 1379  docker-compose 
 1380  docker-compose down 
 1381  docker-compose build
 1382  docker-compose up -d
 1383  cd mysql/
 1384  ls
 1385  vi Dockerfile 
 1386  docker build .
 1387  docker images
 1388  docker 
 1389  docker
 1390  docker info
 1391  cd ../../shakespeare-ec/
 1392  ls
 1393  vi Makefile
 1394  cat Makefile
 1395  gedit ../DOCKERCMDS.md 
 1396  cat Makefile
 1397  cd -
 1398  docker-compose down
 1399  docker-compose build 
 1400  docker-compose up -d
 1401  ls
 1402  docker ps
 1403  docker logs
 1404  docker-compose logs
 1405  ls
 1406  cat Dockerfile 
 1407  cat dbsetup.sql 
 1408  gedit dbsetup.sql 
 1409  gedit dbsetup.sql  &
 1410  ls 
 1411  cat dbsetup.sql 
 1412  vi dbsetup.sql 
 1413  mysql -p
 1414  mysql -p <dbsetup.sql 
 1415  vi dbsetup.sql 
 1416  mysql -p <dbsetup.sql 
 1417  cat dbsetup.sql 
 1418  mysql -p <dbsetup.sql 
 1419  mysql -U ROOT -p <dbsetup.sql 
 1420  mysql -u root -p <dbsetup.sql 
 1421  mysql -p <dbsetup.sql 
 1422  mysql -u root -p <dbsetup.sql 
 1423  cd ..
 1424  ls
 1425  cd ..
 1426  ls 
 1427  mv jeff-php-mysql/ stickynotes-jb
 1428  ls 
 1429  cd stickynotes-jb/
 1430  cd ..
 1431  vi README.md 
 1432  cd stickynotes-jb/
 1433  grep jeff `find ./`
 1434  vi README.md 
 1435  ls 
 1436  mysql -u root
 1437  mysql -u root -p
 1438  mysql -p 
 1439  gedit mysql/dbsetup.sql 
 1440  bg
 1441  docker-compose down 
 1442  docker-compose build
 1443  docker-compose up -d
 1444  docker ps
 1445  cat Makefile 
 1446  docker ps
 1447  docker stop stickynotes-jb_db_1 
 1448  docker rm stickynotes-jb_db_1 
 1449  docker stop stickynotes-jb_php_1
 1450  docker RM  stickynotes-jb_php_1
 1451  docker rm  stickynotes-jb_php_1
 1452  docker rm
 1453  docker stop jeff-php-mysql_php_1 
 1454  docker rm jeff-php-mysql_php_1 
 1455  docker ps
 1456  docker-compose up -d
 1457  docker ps
 1458  docker-compose logs 
 1459  vi mysql/dbsetup.sql 
 1460  docker-compose build db
 1461  docker-compose stop 
 1462  docker-compose up -d 
 1463  docker-compose logs
 1464  docker ps 
 1465  docker-compose stop 
 1466  docker images
 1467  docker system prune -a 
 1468  docker images 
 1469  cd mysql/
 1470  ls
 1471  cd ..
 1472  vi docker-compose.yaml 
 1473  gedit docker-compose.yaml 
 1474  bg
 1475  ls 
 1476  ssh-copy-id 
 1477  ssh-copy-id tricia@192.168.0.112
 1478  sudo vi /etc/hosts
 1479  ssh acerfedora31
 1480  exit
 1481  sudo snap install --classic heroku
 1482  heroku container:login
 1483  docker login --username=_ registry.heroku.com
 1484  docker login --username=pcampbell.edu@gmail.com registry.heroku.com
 1485  docker images
 1486  docker run tricia/shakespeare-ec
 1487  cd ecq/docker-ecq2020/shakespeare-ec/
 1488  vi README.md 
 1489  vi RUNONHEROKU.md
 1490  cat RUNONHEROKU.md 
 1491  vi RUNONHEROKU.md 
 1492  exit
 1493  cd ecq/docker-ecq2020/shakespeare-ec/ 
 1494  vi heroku-auth-token.txt
 1495  docker ps
 1496  ls
 1497  make stop 
 1498  docker stop naughty_benz
 1499  docker rm  naughty_benz
 1500  vi heroku-registry-login.sh
 1501  ls
 1502  fg
 1503  chmod +x heroku-registry-login.sh 
 1504  ./heroku-registry-login.sh 
 1505  cat heroku-registry-login.sh 
 1506  vi her*sh
 1507  bash -x heroku-registry-login.sh 
 1508  cat /home/tricia/.docker/config.json 
 1509  docker images
 1510  docker push registry.heroku.com/tricia/shakespeare-ec/web
 1511  docker tag tricia/shakepeare-ec registry.heroku.com/shakepeare-ec/web 
 1512  docker images
 1513  docker tag tricia/shakespeare-ec registry.heroku.com/shakepeare-ec/web 
 1514  docker images
 1515  docker push registry.heroku.com/shakepeare-ec/web 
 1516  man docker push
 1517  ./heroku-registry-login.sh 
 1518  docker push registry.heroku.com/shakepeare-ec/web 
 1519  docker tag tricia/shakespeare-ec registry.heroku.com/shakepeare-ec
 1520  docker push registry.heroku.com/shakepeare-ec
 1521  htricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker images
 1522  REPOSITORY              TAG                 IMAGE ID            CREATED             SIZE
 1523  tricia/shakespeare-jm   latest              561c7ca0d5b4        4 days ago          552MB
 1524  tricia/js-mf            latest              a0414309c595        5 days ago          17.5MB
 1525  tricia/shakespeare-ec   latest              8524faf9b7b8        5 days ago          602MB
 1526  tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker tag tricia/shakespeare-ec registry.he                              roku.com/shakepeare-ec/web
 1527  tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker images
 1528  REPOSITORY                              TAG                 IMAGE ID            CREATED             SIZ                              E
 1529  tricia/shakespeare-jm                   latest              561c7ca0d5b4        4 days ago          552                              MB
 1530  tricia/js-mf                            latest              a0414309c595        5 days ago          17.                              5MB
 1531  tricia/shakespeare-ec                   latest              8524faf9b7b8        5 days ago          602                              MB
 1532  registry.heroku.com/shakepeare-ec/web   latest              8524faf9b7b8        5 days ago          602                              MB
 1533  tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker push registry.heroku.com/shakepeare-e                              c/web
 1534  The push refers to repository [registry.heroku.com/shakepeare-ec/web]
 1535  407a07d5677e: Preparing
 1536  06f0bf03abbd: Preparing
 1537  2791ffca167d: Preparing
 1538  tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ bash -x heroku-registry-login.sh
 1539  ++ cat heroku-auth-token.txt
 1540  + token=69cfe805-92c8-4b92-9eef-c19dce06cf04
 1541  + docker login --username=_ --password=69cfe805-92c8-4b92-9eef-c19dce06cf04 registry.heroku.com
 1542  WARNING! Using --password via the CLI is insecure. Use --password-stdin.
 1543  WARNING! Your password will be stored unencrypted in /home/tricia/.docker/config.json.
 1544  Configure a credential helper to remove this warning. See
 1545  https://docs.docker.com/engine/reference/commandline/login/#credentials-store
 1546  Login Succeeded
 1547  tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ cat /home/tricia/.docker/config.json
 1548  {         "auths": {;                 "https://index.docker.io/v1/": {;                         "auth": "dHJpY2lhOmVkdWNhdGUz";                 },;                 "registry.heroku.com": {;                         "auth": "Xzo2OWNmZTgwNS05MmM4LTRiOTItOWVlZi1jMTlkY2UwNmNmMDQ=";                 }
 1549  }exit
 1550  4di6
 1551  exit
 1552  cd ecq/docker-ecq2020/
 1553  cd shakespeare-
 1554  cd shakespeare-ec/
 1555  ls
 1556  cat RUNONHEROKU.md 
 1557  docker images
 1558  docker push registry.heroku.com/shakespeare-ec 
 1559  docker push registry.heroku.com/shakepeare-ec
 1560  heroku auth:token
 1561  heroku login
 1562  heroku login --help
 1563  ls 
 1564  cat heroku-registry-login.sh 
 1565  bash -x heroku-registry-login.sh 
 1566  docker push registry.heroku.com/shakepeare-ec
 1567  cd ..
 1568  mkdir hello-world-go-heroku
 1569  cd hello-world-go-heroku/
 1570  vi main.go
 1571  vi Dockerfile
 1572  docker build -t tricia/goheroku 
 1573  docker build -t tricia/goheroku  .
 1574  docker run -rm -it -p 8888:8080 tricia/goheroku
 1575  docker run --rm -it -p 8888:8080 tricia/goheroku
 1576  cat Dockerfile t not found: manifest unknown:
 1577  vi Dockerfile 
 1578  docker build -t tricia/goheroku  .
 1579  vi Dockerfile 
 1580  docker build -t tricia/goheroku  .
 1581  docker exec -ti tricia/goheroku bash
 1582  docker images
 1583  docker exec -ti tricia/goheroku bash
 1584  docker run -ti tricia/goheroku -name goheroku
 1585  docker run -ti -p 8888:8080 tricia/goheroku --name goheroku
 1586  docker run -ti -p 8888:8080 tricia/goheroku
 1587  docker run -ti -p 8888:8080 tricia/goheroku 
 1588  docker build -t tricia/goheroku  .
 1589  docker system prune
 1590  docker images
 1591  docker run -ti -p 8888:8080 tricia/goheroku 
 1592  ls
 1593  ls 
 1594  vi main.go 
 1595  hi docker run -ti -p 8888:8080 tricia/goheroku
 1596  vi ../DOCKERCMDS.md 
 1597  ls
 1598  heroku container:login
 1599  heroku login
 1600  heroku help
 1601  heroku login help
 1602  heroku login -i
 1603  tricia@acerubuntu1804:~/ecq/docker-ecq2020/hello-world-go-heroku$ heroku login -i
 1604  heroku: Enter your login credentials
 1605  Email: pcampbell.edu@gmail.com
 1606  Password: *********
 1607  Logged in as pcampbell.edu@gmail.com
 1608  heroku create 
 1609  tricia@acerubuntu1804:~/ecq/docker-ecq2020/hello-world-go-heroku$ heroku create
 1610  Creating app... done, ⬢ blooming-anchorage-54363
 1611  https://blooming-anchorage-54363.herokuapp.com/ | https://git.heroku.com/blooming-anchorage-54363.git
 1612  tricia@acerubuntu1804:~/ecq/docker-ecq2020/hello-world-go-heroku$
 1613  heroku container:push web --app ${blooming-anchorage-54363}
 1614  heroku container:push web --app ${blooming-anchorage-54363.herokuapp.com}
 1615  heroku container:push web --app ${blooming-anchorage-54363}
 1616  heroku container:push web --app ${https://blooming-anchorage-54363.herokuapp.com}
 1617  heroku container:push web --app ${https://blooming-achorage-54363.herokuapp.com}
 1618  heroku container:push web --app ${https://blooming-anchorage-54363.herokuapp.com}
 1619  heroku container:push web --app blooming-anchorage-54363
 1620  gedit README.md &
 1621  heroku container:release 
 1622  heroku container:release web --app blooming-anchorage-54363
 1623  cd ..
 1624  gedit README.md &
 1625  git add .
 1626  git status
 1627  git add -m "working on heroku deployment of containers"
 1628  git commit -m "working on heroku deployment of containers"
 1629  push
 1630  exit
 1631  cd ecq/docker-ecq2020/
 1632  pull 
 1633  cd hello-world-go-heroku/
 1634  vi README.md 
 1635  gedit README.md &
 1636  cd ../shakespeare-
 1637  cd ../shakespeare-ec/
 1638  vi Makefile
 1639  man heroku create
 1640  man heroku
 1641  cat config.make 
 1642  fg
 1643  gedit Makefile &
 1644  ls
 1645  ls heroku-auth-token.txt >> .gitignore
 1646  cat heroku-auth-token.txt 
 1647  gedit ../hello-world-go-heroku/README.md 
 1648  history 
 1649  history  |grep docker
 1650  make heroku-via-docker
 1651  cat heroku-auth-token.txt 
 1652  cp heroku-auth-token.txt heroku-auth-token.txt.bak
 1653  make heroku-via-docker
 1654  unauthorized: authentication required
 1655  cd ecq/docker-ecq2020/
 1656  ls
 1657  cd shakespeare-ec/
 1658  cat n 
 1659  cat heroku-
 1660  cat heroku-auth-token.txt
 1661  rm n
 1662  cat Makefile
 1663  ls 
 1664  make heroku
 1665  cat Makefile
 1666  heroku container:push web --app shakespeare-ec
 1667  cat Makefile
 1668  heroku container:push web --app shakespeare-ec
 1669  crontab -e
 1670  crontab -l
 1671  exit 
 1672  cd ecq/docker-ecq2020/
 1673  ls
 1674  cd shakespeare-ec/
 1675  gedit README.md 
 1676  bg
 1677  ls 
 1678  tail Makefile
 1679  tail Makefile -n 20
 1680  tail Makefile -n 25
 1681  tail Makefile -n 25>>Makefile.md
 1682  tail Makefile -n 25 >>Makefile.md
 1683  gedit Makefile.md  &
 1684  cd ..
 1685  git add .
 1686  git status
 1687  git commit -m "testing heroku deployment"
 1688  push
 1689  exit
 1690  cd ecq/docker-ecq2020/
 1691  cd shakespeare-ec/
 1692  heroku container:push web --app shakespeare-ec
 1693  gedit README.md 
 1694  bg
 1695  cd ../hello-world-go-heroku/
 1696  gedit README.md 
 1697  bg
 1698  cd ..
 1699  git add .
 1700  git status
 1701  gedit hello-world-go-heroku/README.md &
 1702  gedit README.md 
 1703  grep install `find ./ -name "*.md"`
 1704  cd shakespeare-ec/
 1705  ls
 1706  help while
 1707  while [[ 1 -eq 1 ]]; do done
 1708  while [[ 1 -eq 1 ]]; ls >/dev/null;do done
 1709  while [[ 1 -eq 1 ]]; do ls >/dev/null; done
 1710  kill %4
 1711  jobs
 1712  ls
 1713  jobs
 1714  while [[ 1 -eq 1 ]]; do heroku container:push --app shakespeare-ec; done
 1715  history
 1716  while [[ 1 -eq 1 ]]; do heroku container:push --app shakespeare-ec ; done
 1717  vi loop.sh
 1718  bash loop.sh 
 1719  cat /etc/*release
 1720  yum remove docker                   docker-client                   docker-client-latest                   docker-common                   docker-latest                   docker-latest-logrotate                   docker-logrotate                   docker-engine
 1721  dnf remove docker                   docker-client                   docker-client-latest                   docker-common                   docker-latest                   docker-latest-logrotate                   docker-logrotate                   docker-engine
 1722  cd ..
 1723  git add .
 1724  git status
 1725  push
 1726  grep alias ~.bashrc
 1727  grep alias ~/.bashrc
 1728  cat ~/.bash_aliases 
 1729  push
 1730  cd shakespeare-ec/
 1731  sl
 1732  ls 
 1733  scp app.tgz tricia@korra.dawsoncollege.qc.ca:~/
 1734  ssh-copy-id tricia@korra.dawsoncollege.qc.ca
 1735  history 
 1736  history |grep create
 1737  docker images
 1738  cd ..
 1739  pull
 1740  ls 
 1741  cd shakespeare-ec/
 1742  ls
 1743  vi RUNONHEROKU.md 
 1744  cp RUNONHEROKU.md RUNONHEROKU.md.bak
 1745  vi RUNONHEROKU.md 
 1746  gedit RUNONHEROKU.md  &
 1747  gedit ../README.md 
 1748  gedit README.md 
 1749  cd ..
 1750  git add .
 1751  git status
 1752  git commit -m "update readmes"
 1753  push 
 1754  gedit shakespeare-ec/RUNONHEROKU.md
 1755  bg
 1756  git add .
 1757  git commit -m "readme"
 1758  push 
 1759  gedit shakespeare-ec/RUNONHEROKU.md &
 1760  git status 
 1761  pull
 1762  git add .
 1763  git commit -m "readme";push
 1764  git add .
 1765  git commit -m "readme";push
 1766  exit
 1767  cd ecq/docker-ecq2020/
 1768  cd stickynotes-jb/
 1769  ls
 1770  ls 
 1771  ls
 1772  gedit docker-compose.yaml mysql/Dockerfile php/Dockerfile 
 1773  bg
 1774  grep localhost `find  ../../proj2php/jeffstickyphp/`
 1775  gedit ../../proj2php/jeffstickyphp/database-utils/config.ini
 1776  mkdir mysqldb
 1777  cd mysql
 1778  ls
 1779  cd ..
 1780  mysql-dir-not-needed-delete
 1781  mv mysql mysql-dir-not-needed-delete
 1782  ls 
 1783  cp mysql-dir-not-needed-delete/dbsetup.sql .
 1784  cat dbsetup.sql 
 1785  ls 
 1786  docker-compose build 
 1787  cd ../../proj2php/jeffstickyphp/
 1788  cat database-utils/config.ini
 1789  grep server_name `find ./`
 1790  docker ps
 1791  docker-compose up 
 1792  cd -
 1793  docker-compose up 
 1794  docker ps
 1795  docker network 
 1796  docker images
 1797  docker system prune
 1798  docker-compose up 
 1799  sudo systemctl status mysql
 1800  sudo systemctl stop mysql
 1801  sudo systemctl status mysql
 1802  sudo systemctl stop mysql
 1803  sudo systemctl status mysql
 1804  docker-compose up 
 1805  netstat -plan |grep 2206
 1806  netstat -plan |grep 3306
 1807  ss |grep 3306
 1808  ss -li
 1809  ss -li |grep 3306
 1810  systemctl status mysqli
 1811  systemctl status mysql
 1812  netstat -plan |grep 33
 1813  netstat -pln |grep 33
 1814  systemctl status mysql
 1815  docker-compose up 
 1816  ls 
 1817  ls cat  dbsetup.sql 
 1818  cat dbsetup.sql 
 1819  gedit dbsetup.sql 
 1820  ls 
 1821  ls mysqldb/
 1822  mv dbsetup.sql mysql
 1823  mv mysqldb dbsetup 
 1824  cat Makefile 
 1825  mv Makefile.not.used
 1826  mv Makefile Makefile.not.used
 1827  ls 
 1828  docker-compose up
 1829  ls 
 1830  ls dbsetup
 1831  mv dbsetup.sql dbsetup
 1832  docker-compose up -d 
 1833  docker-compose logs
 1834  docker-compose logs -f
 1835  gedit dbsetup/dbsetup.sql 
 1836  docker-compose down 
 1837  docker-compose logs -f
 1838  docker-compose up -d 
 1839  docker-compose logs -f
 1840  docker-compose down 
 1841  docker-compose up -d 
 1842  docker-compose logs -f
 1843  docker ps
 1844  docker exec -ti stickynotes-jb_php_1 bash
 1845  ls 
 1846  gedit dbsetup/dbsetup.sql 
 1847  docker-compose down 
 1848  cd ../../proj2php/jeffstickyphp/
 1849  cd database-utils/
 1850  vi config.ini
 1851  cat config.ini
 1852  cd ..
 1853  ls
 1854  vi controller/Authentication.php 
 1855  cat index.html 
 1856  grep register-btn `find ./`
 1857  vi script.js 
 1858  ls
 1859  grep server_ `find ./ ` 2>/dev/null
 1860  head controller/Authentication.php 
 1861  head controller/UserStickyNotesDAO.php 
 1862  head controller/UserStickyNotesDAOInterface.php.php 
 1863  head controller/UserStickyNotesDAOInterface.php
 1864  cat model/User.php 
 1865  head model/User.php 
 1866  ls 
 1867  cat LoginConstants.php 
 1868  ls 
 1869  vi LoginConstants.php 
 1870  ls -l
 1871  cat login.md 
 1872  ls 
 1873  grep proj2 `find ./ `
 1874  vi controller/Authentication.php 
 1875  grep proj2 `find ./ `
 1876  vi controller/UserStickyNotesDAO.php 
 1877  cat login.md 
 1878  cd ../../docker-ecq2020/stickynotes-jb/
 1879  ls
 1880  cat dbsetup/dbsetup.sql 
 1881  cat  ../../proj2php/jeffstickyphp/database-utils/tables.php 
 1882  cd ../../proj2php/jeffstickyphp/
 1883  ls 
 1884  cat README.md 
 1885  cat login.md 
 1886  curl --data "method=register&username=test2&password=abcdefgh" "http://localhost:8700/login.php" 
 1887  grep "could not" `find ./` 
 1888  curl --data "method=register&username=test2&password=abcdefgh" "http://localhost:8700/login.php"  
 1889  grep "driver " `find ./` 
 1890  grep "driver" `find ./`  2>/dev/null
 1891  curl --data "method=register&username=test2&password=abcdefgh" "http://192.168.0.117:8700/login.php"  
 1892  cat login.md 
 1893  curl --data "method=register&username=demo1&password=test123" "http://192.168.0.117:8700/login.php"  
 1894  curl --data "method=register&username=demo1&password=test1234" "http://192.168.0.117:8700/login.php"  
 1895  vi login.
 1896  vi login.php 
 1897  grep drive `find ./`  2>/dev/null
 1898  grep could `find ./`  2>/dev/null
 1899  curl --data "method=register&username=demo1&password=test34" "http://192.168.0.117:8700/login.php"  
 1900  find ./ -name config.ini 
 1901  cat `find ./ -name config.ini `
 1902  cat login.md 
 1903  curl --data "method=register&username=demo1&password=test34" "http://192.168.0.117:8700/login.php"  
 1904  curl --data "method=register&username=demo1&password=test345" "http://192.168.0.117:8700/login.php"  
 1905  curl --data "method=register&username=demo1&password=test3458" "http://192.168.0.117:8700/login.php"  
 1906  ls 
 1907  cd ..
 1908  diff jeffstickyphp/  /var/www/html/stickynotes 
 1909  cd jeffstickyphp/
 1910  cat login.md 
 1911  curl --data "method=register&username=demo1&password=test3458" "http://192.168.0.117:8700/login.php"  
 1912  exit
 1913  docker ps
 1914  docker exec -it stickynotes-jb_db_1 bash
 1915  docker ps
 1916  docker stop stickynotes-jb_db_1 
 1917  docker-compose up db -d 
 1918  cd ecq/docker-ecq2020/stickynotes-jb/
 1919  docker-compose up db -d 
 1920  docker-compose -d up db
 1921  docker-compose up db
 1922  docker-compose up -d 
 1923  docker exec -it stickynotes-jb_php_1 bash
 1924  docker-compose down 
 1925  docker-compose rm
 1926  docker-compose system prune
 1927  docker-compose images
 1928  docker-compose port
 1929  docker-compose up -d 
 1930  docker-compose  network 
 1931  docker-compose version 
 1932  docker-compose logs -f 
 1933  docker-compose logs -t
 1934  docker exec -it stickynotes-jb_php_1 bash
 1935  ls 
 1936  vi php/Dockerfile 
 1937  cat ../shakespeare-ec/Dockerfile
 1938  ls
 1939  grep mysqli *
 1940  grep mysqli */*
 1941  gedit php/Dockerfile 
 1942  docker-compose down
 1943  docker-compose up -d 
 1944  docker-compose logs -t
 1945  docker exec -it stickynotes-jb_php_1 bash
 1946  docker images
 1947  docker rmi stickynotes-jb_php:latest 
 1948  docker-compose stop
 1949  docker rmi stickynotes-jb_php:latest 
 1950  docker rm 530f4f3a98e9
 1951  docker ps
 1952  docker rmi stickynotes-jb_php:latest 
 1953  docker images
 1954  docker-compose up -d 
 1955  vi php/Dockerfile 
 1956  docker-compose up -d 
 1957  docker-compose logs -t 
 1958  docker-compose logs -f
 1959  docker-compose stop 
 1960  docker volume
 1961  docker volume ls
 1962  docker volume prune
 1963  docker volume ls
 1964  docker volume rm stickynotes-jb_persistent 
 1965  docker stop 
 1966  docker-compose
 1967  docker volume rm stickynotes-jb_persistent 
 1968  docker volume
 1969  docker inspect stickynotes-jb_persistent 
 1970  docker images
 1971  docker rmi stickynotes-jb_php
 1972  docker rmi stickynotes-jb_php -f
 1973  docker rmi stickynotes-jb_php
 1974  docker rm 302c2d3ba21e
 1975  docker ps 
 1976  docker ps -a
 1977  docker-compose up
 1978  exit
 1979  cd ecq/proj2php/jeffstickyphp/
 1980  gedit login.php 
 1981  bg
 1982  cd ../../
 1983  cd docker-ecq2020/stickynotes-jb/
 1984  gedit php/Dockerfile &
 1985  dpkg --list
 1986  dpkg --list |grep php
 1987  cd ../../proj2php/
 1988  cd jeffstickyphp/
 1989  cat login.md 
 1990  curl --data "method=register&username=demo1&password=test3458" "http://192.168.0.117:8700/login.php"  
 1991  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 1992  cd -
 1993  ls 
 1994  cd ../docker-ecq2020/stickynotes-jb/
 1995  ls 
 1996  gedit docker-compose.yaml &
 1997  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 1998  exit
 1999  docker ps
 2000  docker ps -a
 2001  cd ecq/docker-ecq2020/stickynotes-jb/
 2002  docker-compose up -d 
 2003  sudo iptables -nL
 2004  cd ../../proj2php/jeffstickyphp/
 2005  cd database-utils/
 2006  vi config.ini
 2007  fg
 2008  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2009  cd -
 2010  docker-compose stop 
 2011  cd ../../docker-ecq2020/stickynotes-jb/
 2012  docker-compose stop 
 2013  docker ps 
 2014  docker ps  -a
 2015  sudo iptables -nL
 2016  sudo iptables -nL -nat 
 2017  sudo iptables -nL nat 
 2018  man iptables 
 2019  sudo iptables -nL -t nat 
 2020  docker-compose up -d 
 2021  ping stickynotes-jb_php_1
 2022  docker exec -it stickynotes-jb_php_1 bash
 2023  docker exec -it stickynotes-jb_db_1 bash
 2024  docker ps
 2025  docker ps -a
 2026  docker-compose  logs
 2027  docker-compose  logs db_1
 2028  docker-compose  logs stickynote_db_1
 2029  docker-compose  logs 
 2030  docker-compose  logs |grep db_1
 2031  docker-compose  logs |grep db_1 >db.logs.txt
 2032  gedit db.logs.txt &
 2033  cat docker-compose.yaml 
 2034  gedit docker-compose.yaml &
 2035  docker-compose stop 
 2036  docker-compose up -d 
 2037  docker ps
 2038  docker logs 
 2039  docker-compose logs
 2040  docker-compose  logs |grep db_1 >db.logs.txt
 2041  gedit db.logs.txt 
 2042  docker-compose build db
 2043  docker-compose db up
 2044  docker-compose up db
 2045  docker-compose up db 
 2046  docker-compose up db  -d
 2047  docker-compose -d up db
 2048  docker-compose stop 
 2049  docker-compose up -d 
 2050  docker ps
 2051  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2052  sudo iptables -nL -t nat 
 2053  vi ../../proj2php/jeffstickyphp/database-utils/config.ini
 2054  fg
 2055  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2056  vi ../../proj2php/jeffstickyphp/database-utils/config.ini
 2057  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2058  docker exec -it stickynotes-jb_db_1 bash
 2059  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2060  cd dbsetup/
 2061  ls 
 2062  gedit dbsetup.sql 
 2063  docker-compose stop 
 2064  docker ps -a
 2065  docker rm stickynotes-jb_phpmyadmin_1
 2066  docker rm stickynotes-jb_php_1
 2067  docker rm stickynotes-jb_db_1
 2068  docker volume
 2069  docker volume 
 2070  docker volume  ls 
 2071  docker volume rm stickynotes-jb_persistent 
 2072  docker-compose up -d 
 2073  docker ps 
 2074  docker ps  -a
 2075  docker-compose logs 
 2076  docker-compose logs  -f
 2077  docker exec -it stickynotes-jb_db_1 bash
 2078  docker-compose db up
 2079  docker-compose up db
 2080  docker ps -a
 2081  docker rm stickynotes-jb_db_1 
 2082  docker-compose up db
 2083  docker-compose rm
 2084  docker-compose stop
 2085  docker-compose rm
 2086  docker volumes ls
 2087  docker volume ls
 2088  docker volume rm stickynotes-jb_persistent 
 2089  mv dbsetup.sql dbsetup.sql.bak
 2090  docker-compose up -d 
 2091  docker exec -it stickynotes-jb_db_1 bash
 2092  docker ps
 2093  docker exec -it stickynotes-jb_db_1 bash
 2094  curl --data "method=register&username=demo1&password=test3458" "http://localhost:8700/login.php"  
 2095  ls 
 2096  mv dbsetup.sql.bak dbsetup.sql
 2097  cat dbsetup.sql 
 2098  vi dbsetup.sql 
 2099  ls 
 2100  cd ..
 2101  ls 
 2102  rm db.logs.txt 
 2103  gedit README.md 
 2104  docker-compose 
 2105  docker-compose push 
 2106  ls 
 2107  docker-compose ps 
 2108  gedit ../README.md 
 2109  history
 2110  history |grep docker-
 2111  history > command-history-for-md-files.md
