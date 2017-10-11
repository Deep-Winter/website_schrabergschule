<?php
// basic-page.php template file 
// See README.txt for more information

$count = 0;
$content .= '<hr /><div class="row">';
foreach ($page->children() as $klasse) {
	$klassenbild = $klasse->images->first;
	$content .= '<div class="three columns">'
				. '<div class="klasse">';
	if ($klassenbild) {
		$content .= linkTo('<img class="klassenbild" style="background: white; width: 100%" src="'. $klassenbild->pia("square=300, cropping=true, quality=60, sharpening=medium")->url .'" ></img>', $klasse);
	}
	$content.= '<h4>'. linkTo($klasse->title, $klasse) .'</h4><div class="small-content">'. linkTo($klasse->shortdescription, $klasse) .'</div></div>'
				. '</div>';
	if ($count % 4 == 3) {
		$content .= '</div><hr /><div class="row">';
	}
	$count ++;
}
$content .= '</div>';
// Primary content is the page's body copy
$content = renderMainPanel($title, $content);
$content = renderBackButton($content);
	

?>