<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy

$portrait = $page->images->first;

if ($portrait) {
$content = '<h2>'.$page->role.'</h2><div>' . $content .  '</div><div>'
			.'<img style="width:100%" alt='.$page->title.' class="portrait" src="'. $portrait->pia("width=750, cropping=false, quality=80, sharpening=medium")->url .'" ></img>'
            .'</div>';
}

$content = renderMainPanel($title, $content);
$content = renderBackButton($content);

// Sidebar Content
$sidebar = renderDefaultSideBar($page);

?>
