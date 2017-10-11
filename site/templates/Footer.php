<footer class="footer container" id='footer'>
			<div class="row">
				<div class="four columns">
					<h3>Kontakt</h3>
					<?php echo $page->kontakt ?>
				</div>
				<div class="four columns">
					<h3>Krankmeldung</h3>
					<?php echo $page->krankmeldung ?>
				</div>
				<div class="four columns text-center">
					<div class="schullogo">
							<img style="width:80%" src="<?php echo $config->urls->templates?>/img/schrabergschule_bild.jpg" alt="Schullogo"></img>
						</div>
				</div>
		
			<p>
			Powered by <a href='https://processwire.com'>ProcessWire CMS</a>  &nbsp; / &nbsp; 
			<?php 
			if($user->isLoggedin()) {
				// if user is logged in, show a logout link
				echo "<a href='{$config->urls->admin}login/logout/'>Logout ($user->name)</a>";
			} else {
				// if user not logged in, show a login link
				echo "<a href='{$config->urls->admin}'>Admin Login</a>";
			}
			?>
			</p>
			</div>
			</footer>
