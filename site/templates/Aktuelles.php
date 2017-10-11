<?php
// basic-page.php template file 
// See README.txt for more information
$articleCount=10;
// Primary content is the page's body copy
$content = renderNews($page->children("sort=-date,limit=".$articleCount));
$content = renderMainPanel($title, $content);
$content = renderBackButton($content);
// Sidebar Content

$archive = $page->children("sort=-date,limit=150");
$count = 0;
$sidebar = '<div class="panel main-panel appointment-preview"><h1>Archiv</h1>';
foreach($archive as $article) {
	if ($count >= $articleCount) {
		$sidebar.='<div style="margin-bottom:20px;">';
		
		$sidebar .='<h6 style="margin-bottom:0;padding:0;text-decoration:underline">';
		$sidebar .= '<a href="'.$article->url.'" title="'.$article->title.'">'.$article->date.'</a>';
		$sidebar .= '</h6>'.$article->title.'</div>';
	}
	$count ++;
}
$sidebar .= "</div>";//renderDefaultSideBar($page);

?>
