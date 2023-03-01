const UsersService = require('../services/UsersService');

const createNewUser = (req, res) => {
    const { body} = req;

    if (
        !body.username ||
        !body.fullname ||
        !body.CreatedAt ||
        !body.UpdatedAt 
    ) {
        res.status(400).send({
            status: "FAILED",
            data: {
                error:
                "One of the following keys is missing: username, fullname, CreatedAt, UpdatedAt"

            },
        });
        
    }
    const newUser = {
        username: body.username,
        fullname: body.fullname,
        CreatedAt: body.CreatedAt,
        UpdatedAt: body.UpdatedAt,
    };
    try {
        const createdUser = UsersService.createNewUser(newUser);
        res.send({ status: "OK", data: createdUser });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message } });
    }

};
const getAllUsers = (req, res) => {
    const {id} = req.query;
    try{
        const AllUsers = UsersService.getAllUsers({id});
        res.send({status: "OK", data: AllUsers});
    } catch (error) {
        res
        .status(error?.status || 500)
        .send({ status: "FAILED", data: { error: error?.message } });
    }
};

module.exports = {
    createNewUser,
    getAllUsers
};
