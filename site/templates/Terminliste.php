<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy

/*
foreach($page->children('sort=datefrom,(datefrom>=today),(dateto!="", dateto>=today)') as $appointment) {
    $date = ''. date('d.m.Y',$appointment->datefrom);
    if($appointment->dateto) {
        $date.=' - ' . date('d.m.Y',$appointment->dateto);
    }
    $appointments .= '<tr><td style="width: 200px">'
        .$date.'</td><td><a class="appointment" href="'
        .$appointment->url.'">'
        .$appointment->title.'</a></td></tr>';
}

$content = '<table class="table">'.$appointments.'</table><div id="calendar"></div>' . $content; */

$content = '<div id="calendar"></div>' .$content;
$content = renderMainPanel($title, $content);

// Sidebar Content
$sidebar = ''; //renderDefaultSideBar($page);

?>
