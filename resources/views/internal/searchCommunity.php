<?php


if (isset($_GET['searchField'])) {
    $query = \App\Http\Controllers\CommunityController::searchCommunity($_GET['searchField']);
}

// JSON encode
echo json_encode($query);