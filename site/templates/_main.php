<?php  
	
	$navigationTemplates = array("Bereich", "GalerieSammlung", "Foerderverein","Schuelerredaktion");
?><!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Schrabergschule Herdecke</title>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<link href="https://fonts.googleapis.com/css?family=Loved+by+the+King|Roboto+Condensed:400,700" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css" rel="stylesheet">
		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="//ajax.googleapis.com" rel="dns-prefetch">
		<link href="<?php echo $config->urls->templates?>/styles/style.min.css" rel="stylesheet">

		<script src="<?php echo $config->urls->templates?>/components/modernizr.js"></script>
	</head>
<body class="<?php if($sidebar) echo "has-sidebar "; ?> ">
	 <!-- .container is main centered wrapper -->
    <div class="container page-background">
		<div class="mobile">
			<button class="navigation-trigger button"><i class="fa fa-bars"></i></button>
			<div id="mobile-navigation" class="mobile-navigation">
				<form class='search-form' action='<?php echo $pages->get('template=search')->url; ?>' method='get'>
							<div class="form-group">
								<input type='text' class='search u-full-width' name='q' placeholder='Suche' value='<?php echo $sanitizer->entities($input->whitelist('q')); ?>' />
								<i class="fa fa-search"></i>
							</div>	
						</form>
				<?php echo(renderMobileNavTree($homepage->and($homepage->children),1,'','mobile-nav', array("Artikel","Galerie","Termin"))) ?>
			</div>
		</div>
		<header class="header" role="banner">
			 <!--
					 **********  Seitennavigation **********
				-->
        	<nav class="site-nav" role="navigation">
          		<ul><?php
	         
	          		if($page->id == $homepage->id) { echo "<li class='current'>"; } 
	 		         else { echo "<li>"; } echo "<a href='$homepage->url'>Startseite</a></li>";
	          		 foreach( $homepage->children as $item) { 
		          		 if (!in_array($item->template->name, $navigationTemplates))  { 
			          		 if($item->id == $page->rootParent->id) { echo "<li class='current'>"; } 
			          		 else { echo "<li>"; } echo "<a href='$item->url'>$item->title</a></li>"; } 
			          	 } 
			         ?></ul>
			</nav>
			 <div class="row">
				 <!--
					 **********  LOGO **********
				-->
				<div class="seven columns">
					<div class="logo">
						<a href="<?php echo($homepage->url) ?>">
							<img src="<?php echo $config->urls->templates?>/img/logo.png" alt="Logo Schrabergschule"></img>
						</a>
					</div>
				</div>
				<div class="five columns"> <!--
					 **********  Suche **********
					-->
					<div class="search">
						<!-- search form-->
						<form class='search-form' action='<?php echo $pages->get('template=search')->url; ?>' method='get'>
							<div class="form-group">
								<input type='text' class='search u-full-width' name='q' placeholder='Suche' value='<?php echo $sanitizer->entities($input->whitelist('q')); ?>' />
								<i class="fa fa-search"></i>
							</div>	
						</form>
					</div>
					<!--
					<div class="schullogo">
						<img src="<?php echo $config->urls->templates?>/img/schullogo.jpg" alt="Schullogo"></img>
					</div> -->
				</div>
			</div>
			 <!--
					 **********  Hauptnavigation **********
				-->
			<div class="main-nav" role="navigation">
            	<ul><?php
	            	

 foreach($homepage->and($homepage->children) as $item) { 
	 if (in_array($item->template->name, $navigationTemplates))  { 
	 	if($item->id == $page->rootParent->id) { 
		 	echo "<li class='current'>"; } else { echo "<li>"; } echo "<a href='$item->url'>$item->title</a></li>"; 
		 }
		  
	} ?>
				</ul>
			</div>
			<?php echo renderSubnavigation($page); ?>
			<div class='breadcrumb'><?php  foreach($page->parents() as $item) { echo "<span><a href='$item->url'>$item->title</a></span> / "; } echo "<span>$page->title</span> "; 
			
			if($page->editable()) echo "<div class='edit'><a href='$page->editUrl'><i class='fa fa-edit'></i> Seite bearbeiten</a></div>"; ?></div>
		</header>
		<main class="main" role="main">
			<div class="row">
				<!-- sidebar content -->
				<?php if($sidebar && strlen($sidebar) > 0): ?>
				<div class="eight columns">
					<?php echo $content; ?>
					<div class="patch blue"></div>

				</div>
				<div class="four columns sidebar">
					<?php echo $sidebar; ?>
				</div>
				<?php else: ?>
					<div class="twelve columns">
						<?php echo $content; ?>
						<div class="patch blue"></div>
					</div>
				<?php endif; ?>
			</div>
		</main>
		<div class="patch green"></div>
		<div class="patch yellow"></div>
	</div>
	<!-- footer -->
	<?php echo $pages->get("/footer/")->render(); ?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	
		<script>window.jQuery || document.write('<script src="components/jquery.js"><\/script>');</script>
		<script src="<?php echo $config->urls->templates?>/components/moment.min.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/jquery.history.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/jquery.masonry.min.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/jquerypp.custom.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/js-url.min.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/gamma.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
		<script src="<?php echo $config->urls->templates?>/components/locale/de.js"></script>
		<script src="<?php echo $config->urls->templates?>/scripts/scripts.min.js"></script>
		<?php
			/*
		<script>
		(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-XXXXXXXX-XX');
		ga('send', 'pageview');
    </script> */?>
</body>
</html>
