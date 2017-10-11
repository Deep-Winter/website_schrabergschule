<?php
    parse_str($_SERVER['QUERY_STRING']);

    $start_date = strtotime($start. " 00:00:00");
    $end_date = strtotime($end. " 00:00:00");
   
    $events = $pages->find("template=Termin,datefrom>=$start_date,sort=datefrom,datefrom<$end_date");
    
   
$arr = array(
);

foreach($events as $event) {
    $eventstart = date('Y-m-d',$event->getUnformatted("datefrom"))."T00:00:00";
    $eventend = date('Y-m-d',$event->getUnformatted("datefrom"))."T23:59:59";
    if ($event->dateto) {
        $eventend = date('Y-m-d', strtotime(date('Y-m-d', $event->getUnformatted("dateto")). " + 1 days")).'T00:00:00';
    }
    $eventArr = array(
        "start" => $eventstart,
        "end" => $eventend,
        "title" => $event->title,
        "allDay" => true,
    );
    if ($event->ferien) {
        $eventArr["color"]="#f09325";
        $eventArr["rendering"]="background";
    } else {
        $eventArr["url"] = $event->url;
    }
    array_push($arr, $eventArr);
}

echo json_encode($arr);
?>
    