const express = require('express');
const bodyParser = require('body-parser');
const v01RouterUser= require("./v0.1/Users/UsersRoutes.js");
const v01RouterTask = require("./v0.1/Tasks/TaskRoutes.js");

const app = express();

const PORT = process.env.PORT || 3000;
app.use(bodyParser.json());
app.use("/api/v0.1/users", v01RouterUser);
app.use("/api/v0.1/tasks", v01RouterTask);

app.listen(PORT, () => {

    console.log(`API is listening on port ${PORT}`);
    
  });