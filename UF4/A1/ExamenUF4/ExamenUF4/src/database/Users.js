const DB = require("./db.json");
const {saveToDatabase} = require("./utils");

const createNewUser = (newUser) => {
    try {
        const isAlreadyAdded = 
        DB.users.findIndex((user) => user.username === newUser.username) !== -1

        if (isAlreadyAdded) {
            throw {
                status: 400,
                message: `User with username ${newUser.username} already exists`
            };
        }
        DB.users.push(newUser);
        saveToDatabase(DB);

        return newUser;
    } catch (error) {
        throw { status: 500, message: error.message || error};
    }
};
const getAllUsers = (filterParams) => {
    try{
        let user = DB.User;
        if (filterParams?.id){
           return DB.User.filter((user) => 
           user.id.toLowerCase().includes(filterParams.id)
           );
        };
        return user;
    } catch (error){
        throw { status: 500, message: error};
    }
    
};


module.exports = {
    createNewUser,
    getAllUsers,
}
