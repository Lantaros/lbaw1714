<?php

$query;

if (isset($_GET['searchField'])) {

    $query = \App\Http\Controllers\EventController::searchEventByName($_GET['searchField']);
}

// JSON encode
echo json_encode($query);
?>