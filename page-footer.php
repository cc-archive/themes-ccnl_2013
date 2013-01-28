		<footer id="fixfooter">
		<div class="container">
				<div id="colophon">
				<div class="sixteen columns">
					<div class="first row">
						<div class="six columns">
							<div class="bucket">
								<?php if (function_exists('shailan_dropdown_menu')) {shailan_dropdown_menu( array('menu'=>'footer-menu') ); } ?>
							</div>
						</div>
						<div class="seven columns">
						  <div class="bucket">
						  		<?php dynamic_sidebar( 'Footer Copyright Notice' ); ?>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
