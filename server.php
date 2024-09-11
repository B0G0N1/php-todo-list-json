<?php
header('Content-Type: application/json');

function getTodoList() {
    return json_decode(file_get_contents('./data/todolist.json'), true);
}

function saveTodoList($todolist) {
    file_put_contents('./data/todolist.json', json_encode($todolist));
}

$todolist = getTodoList();

// Aggiunta di una nuova task
if (isset($_POST['addTask'])) {
    $newTask = $_POST['addTask'];
    array_push($todolist, $newTask);
    saveTodoList($todolist);
}

echo json_encode($todolist);
?>