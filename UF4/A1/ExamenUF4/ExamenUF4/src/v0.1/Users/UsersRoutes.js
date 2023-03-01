const express = require("express");
const UsersController = require("../../controllers/UsersController.js");

const router = express.Router();

router.post("/", UsersController.createNewUser);
router.get("/", UsersController.getAllUsers);

module.exports = router;