const express = require("express");
const ProductesController = require("../../controllers/ProductesController");

const router = express.Router();

router.get("/", ProductesController.getAllProductes);
router.get("/:ID", ProductesController.getProducteById);
router.post("/", ProductesController.createProducte);
router.patch("/:ID", ProductesController.updateProducte);
module.exports = router;