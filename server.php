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

// Verifica se viene inviata una nuova task tramite POST
if (isset($_POST['addTask'])) {
    // Decodifica il body JSON per ottenere l'oggetto
    $newTask = json_decode($_POST['addTask'], true);
    
    // Aggiungi la nuova task alla lista
    array_push($todolist, $newTask);
    
    // Salva la lista aggiornata nel file JSON
    saveTodoList($todolist);
}

// Restituisce la lista aggiornata
echo json_encode($todolist);
?>