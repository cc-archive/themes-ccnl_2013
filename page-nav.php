		<header> 
			<div class="topbar">
				<div class="topbar-inner">
					<div class="container">
						<div class="sixteen columns">
							<div class="row">
								<div class="five columns">					
									<div style="float:left; cursor: pointer;" id="logo" onclick="javascript:location.href='<?php echo home_url('/');?>';"><span>Creative Commons</span><img src="<?php header_image(); ?>" alt="logo"/></div>
								</div>
								
								<?php
								/*
								<div class="three columns">	
									<?php get_search_form( true ); ?>
								</div>
								*/ 
								?>
								
								<div id="searchform">	
									
										<?php get_search_form( true ); ?>
									
								</div>
								
								<div class="seven columns">	
									<div style="float:left; vertical-align:middle;"><?php if (function_exists('shailan_dropdown_menu')) { shailan_dropdown_menu( array('menu'=>'header-menu') );} ?></div>
								</div>	
								
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
