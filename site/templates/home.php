<?php 

$content = renderMainPanel($title, $content);

$content .= '<div class="panel"><h1>Aktuelles</h1>'.renderNews($page->children("template=Aktuelles")[0]->children("sort=-date,limit=3")).'</div>';

// Sidebar Content
$sidebar = '<div class="panel main-panel appointment-preview"><h1>Termine</h1>';

$termine = $pages->find("template=Termin,datefrom>today,sort=datefrom,limit=10");

foreach($termine as $termin) {
	$sidebar.='<div style="margin-bottom:20px;"><h6 style="margin-bottom:0;padding:0;text-decoration:underline">';
	
	if ($termin->body != '') {
		$sidebar.= '<a href="'.$termin->url.'" title="'.$termin->title.'">';
	}
	$sidebar.= $termin->datefrom;
	
	if ($termin->body != '') {
		$sidebar.='</a>';
	}
	
	$sidebar.= '</h6>'.$termin->title;
	$sidebar.='</div>';
}
$sidebar .= '</div>';
$sidebar .= renderDefaultSideBar($page);

?>
