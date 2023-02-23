const ProductesService = require("../service/ProductesService");

const getAllProductes = (req, res) => {
    const {ID} = req.query;
    try{
        const allProductes = ProductesService.getAllProductes({ID});
        res.send({status:"OK", data: allProductes});
    } catch (error){
        res
        .status(error?.status || 500)
        .send({status: "FAILED", data: {error: error?.message || error}});
    }
};
const getProducteById = (req, res) => {
    const {
        params: {ID},
    } = req;
    if(!ID){
        res
        .status(400)
        .send({
            status: "FAILED",
            data: {error: "Parameter ':ProducteID' can not be empty"},
        });
    }
    try{
        const producte = ProductesService.getProducteById(ID);
        res.send({status: "OK", data: producte});
    } catch (error){
        res
        .status(error?.status || 500)
        .send({ status: "FAILED", data: { error: error?.message || error }});
    }
};
const createProducte = (req, res) => {
    const { body } = req;

    if (
        !body.nom ||
        !body.tipus ||
        !body.preu ||
        !body.categoria

    ) {
        res.status(400).send({
            status: "FAILED",
            data: {
                error:
                "One of the following keys is missing or is empty in request body: 'Nom', 'Tipus', 'Preu', 'Categoria'",
        },
    });
    }
    const newProducte = {
        Nom: body.nom,
        Tipus: body.tipus,
        Preu: body.preu,
        Categoria: body.categoria
    };
    try{
        const createdProducte = ProductesService.createProducte(newProducte);
        res.status(201).send({status: "OK", data: createdProducte});
    } catch (error){
        res
        .status(error?.status || 500)
        .send({ status: "FAILED", data: { error: error?.message || error }});
    }
};
const updateProducte = (req, res) => {
    const {
        body,
        params: {ID},
    } = req;

    if (!ID) {
        res.status(400).send({
            data: {error: "Parameter ':ProducteID' can not be empty"},
        });
    }
    try {
        const updatedProducte = ProductesService.updateProducte(ID, body);
        res.send({status: "OK", data: updatedProducte});
    } catch (error){
        res
        .status(error?.status || 500)
        .send({ status: "FAILED", data: { error: error?.message || error }});
    }
};
module.exports = {  
    getAllProductes,
    getProducteById,
    createProducte,
    updateProducte,
}