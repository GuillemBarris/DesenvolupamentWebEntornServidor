const TaskService = require('../services/TaskService');

const createNewTask = (req, res) => {
    const { body} = req;

    if (
        !body.user ||
        !body.title||
        !body.description ||
        !body.status ||
        !body.CreatedAt ||
        !body.UpdatedAt
    ) {
        res.status(400).send({
            status: "FAILED",
            data: {
                error:
                "One of the following keys is missing: user, title, description, status, CreatedAt, UpdatedAt"

            },
        });
        
    }
    const newTask = {
        user: body.user,
        title: body.title,
        description: body.description,
        status: body.status,
        CreatedAt: body.CreatedAt,
        UpdatedAt: body.UpdatedAt,
    };
    try {
        const createdTask = TaskService.createNewTask(newTask);
        res.status(201).send({ status: "OK", data: createdUser });
    } catch (error) {
        res
            .status(error?.status || 500)
            .send({ status: "FAILED", data: { error: error?.message } });
    }

};
const getTaskById = (req, res) => {
    const {
        params: {id},
    } = req;
    if(!id){
        res
        .status(400)
        .send({
            status: "FAILED",
            data: {error: "Parameter ':id' can not be empty"},
        });
    }
    try{
        const task = TaskService.getTaskById(id);
        res.send({status: "OK", data: task});
    } catch (error){
        res
        .status(error?.status || 500)
        .send({ status: "FAILED", data: { error: error?.message || error }});
    }
};

module.exports = {
    createNewTask,
    getTaskById,
};
