<?php
header('Content-Type: application/json');

// Funzione per leggere la lista ToDo dal file JSON
function getTodoList() {
    return json_decode(file_get_contents('./data/todolist.json'), true);
}

// Funzione per salvare la lista ToDo nel file JSON
function saveTodoList($todolist) {
    file_put_contents('./data/todolist.json', json_encode($todolist));
}

// Ottieni la lista delle task
$todolist = getTodoList();

// Funzione per generare un ID univoco
function getNextId($todolist) {
    $maxId = 0;
    foreach ($todolist as $task) {
        if ($task['id'] > $maxId) {
            $maxId = $task['id'];  // Trova l'ID più alto nella lista attuale
        }
    }
    return $maxId + 1;  // Incrementa l'ID più alto per ottenere il prossimo ID
}

// Aggiunta di una nuova task
if (isset($_POST['addTask'])) {
    $newTask = json_decode($_POST['addTask'], true);

    // Genera un ID unico per la nuova task
    $newTask['id'] = getNextId($todolist);

    // Aggiungi la nuova task alla lista
    array_push($todolist, $newTask);
    saveTodoList($todolist);
}

// Eliminazione di una task
if (isset($_POST['deleteTask'])) {
    foreach ($todolist as $key => $task) {
        if ($task['id'] == $_POST['deleteTask']) {
            unset($todolist[$key]);  // Rimuovi la task corrispondente
            break;
        }
    }
    $todolist = array_values($todolist);  // Riorganizza l'array per evitare buchi
    saveTodoList($todolist);
}

// Toggle dello stato di una task (completato/non completato)
if (isset($_POST['toggleTask'])) {
    foreach ($todolist as &$task) {
        if ($task['id'] == $_POST['toggleTask']) {
            $task['done'] = !$task['done'];  // Inverti lo stato della task
            break;
        }
    }
    saveTodoList($todolist);
}

// Restituisce la lista aggiornata delle task
echo json_encode($todolist);
?>