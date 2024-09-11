<?php
header('Content-Type: application/json');

// Funzione per leggere la lista ToDo
function getTodoList() {
    return json_decode(file_get_contents('./data/todolist.json'), true);
}

// Funzione per salvare la lista ToDo
function saveTodoList($todolist) {
    file_put_contents('./data/todolist.json', json_encode($todolist));
}

$todolist = getTodoList();

// Aggiunta di una nuova task
if (isset($_POST['addTask'])) {
    $newTask = json_decode($_POST['addTask'], true);
    array_push($todolist, $newTask);
    saveTodoList($todolist);
}

// Eliminazione di una task
if (isset($_POST['deleteTask'])) {
    foreach ($todolist as $key => $task) {
        if ($task['id'] == $_POST['deleteTask']) {
            unset($todolist[$key]);
            break;
        }
    }
    $todolist = array_values($todolist);
    saveTodoList($todolist);
}

// Toggle dello stato di una task (completato/non completato)
if (isset($_POST['toggleTask'])) {
    foreach ($todolist as &$task) {
        if ($task['id'] == $_POST['toggleTask']) {
            $task['done'] = !$task['done'];
            break;
        }
    }
    saveTodoList($todolist);
}

// Restituisce la lista aggiornata
echo json_encode($todolist);
?>