<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy
$content = renderMainPanel($title, $content);

$content .= '<div class="panel"><h1>Aktuelles vom Förderverein</h1>'.renderNews($page->children("template=Artikel,sort=-date,limit=".$articleCount)).'</div>';

$content = renderBackButton($content);

$articleCount = 3;


$archive = $page->children("template=Artikel,sort=-date,limit=150");
$count = 0;
$sidebar = '<div class="panel main-panel appointment-preview"><h1>Artikel</h1>';
foreach($archive as $article) {
	//if ($count >= $articleCount) {
		$sidebar.='<div style="margin-bottom:20px;">';
		
		$sidebar .='<h6 style="margin-bottom:0;padding:0;text-decoration:underline">';
		$sidebar .= '<a href="'.$article->url.'" title="'.$article->title.'">'.$article->date.'</a>';
		$sidebar .= '</h6>'.$article->title.'</div>';
	//}
	$count ++;
}
$sidebar .= "</div>";//renderDefaultSideBar($page);

?>
