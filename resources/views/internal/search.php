<?php

use App\Http\Controllers\EventController;

$query;

if (isset($_GET['searchField'])) {

    $query = EventController::searchEventByNameAndDesc($_GET['searchField']);
	//$query = \App\Http\Controllers\MemberController::searchMemberByName($_GET['searchField']);
}

// JSON encode
echo json_encode($query);
?>