import fs from 'fs/promises';

// check if it exists
// https://nodejs.org/api/fs.html#fspromisesaccesspath-mode 
async function checkAccess(path) {
  try {
    await fs.access(path);
  } catch (err) {
    console.log(err)
    throw "path does not exist"
  }
}
// check the stats (like an ls -la)
// https://nodejs.org/api/fs.html#fspromisesstatpath-options 
// returns
// https://nodejs.org/api/fs.html#class-fsstats

async function checkStats(path) {
  let stats
  try {
    stats = await fs.stat(path);
    if (!stats.isFile) {
      throw "not a regular file "
    }
  } catch (err) {
    console.log(err)
    throw "error in fs.stat"
  }
}
// read the file
// https://nodejs.org/api/fs.html#fspromisesreadfilepath-options
async function onlyRead(file) {
  try {
    let data = await fs.readFile(file, "utf-8");
    return data;
  } catch (err) {
    console.error(err.message);
    throw " read error"
  }
}

// 1 check access
// 2 check it's a file
// 3 read the file
async function read(path) {
  let data
  try {
    await checkAccess(path)
    console.log("path exists & we can access")
    await checkStats(path)
    console.log(" & is a regular file " + path)
    data = await onlyRead(path)
    return data
  } catch (err) {
    console.error("file does not exist or  we cannot access")
    throw "file does not exist or cannot access "
  }
}
// read JSON (return parsed JSON)
async function readJSON(path) {
  let parsed
  try {
    const data = await read(path);
    parsed = JSON.parse(data)
  } catch (err) {
    console.error('invalid JSON format/not JSON')
    throw 'invalid JSON'
  }
  return parsed
}

// only need to expose readJSON!!! rest here for gradual dev
export { checkAccess, checkStats, read, readJSON }