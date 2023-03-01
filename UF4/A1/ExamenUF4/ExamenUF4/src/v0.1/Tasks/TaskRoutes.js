const express = require("express");
const TaskController = require("../../controllers/TaskController.js");

const router = express.Router();

router.post("/", TaskController.createNewTask);
router.get("/:id", TaskController.getTaskById);
module.exports = router;