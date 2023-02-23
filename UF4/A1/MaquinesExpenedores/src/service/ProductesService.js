const {v4: uuidv4} = require("uuid");
const Productes = require("../database/Productes");

const getAllProductes = (filterParms) => {
    try {
        const allProductes = Productes.getAllProductes(filterParms);
        return allProductes;
    } catch (error) {
        throw error;
    };
}

const getProducteById = (ID) => {
    try {
        const producte = Productes.getProducteById(ID);
        return producte;
    } catch (error){
        throw error;
    }
}
const createProducte = (newProducte) => {
    const ProductetoInsert ={
        ...newProducte,
        ID: uuid(),
    

    };
    try {
        const createdProducte = Productes.createNewProducte(ProductetoInsert);
        return createdProducte;
    }catch(error){
        throw error;
    }
}
const updateProducte = (ID, changes) => {
    try {
        const updatedProducte = Productes.updateProducte(ID, changes);
        return updatedProducte;
    } catch (error) {
        throw error;
    }
}

module.exports = {
    getAllProductes,
    getProducteById,
    createProducte,
    updateProducte,
}