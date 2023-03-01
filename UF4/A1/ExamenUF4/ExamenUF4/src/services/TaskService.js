const Task = require('../database/tasks');
const {v4: uuid} = require('uuid');

const createNewTask = (newTask) => {
    const TaskToInsert = {
        ...newTask,
        id: uuid(),
        createdAt: new Date().toLocaleString("en-US",{timeZone: "UTC"}),
        updatedAt: new Date().toLocaleString("en-US",{timeZone: "UTC"}),
    };
    try {
        const createdTask = Task.createNewTask(TaskToInsert);
        return createdTask;
    }   catch (error) {
        throw error;
    }
};

const getTaskById = (id) => {
    try {
        const task = Task.getTaskById(id);
        return task;
    } catch (error){
        throw error;
    }
}
module.exports = {
    createNewTask,
    getTaskById,
}
