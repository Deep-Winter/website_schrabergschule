<?php
// basic-page.php template file 
// See README.txt for more information

$count = 0;
$content .= '<hr /><div class="row">';
foreach ($page->children() as $person) {
	$portrait = $person->images->first;
	$content .= '<div class="four columns">'
				. '<div class="person">';
	if ($portrait) {
		$content .= linkTo('<img class="portrait" src="'. $portrait->pia("square=300, cropping=true, quality=80, sharpening=medium")->url .'" ></img>', $person);
	}
	$content.= '<h4>'. linkTo($person->title,$person) .'</h4><div class="small-content">'. linkTo($person->role, $person) .'</div></div>'
				. '</div>';
	if ($count % 3 == 2) {
		$content .= '</div><hr /><div class="row">';
	}
	$count ++;
}
$content .= '</div>';
// Primary content is the page's body copy
$content = renderMainPanel($title, $content);
$content = renderBackButton($content);


?>