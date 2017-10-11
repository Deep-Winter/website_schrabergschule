<?php
// basic-page.php template file 
// See README.txt for more information

// Primary content is the page's body copy
$content = renderMainPanel($title, $content);
$content = renderBackButton($content);

// Sidebar Content
$sidebar = ''; // renderDefaultSideBar($page);

?>
