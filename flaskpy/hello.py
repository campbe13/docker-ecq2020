#!/usr/bin/python
# pmc sample flask app
from flask import Flask
app = Flask(__name__)

@app.route("/")
def hello():
   print ("FLASK contacted")
   return "HTTP 1.1 200 \n\n<body><h2>Hello World!</h2> <h3> Running Flask from Docker</h3></body>"

if __name__ == "__main__":
    app.run(debug=True)
