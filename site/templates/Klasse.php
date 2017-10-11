<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy
$klassenbild = $page->images->first;
$content = '<div class="row"><div class="six columns">'
			.'<h2 class="classteacher">'
            .'<a href="'.$page->classteacher->url.'" title="'.$page->classteacher->title.'">'.$page->classteacher->title.'</a>'
            .'</h2>'
            .'</div><div class="six columns text-right">';
if ($klassenbild) {
    $content .= ' <img class="klassenbild" style="width:200px;margin-top:-80px;" src="'. $klassenbild->pia("square=480, cropping=true, quality=80, sharpening=medium")->url .'" />';
}
            $content .= '</div></div>';

if (!$user->isLoggedIn() || (!$user->hasRole($page->neededUserRole) && !$user->hasRole('superuser')) ) {
    $content .= "<p class='text-center'>Klassenspezifische Inhalte sind nur für angemeldete Besucher dieser Klasse zu sehen.</p>"
    .'<p class="text-center"><a href="'.$pages->find('name=login,template=Login')[0]->url.'?r='.$page->id.'" class="button button-primary">Zum Login</a></p>';
    $content = renderMainPanel($title, $content);
} else {
	$content = renderMainPanel($title, $content);
    $news = $page->children("template=Artikel");
    if (count($news) > 0) {
	    $content.='<div class="panel">';
	    $content .= renderNews($news);
		$content .= '</div>';
    }
	
	$galleries = $page->children("template=Galerie");
	if (count($galleries)>0) {
		$content.='<div class="panel"><h1>Bilder-Galerien</h1>';
		 $content = renderImageGalleryPreview($galleries, $content, false);
		 $content .= '</div>';
	}
}

$content = renderBackButton($content);

// Sidebar Content
$sidebar = renderDefaultSideBar($page);

?>
