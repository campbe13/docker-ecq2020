#!/usr/bin/python
# pmc sample flask app
from flask import Flask
import os
import sys 


def formatsysinfo(): 
  sysinfo = "platform " + sys.platform + " version " + sys.version
  name = "uname " + os.uname()[4]
  uid = "uid " + str(os.getuid()) + " gid " + str(os.getgid()) 
  cwd = "cwd " + os.getcwd() 
  return "<h4>System Info</h4>"+ sysinfo + "</br>" + name + "</br>" +uid + "</br>" + cwd 
 
app = Flask(__name__)
@app.route("/")
def hello():
   return "<body><h2>Hello World!</h2> <h3> Running Flask from Docker</h3>" + formatsysinfo() + "</body>"

if __name__ == "__main__":
    app.run(host="0.0.0.0",debug=True)

#    default binds to localhost
#    app.run(debug=True)
