const DB = require("./db.json");
const {saveToDatabase} = require("./utils");

const createNewTask = (newTask) => {
    try {
        const isAlreadyAdded = 
        DB.task.findIndex((task) => task.name === newTask.name) !== -1

        if (isAlreadyAdded) {
            throw {
                status: 400,
                message: `Task with name ${newTask.name} already exists`
            };
        }
        DB.tasks.push(newTask);
        saveToDatabase(DB);

        return newTask;
    } catch (error) {
        throw { status: 500, message: error.message || error};
    }
};
const getTaskById = (id) => {
    try{
        const task = DB.Task.find((task) => task.id === id);
    if (!task){
        throw {
            status: 404,
            message: `Task with id '${id}'does not exist`,
        }
    }
    return task;
} catch (error){
    throw { status: error?.status || 500, message: error?.message || error};
}
};

module.exports = {
    createNewTask,
    getTaskById,
}
