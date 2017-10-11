	<?php 

    $content .= '<div class="gamma-container gamma-loading" id="gamma-container">'
                .'<ul class="gamma-gallery">';
    foreach ($page->images as $image) {
        $content .= '<li>'
                    .'<div data-alt="'.$image->description.'" data-description="<h3>'.$image->description.'</h3>" data-max-width="1800" data-max-height="1350">'
					.'<div data-src="'.$image->httpUrl.'" data-min-width="1300"></div>'
					.'<div data-src="'.$image->pia("width=1300, quality=80, sharpening=medium")->url.'" data-min-width="1000"></div>'
					.'<div data-src="'.$image->pia("width=1000, quality=80, sharpening=medium")->url.'" data-min-width="700"></div>'
					.'<div data-src="'.$image->pia("width=700, quality=80, sharpening=medium")->url.'" data-min-width="300"></div>'
					.'<div data-src="'.$image->pia("width=300, quality=80, sharpening=medium")->url.'" data-min-width="200"></div>'
					.'<div data-src="'.$image->pia("width=200, quality=80, sharpening=medium")->url.'" data-min-width="140"></div>'
					.'<div data-src="'.$image->pia("width=140, quality=80, sharpening=medium")->url.'"></div>'
					.'<noscript>'
					.'<img src="images/'.$image->httpUrl.'" alt="img03"/>'
					.'</noscript>'
					.'</div>'
                    .'</li>';
    }
    $content .= '</ul>'
            .'<div class="gamma-overlay"></div>'
            . '</div>';

$content = renderMainPanel($title, $content);
$content = renderBackButton($content);
?>
