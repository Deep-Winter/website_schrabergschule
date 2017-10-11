<?php

/**
 * /site/templates/_func.php
 * 
 * Example of shared functions used by template files
 *
 * This file is currently included by _init.php 
 *
 * For more information see README.txt
 *
 */


/**
 * Given a group of pages, render a simple <ul> navigation
 *
 * This is here to demonstrate an example of a simple shared function.
 * Usage is completely optional.
 *
 * @param PageArray $items
 * @return string
 *
 */
function renderNav(PageArray $items, Array $templates = array()) {

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		if ( count($templates) > 0)  {
			$found = false;
			foreach($templates as $template) {
				if ($template == $item->template->name) $found |= true;
			}
			if (!$found) continue;
		}

		// render markup for each navigation item as an <li>
		if($item->id == wire('page')->id) {
			// if current item is the same as the page being viewed, add a "current" class to it
			$out .= "<li class='current'>";
		} else {
			// otherwise just a regular list item
			$out .= "<li>";
		}

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a> ";

		// if the item has summary text, include that too
		if($item->summary) $out .= "<div class='summary'>$item->summary</div>";

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='nav'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}



/**
 * Given a group of pages, render a <ul> navigation tree
 *
 * This is here to demonstrate an example of a more intermediate level
 * shared function and usage is completely optional. This is very similar to
 * the renderNav() function above except that it can output more than one
 * level of navigation (recursively) and can include other fields in the output.
 *
 * @param array|PageArray $items
 * @param int $maxDepth How many levels of navigation below current should it go?
 * @param string $fieldNames Any extra field names to display (separate multiple fields with a space)
 * @param string $class CSS class name for containing <ul>
 * @return string
 *
 */
function renderNavTree($items, $maxDepth = 0, $fieldNames = '', $class = 'nav', $templates = array()) {

	// if we were given a single Page rather than a group of them, we'll pretend they
	// gave us a group of them (a group/array of 1)
	if($items instanceof Page) $items = array($items);

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		if ( count($templates) > 0)  {
			$found = false;
			foreach($templates as $template) {
				if ($template == $item->template->name) $found |= true;
			}
			if (!$found) continue;
		}

		// markup for the list item...
		// if current item is the same as the page being viewed, add a "current" class to it
		$out .= $item->id == wire('page')->id ? "<li class='current'>" : "<li>";

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a>";

		// if there are extra field names specified, render markup for each one in a <div>
		// having a class name the same as the field name
		if($fieldNames) foreach(explode(' ', $fieldNames) as $fieldName) {
			$value = $item->get($fieldName);
			if($value) $out .= " <div class='$fieldName'>$value</div>";
		}

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children 
		if($item->hasChildren() && $maxDepth) {
			if($class == 'nav') $class = 'nav nav-tree';
			$out .= renderNavTree($item->children, $maxDepth-1, $fieldNames, $class);
		}

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='$class'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}

function renderMobileNavTree($items, $maxDepth = 0, $fieldNames = '', $class = 'nav', $templates = array()) {

	// if we were given a single Page rather than a group of them, we'll pretend they
	// gave us a group of them (a group/array of 1)
	if($items instanceof Page) $items = array($items);

	// $out is where we store the markup we are creating in this function
	$out = '';

	// cycle through all the items
	foreach($items as $item) {

		if ( count($templates) > 0)  {
			$skip = false;
			foreach($templates as $template) {
				if ($template == $item->template->name) $skip |= true;
			}
			if ($skip) continue;
		}

		// markup for the list item...
		// if current item is the same as the page being viewed, add a "current" class to it
		$out .= $item->id == wire('page')->id ? "<li class='current'>" : "<li>";

		// markup for the link
		$out .= "<a href='$item->url'>$item->title</a>";

		// if there are extra field names specified, render markup for each one in a <div>
		// having a class name the same as the field name
		if($fieldNames) foreach(explode(' ', $fieldNames) as $fieldName) {
			$value = $item->get($fieldName);
			if($value) $out .= " <div class='$fieldName'>$value</div>";
		}

		// if the item has children and we're allowed to output tree navigation (maxDepth)
		// then call this same function again for the item's children 
		if($item->hasChildren() && $maxDepth) {
			if ($item->template->name != "home") {
				if($class == 'nav') $class = 'nav nav-tree';
				$out .= renderMobileNavTree($item->children, $maxDepth-1, $fieldNames, $class, $templates);
			}
		}

		// close the list item
		$out .= "</li>";
	}

	// if output was generated above, wrap it in a <ul>
	if($out) $out = "<ul class='$class'>$out</ul>\n";

	// return the markup we generated above
	return $out;
}

