

Note when you run this if the database exsist already it will not run what is in your
/docker-entrypoint-initdb.d/
so if you are recreateing you must delete the contents of the database volume (esp if mapped locally as this one is)
