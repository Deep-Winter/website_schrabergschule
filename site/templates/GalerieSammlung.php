<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy

if ($user->isLoggedIn()) {
    $galleries = $pages->find("template=Galerie, sort=-date");
    $content = renderImageGalleryPreview($galleries, $content, true);

} else {
    $content .= '<p class="text-center">Sie nicht angemeldet</p>'
                .'<p class="text-center"><a href="'.$pages->find('name=login,template=Login')[0]->url.'?r='.$page->id.'" class="button button-primary">Zum Login</a></p>';
}

$content = renderMainPanel($title, $content);
$content = renderBackButton($content);

// Sidebar Content
$sidebar = renderDefaultSideBar($page);

?>