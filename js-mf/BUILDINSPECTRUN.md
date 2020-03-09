# Build the container image,  (alpine:latest on localhost)
1. build
2. inspect image
3. show images
4. run image
## `docker build -t tricia/js-mf` 
Using [Dockerfile](Dockerfile.md)
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$ make build
docker build -t tricia/js-mf .
Sending build context to Docker daemon    2.4MB
Step 1/8 : FROM alpine:latest
 ---> e7d92cdc71fe
Step 2/8 : LABEL maintainer="P Campbell" email="pcampbell.edu@gmail.com" modified="2020-02-21"
 ---> Using cache
 ---> 09a0bdb11f91
Step 3/8 : RUN apk add lighttpd;echo 'server.dir-listing = "enable"'>> /etc/lighttpd/lighttpd.conf
 ---> Using cache
 ---> bbf1375c443f
Step 4/8 : WORKDIR /var/www/localhost/htdocs/
 ---> Using cache
 ---> 74bb3de7ba0d
Step 5/8 : COPY app.tgz .
 ---> a7489373bccf
Step 6/8 : RUN tar -xzf app.tgz ; rm app.tgz ; mv app/* . ; rm -rf app .git
 ---> Running in feb1cde5ac85
Removing intermediate container feb1cde5ac85
 ---> 2b3ba0654ae7
Step 7/8 : EXPOSE 80
 ---> Running in cabd314f104c
Removing intermediate container cabd314f104c
 ---> ebd564bbd2e4
Step 8/8 : ENTRYPOINT ["/usr/sbin/lighttpd", "-D", "-f", "/etc/lighttpd/lighttpd.conf"]
 ---> Running in f84fbbc0c699
Removing intermediate container f84fbbc0c699
 ---> f082aaab02b0
Successfully built f082aaab02b0
Successfully tagged tricia/js-mf:latest
```
## `docker inspect tricia/js-mf`
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$ docker inspect tricia/js-mf
[
    {
        "Id": "sha256:f082aaab02b028e1ad9bb150171660deb78024141498b52d8099f98a8efd56d6",
        "RepoTags": [
            "tricia/js-mf:latest"
        ],
        "RepoDigests": [],
        "Parent": "sha256:ebd564bbd2e4bf1375c5adb8ad63685452118890812d9d63f2d052f4d157bffc",
        "Comment": "",
        "Created": "2020-03-09T21:47:48.879725368Z",
        "Container": "f84fbbc0c6992cbd9154b4f29b80196c2e74f812130cf0d0ad5cab441a6360c7",
        "ContainerConfig": {
            "Hostname": "f84fbbc0c699",
            "Domainname": "",
            "User": "",
            "AttachStdin": false,
            "AttachStdout": false,
            "AttachStderr": false,
            "ExposedPorts": {
                "80/tcp": {}
            },
            "Tty": false,
            "OpenStdin": false,
            "StdinOnce": false,
            "Env": [
                "PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
            ],
            "Cmd": [
                "/bin/sh",
                "-c",
                "#(nop) ",
                "ENTRYPOINT [\"/usr/sbin/lighttpd\" \"-D\" \"-f\" \"/etc/lighttpd/lighttpd.conf\"]"
            ],
            "Image": "sha256:ebd564bbd2e4bf1375c5adb8ad63685452118890812d9d63f2d052f4d157bffc",
            "Volumes": null,
            "WorkingDir": "/var/www/localhost/htdocs",
            "Entrypoint": [
                "/usr/sbin/lighttpd",
                "-D",
                "-f",
                "/etc/lighttpd/lighttpd.conf"
            ],
            "OnBuild": null,
            "Labels": {
                "email": "pcampbell.edu@gmail.com",
                "maintainer": "P Campbell",
                "modified": "2020-02-21"
            }
        },
        "DockerVersion": "19.03.5",
        "Author": "",
        "Config": {
            "Hostname": "",
            "Domainname": "",
            "User": "",
            "AttachStdin": false,
            "AttachStdout": false,
            "AttachStderr": false,
            "ExposedPorts": {
                "80/tcp": {}
            },
            "Tty": false,
            "OpenStdin": false,
            "StdinOnce": false,
            "Env": [
                "PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin"
            ],
            "Cmd": null,
            "Image": "sha256:ebd564bbd2e4bf1375c5adb8ad63685452118890812d9d63f2d052f4d157bffc",
            "Volumes": null,
            "WorkingDir": "/var/www/localhost/htdocs/",
            "Entrypoint": [
                "/usr/sbin/lighttpd",
                "-D",
                "-f",
                "/etc/lighttpd/lighttpd.conf"
            ],
            "OnBuild": null,
            "Labels": {
                "email": "pcampbell.edu@gmail.com",
                "maintainer": "P Campbell",
                "modified": "2020-02-21"
            }
        },
        "Architecture": "amd64",
        "Os": "linux",
        "Size": 17538788,
        "VirtualSize": 17538788,
        "GraphDriver": {
            "Data": {
                "LowerDir": "/var/lib/docker/overlay2/21e6702e838f030066c07c7a6366ada66193b460ca332a875c55c9fb706111e6/diff:/var/lib/docker/overlay2/953fddfa468c5fa62b50e5519f831c8adc08ed846a02f274bd2156a835bfa561/diff:/var/lib/docker/overlay2/23f69b9caaa0dcca47ccc3fc783f4c05b036b49b600f36646ea3bc93eeb57d5c/diff",
                "MergedDir": "/var/lib/docker/overlay2/bd01424b30776181a51e2817acd56978950309e3aac361c3407cc282f94a009a/merged",
                "UpperDir": "/var/lib/docker/overlay2/bd01424b30776181a51e2817acd56978950309e3aac361c3407cc282f94a009a/diff",
                "WorkDir": "/var/lib/docker/overlay2/bd01424b30776181a51e2817acd56978950309e3aac361c3407cc282f94a009a/work"
            },
            "Name": "overlay2"
        },
        "RootFS": {
            "Type": "layers",
            "Layers": [
                "sha256:5216338b40a7b96416b8b9858974bbe4acc3096ee60acbc4dfb1ee02aecceb10",
                "sha256:bc226e09d6113aeaeca22711d35f1c5bb2e43abc77240cf9fe17cec66351bcd9",
                "sha256:76b2b5e60b69f3b36307f5bfb6d81f42ea826e7d27be1ded279b908a196c4efc",
                "sha256:934294f19a3f7395fe461007deba0bd2884c7d04ea051082c6c6771b805ac3e9"
            ]
        },
        "Metadata": {
            "LastTagTime": "2020-03-09T17:47:49.655908658-04:00"
        }
    }
]
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$
```
## `docker images`
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$ docker images tricia/*
REPOSITORY              TAG                 IMAGE ID            CREATED             SIZE
tricia/js-mf            latest              f082aaab02b0        5 minutes ago       17.5MB
tricia/goheroku         latest              a4fbe8fe535a        11 days ago         13.1MB
tricia/shakespeare-ec   latest              8524faf9b7b8        2 weeks ago         602MB
tricia/shakespeare-jm   latest              becc74c4f566        2 weeks ago         479MB
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$
```
## `docker run`
```
docker run -d -p 8900:80 --name js-mf  tricia/js-mf
d5c96c1ff0440613f1cb767c03dedc56e6e468b250fb076ce6a67aa99f2936a6
docker ps
CONTAINER ID        IMAGE               COMMAND                  CREATED             STATUS                  PORTS                  NAMES
d5c96c1ff044        tricia/js-mf        "/usr/sbin/lighttpd …"   3 seconds ago       Up Less than a second   0.0.0.0:8900->80/tcp   js-mf
tricia@acerubuntu1804:~/ecq/docker-ecq2020/js-mf$
```

