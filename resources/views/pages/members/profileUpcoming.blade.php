<?php
 

$query = \App\Http\Controllers\MemberController::profileUpcoming($member->idmember);

if (empty($query))
    echo 'This member isn\'t participating in any events';

$today = time();
$eventsLink = route('events');

foreach ($query as $event){

    $eventDate = strtotime($event->startday);
    $datediff = $eventDate - $today ;
    $days = round($datediff / (60 * 60 * 24));
    $link = $eventsLink . '/' . $event->idevent;

    echo '
       <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">';
        echo '
                        <a href=" '.$link.'">';
        echo '
                <h5 class="mb-1">'. $event->name .' </h5>
                </a>
                <small>In '.$days.' day(s)</small>
            </div>
            <p class="mb-1">'.$event->description.'</p>
        <a href="">
            <small> Click here to see your ticket</small>
        </a>
     </div>
';
}


?>