# Quickstart install docker.io
Requirement Ubuntu v 20.04 


1. Use the apt to install the docker.io package:
  `$ sudo apt install docker.io`
2. Start docker and enable it to start after the system reboot:
  `$ sudo systemctl enable --now docker`
3. Give your user privileges to run docker:  (remember least privilege)
   `$ sudo usermod -aG docker SOMEUSERNAME`
  * __Important:__ You will need to log out and log in to apply the changes.
4. Check docker version:
   `$ docker --version`
6. Run an image to test docker:  `$ docker run hello-world`
   
 If any step does not work go back and figure out why
