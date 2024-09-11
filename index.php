<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Todo List JSON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-task {
            width: 90px; /* Imposta la larghezza fissa per i pulsanti delle task */
        }
    </style>
</head>
<body>
    <div id="app" class="container my-5">
        <h1 class="text-center mb-4">ToDo List</h1>
        
        <!-- Sezione di errore -->
        <div v-if="errorMessage" class="alert alert-danger">{{ errorMessage }}</div>

        <!-- Lista delle task -->
        <ul class="list-group mb-3">
            <!-- Ciclo for per visualizzare le task -->
            <li v-for="todo in todolist" :key="todo.id" class="list-group-item d-flex justify-content-between align-items-center">
                <span :class="{ 'text-decoration-line-through': todo.done, 'text-muted': todo.done }">{{ todo.name }}</span>
                <div>
                    <!-- Bottone per il toggle dello stato (completata/non completata) -->
                    <button @click="toggleTask(todo.id)" class="btn btn-sm btn-outline-primary me-2 btn-task">{{ todo.done ? 'Undo' : 'Complete' }}</button>
                    <!-- Bottone per eliminare una task -->
                    <button @click="deleteTask(todo.id)" class="btn btn-sm btn-outline-danger btn-task">Delete</button>
                </div>
            </li>
        </ul>

        <!-- Input per aggiungere una nuova task -->
        <div class="input-group">
            <input type="text" v-model="newTask" class="form-control" placeholder="Add a new task">
            <!-- Bottone per aggiungere una task -->
            <button @click="addTask" class="btn btn-success" :disabled="newTask.trim() === ''">Add Task</button>
        </div>
    </div>

    <!-- Collegamento a Vue 3 e Axios -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>