<?php
header('Content-Type: application/json');

function getTodoList() {
    return json_decode(file_get_contents('./data/todolist.json'), true);
}

$todolist = getTodoList();
echo json_encode($todolist);
?>