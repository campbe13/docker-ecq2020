# pull from docker so image is local
`docker run/pull tricia/shakespeare-ec`
# login to heroku (cached in config.json)
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ bash -x heroku-registry-login.sh
++ cat heroku-auth-token.txt
+ token=69cfe805-92c8-4b92-9eef-c19dce06cf04
+ docker login --username=_ --password=69cfe805-92c8-4b92-9eef-c19dce06cf04 registry.heroku.com
WARNING! Using --password via the CLI is insecure. Use --password-stdin.
WARNING! Your password will be stored unencrypted in /home/tricia/.docker/config.json.
Configure a credential helper to remove this warning. See
https://docs.docker.com/engine/reference/commandline/login/#credentials-store

Login Succeeded
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ cat /home/tricia/.docker/config.json
{
        "auths": {
                "https://index.docker.io/v1/": {
                        "auth": "dHJpY2lhOmVkdWNhdGUz"
                },
                "registry.heroku.com": {
                        "auth": "Xzo2OWNmZTgwNS05MmM4LTRiOTItOWVlZi1jMTlkY2UwNmNmMDQ="
                }
        },
        "HttpHeaders": {
                "User-Agent": "Docker-Client/19.03.5 (linux)"
        }
}
```
# tag and push
```
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker images
REPOSITORY              TAG                 IMAGE ID            CREATED             SIZE
tricia/shakespeare-jm   latest              561c7ca0d5b4        4 days ago          552MB
tricia/js-mf            latest              a0414309c595        5 days ago          17.5MB
tricia/shakespeare-ec   latest              8524faf9b7b8        5 days ago          602MB
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker tag tricia/shakespeare-ec registry.he                              roku.com/shakepeare-ec/web
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker images
REPOSITORY                              TAG                 IMAGE ID            CREATED             SIZ                              E
tricia/shakespeare-jm                   latest              561c7ca0d5b4        4 days ago          552                              MB
tricia/js-mf                            latest              a0414309c595        5 days ago          17.                              5MB
tricia/shakespeare-ec                   latest              8524faf9b7b8        5 days ago          602                              MB
registry.heroku.com/shakepeare-ec/web   latest              8524faf9b7b8        5 days ago          602                              MB
tricia@acerubuntu1804:~/ecq/docker-ecq2020/shakespeare-ec$ docker push registry.heroku.com/shakepeare-e                              c/web
The push refers to repository [registry.heroku.com/shakepeare-ec/web]
407a07d5677e: Preparing
06f0bf03abbd: Preparing
2791ffca167d: Preparing
aabd4f73716b: Preparing
da963c2c588e: Preparing
4b2d47d63ce6: Waiting
f4e793a59364: Waiting
c3771624535e: Waiting
3e016e2d5575: Waiting
15e64324ff74: Waiting
c0f42f48af8f: Waiting
0a86f8bd2920: Waiting
63bdd471b6c2: Waiting
68ec2faa35f5: Waiting
1d9b8efc8fda: Waiting
f6240605700a: Waiting
e501e93022bc: Waiting
00ad11a7d941: Waiting
488dfecc21b1: Waiting
unauthorized: authentication required
```
