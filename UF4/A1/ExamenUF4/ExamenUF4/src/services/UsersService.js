const Users = require('../database/users');
const {v4: uuid} = require('uuid');

const createNewUser = (newUser) => {
    const userToInsert = {
        ...newUser,
        id: uuid(),
        createdAt: new Date().toLocaleString("en-US",{timeZone: "UTC"}),
        updatedAt: new Date().toLocaleString("en-US",{timeZone: "UTC"}),
    };
    try {
        const createdUser = Users.createNewUser(userToInsert);
        return createdUser;
    }   catch (error) {
        throw error;
    }
};
const getAllUsers = (filterParms) => {
    try {
        const allUsers = Users.getAllUsers(filterParms);
        return allUsers;
    } catch (error) {
        throw error;
    };
}
module.exports = {
    createNewUser,
    getAllUsers,
}
