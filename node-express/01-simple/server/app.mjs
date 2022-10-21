/*
* REST api app  w express
* GET using path, no params
* using app.param() to change case
* test 
* http://localhost:3099/api
* http://localhost:3099/api/x
* http://localhost:3099/api/name/xyz
* http://localhost:3099/api/name/fozzie  (or Gonzo, Animal, Kermit)
* 
*/
import Muppets from './controllers/muppetclass.mjs'
import express from 'express';

function findName(req, res, data) {
  let resp
  console.log(req.name)
  console.log(req.params)
  if (req.name) {
    console.log(req.name)
    resp = data.muppets.filter(muppet => muppet.name === req.name)
    console.log(resp[0])
    if (resp.length === 0) {
      resp = {
        error: "name not found " + req.name
      }
    } else {
      // filter returns an array, we'll just send the obj
      resp = resp[0]
    }
  } else {
    resp = {
      error: "/api/name/x requied"
    }

  }
  res.json(resp);
}
(async function () {
  const app = express();
  const port = 3099

  // the bellow should be in a try / catch for error handling
  const reader = new Muppets() 
  const data = await reader.getMuppets()

  app.param('name', function(req, res, next, name) {
    console.log(name)
    const uplow = name.charAt(0).toUpperCase() + name.slice(1).toLowerCase();
    // must be attached to the req object for next function
    req.name = uplow 
    next();
  });
  // route /  all muppets 
  app.get('/', function (req, res) {
    let allMuppets = data.muppets;
    //console.log(allMuppets);
    res.json(allMuppets);
  });
  
  app.get('/muppet/:name', (req, res) => findName(req, res, data))
  
  // no matching route
  app.use((req, res) => res.status(404).json({ error: "api+get route not used"}))

  app.listen(port, 
    () => console.log(`express RESTful API start at port ${port}`))

})();

