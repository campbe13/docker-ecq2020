/*
* Controller to read muppet data 
* from a json file  (singleton)
* 
* returns instance of Muppets class
* 
*/
import * as reader from '../fileio/fileio.mjs';

let instance = null;

class Muppets {
  constructor(){
    if (!instance){
      instance = this;
    }
    return instance;
  }

  async getMuppets() {
    if (this.muppets){
      return this.muppets;
    }
    const fn = "./files/muppets.json";
    try {
      this.muppets = await reader.readJSON(fn);
      //console.log(this.muppets);
      return this.muppets;
    } catch (err) {
      console.error(err.message);
      throw err;
    }
  }
}

export default Muppets;