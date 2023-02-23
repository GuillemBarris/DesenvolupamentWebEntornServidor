const DB = require("./db.json");


const getAllProductes = (filterParams) => {
    try{
        let producte = DB.Producte;
        if(filterParams?.ID){
            return DB.Producte.filter((producte) =>
            producte.id.toLowerCase().includes(filterParams.ID)
            );
            
        };
        return producte;
    } catch (error){
        throw { status: 500, message: error};
    }
    
};
const getProducteById = (ID) => {
    try{
        const producte = DB.Producte.find((producte) => producte.ID === ID);
        if (!producte){
            throw {
                status: 400,
                message: `Can't find producte with id '${ID}'`,
            }
        }
        return producte;
    } catch (error){
        throw { status: error?.status || 500, message: error?.message || error};
    }
};
const createNewProducte = (newProducte) => {
    try{
        const isAlreadyAdded =
            DB.Producte.filter((producte) => producte.Nom === newProducte.Nom) > -1;
        if (isAlreadyAdded) {
            throw{
                status: 400,
                message: `Producte with name '${newProducte.Nom}' already exists`,
            };
        }
        DB.workouts.push(newProducte);
        saveToDatabase(DB);
        return newProducte;
    } catch (error) {
        throw { status: error?.status || 500, message: error?.message ||error}
    }

};

const updateProducte = (ID, changes) => {
    try {

        const indexForUpdate = DB.producte.findIndex(
          (producte) => producte.ID === ID
        );
    
        if (indexForUpdate === -1) {
          throw {
            status: 400,
            message: `No es pot trobar el producte amb la id '${ID}'`,
          };
        }
    
        const updatedProducte = {
          ...DB.producte[indexForUpdate],
          ...changes,
          
        };
    
        DB.producte[indexForUpdate] = updatedProducte;
        saveToDatabase(DB);
    
        return updatedProducte;
      } catch (error) {
        throw { status: error?.status || 500, message: error?.message || error };
      }
    };




module.exports = {
    getAllProductes,
    getProducteById,
    createNewProducte,
    updateProducte,
};