function renderDefaultSideBar($page) {
	$out = '';

	$init = false;
	
		if(count($page->parents) >= 2) {
		// render Headline
			
			
			if(count($page->parents) == 2) {
				if (!$init) {
					$out .= '<div class="panel main-panel">';
					$init = true;
				}
				$out.= '<h2>Mehr zu &ldquo;' 
				. $page->title 
				. '&rdquo;</h2>'; 
			
				$navItems = $page->children;
			} else {
				if (!$init) {
					$out .= '<div class="panel main-panel">';
					$init = true;
				}
				$out.= '<h2>' 
				. $page->parent->title 
				. '</h2>'; 
				
				$navItems = $page->parent->children;
			}
			// render NavigationTree
			$out.= renderNavTree($navItems, 0, 'role shortdescription', 'nav', array()); 
		}
					
		if ($page->sidebar && strlen($page->sidebar)>0) {
			
			if (!$init) {
					$out .= '<div class="panel main-panel">';
					$init = true;
				}
			// render Content

			$out .= $page->sidebar;
		}
				
	
	// if PDF Documents available render second panel for downloads
	if (count($pdfs) > 0) {
		if (!$init) {
					$out .= '<div class="panel main-panel">';
					$init = true;
				}
		$out .= '<div class="panel">'
				.'<h2>PDF-Downloads</h2>' 
				. renderNavTree($pdfs, 0, '', 'link-list') 
				. '</div>';
	}

	if ($init) {
		$out.= '</div>';
	}
	// return the markup we generated above
	return $out;
}

function renderMainPanel($title, $body) {
	 return '<div class="panel main-panel">'
	 . '<h1>' . $title . '</h1>' 
	 . $body 
	 . '</div>'; 
}

function renderImageGalleryPreview($galleries, $content, $filterClassOnly) {
	foreach($galleries as $gallery)  {
        if ($filterClassOnly && $gallery->classonly && $gallery->rootParent()->name!='galerie')  {
            continue;
        }

		$content.='<h2>'.$gallery->title.'</h2>';
        $content.='<div>';
        $count = 0;
        foreach($gallery->images as $image) {
            $content.='<div style="width:10%;display:inline-block"><img src="'.$image->crop('square=100')->url.'" style="width:100%"></div>';
            $count++;
            if($count == 10) {
                break;
            }
        }
        $content.='</div><a href="'.$gallery->url.'">Alle '.sizeof($gallery->images).' Bilder ansehen...</a>';
        $content.='<hr />';

		
    }
	return $content;
}

function renderNewsList($news, $content) {
	if (sizeof($news) == 0) return $content;
	
	$content .= '<h1>Aktuelles</h1>';
		
	foreach($news as $article) {
		$content .= '<h2>'.$article->date.' - '.$article->title.'</h2>';
		$content .= '<p>'.$article->textpreview.'</p>';
		$content .= '<p><a href="'.$article->url.'">Mehr lesen...</a>';
		$content.='<hr />';
	}
	return $content;
}

function renderBackButton($content) {
	$content .= '<div class="text-right" style="margin-bottom:20px"><a class="button" href="javascript:history.go(-1);">&lt; Zurück</a></div>';
	return $content;
}

function renderSubnavigation($page) {
	$allowedTeplates = array("Bereich", "Kollegium", "Klassen");
	
	$render = false;
	
	if ($page->rootParent->template->name != "home") {
	
		$mainpages = $page->rootParent->children;
		$subnavigation = '<div class="sub-nav" role="navigation"><ul>';
		foreach($mainpages as $item) { 
			if (in_array($item->template->name, $allowedTeplates))  { 
				$render = true;
				if($item->id == $page->id || $item->id == $page->parent->id) 
					{ $subnavigation.="<li class='current'>"; } 
				else { $subnavigation.= "<li>"; } 
				$subnavigation.="<a href='$item->url'>$item->title</a></li>"; 
			} 
		}
	$subnavigation .= '</ul></div><div class="patch red"></div>';
	}
			
	if (!$render) return '<div class="patch red homepage"></div>';
	
	return $subnavigation;
}

function linkTo($content, $page) {
	return '<a href="'.$page->url.'" title="'.$page->title.'">'.$content.'</a>';
}

function renderNews($news) {
	$content = '';	
	
	if (sizeof($news) == 0) return $content;
	
	foreach($news as $article) {
		$content .= '<h2>'.$article->date.' - '.$article->title.'</h2>';
		$content .= '<p>'.$article->textpreview.'</p>';
		$imgcount = 0;
		$content .= '<div class="row">';
		foreach ($article->images as $image) {	
			if ($imgcount < 3) {
				$content .= '<div class="four columns"><img style="width:100%" src="'. $image->pia("square=200, cropping=true, quality=80, sharpening=medium")->url .'" ></img></div>';
			}
			$imgcount ++;
		}
		
		$content .= '</div><p><a href="'.$article->url.'">Mehr lesen...</a>';
		$content.='<hr />';
	}
	
	return $content;
	
}


