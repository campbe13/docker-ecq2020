#!/usr/bin/python
# pmc sample flask app
from flask import Flask
app = Flask(__name__)
@app.route("/")
def hello():

   return "<body><h2>Hello World!</h2> <h3> Running Flask from Docker</h3></body>"

if __name__ == "__main__":
#    default binds to localhost
#    app.run(debug=True)
    app.run(host="0.0.0.0",debug=True)
