<div id="wrapper">
	<div id="header_functions">
		<div id="login_1"><?php print render($page['login']) ?></div>	
		<div id="search_1"><?php print render($page['search']) ?></div>
		<div id="right_1"><?php print render($page['top_right']) ?></div>
	  </div>
	<div id="header">
		<div id="header_top">
			
		</div>
		<div><a href="/"><img src="<?php print $base_path; ?><?php print $directory; ?>/images/logo.png" /></a></div>
		<?php /*if ($main_menu): ?>
			<div id="nav" class="menu <?php if (!empty($main_menu)) {print "with-primary";} if (!empty($secondary_menu)) {print " with-secondary";} ?>">
				<?php print theme('links', array('links' => $main_menu, 'attributes' => array('id' => 'primary', 'class' => array('links', 'clearfix', 'main-menu')))); ?>
			</div>
		<?php endif; */?>
		<!--Home  |  Estate Gallery  |  Artisan Gallery  |  Wedding & Engagement  |  Reviews & Press  |  Gilt Facets | Find Us  |  Contact-->
		
		<?php if(isset($page['horz_nav']) && !empty($page['horz_nav'])):  print render($page['horz_nav']); endif; ?>
    	
	</div>
  
	<div id="main" class="jewel_cnttype" >Made to Order page template
		<div id="content-wrapper">
			<div id="content-inner">
				<div id="content-inner-top">
					<div id="content-inner-bottom">
						<div id="left-column"><?php print render($page['left_column']); ?>
							<div id="left-column-bottom"><?php print render($page['left_column_bottom']); ?></div>
						</div>
            
						<div id="center-column">
							<?php if ($breadcrumb || $title|| $messages || $tabs || $action_links): ?>
							<div id="content-header">
								<?php print $breadcrumb; ?>
				  
								<?php /*?><?php if ($page['highlight']): ?>
									<div id="highlight"><?php print render($page['highlight']) ?></div>
								<?php endif; ?>
				  
								<?php if ($title): ?>
									<h1 class="title"><?php print $title; ?></h1>
								<?php endif; ?><?php */?>
				  
								<?php print $messages; ?>
								<?php print render($page['help']); ?>
				  
								<?php if ($tabs): ?>
									<div class="tabs"><?php print render($tabs); ?></div>
								<?php endif; ?>
				  
								<?php if ($action_links): ?>
									<ul class="action-links"><?php print render($action_links); ?></ul>
								<?php endif; ?>
              
							</div> <!-- /#content-header -->
							<?php endif; ?>
							
							<?php print render($page['content']) ?>
							
						</div>
						
						<?php /* ?>
						<div id="right-column">
							<?php print render($page['right_column']); ?>
						</div>
						<?php */ ?>
			
					</div>
				</div>
			</div>
		</div>
	</div>
  
	<div id="footer_wrapper">
		<div id="footer_top">
			<?php print render($page['footer_top']); ?>
				<!--A collection of <span style="font-size:18px;">vintage jewelry</span>, estate <span style="font-size:18px;">engagement rings</span>, artisan creations &amp; other <span style="font-size:18px;">luscious treasures</span>.-->
		</div>
		<div id="footer_mid">
			<?php print render($page['footer_mid']); ?>
		</div>
		<div id="footer_bottom">
			<?php print render($page['footer_bottom']); ?>
			<!--| Privacy Policy | Terms of Use | Conditions of Sale | Customer Service | Ring Size Tools | Favorite Links |<br />
			| Contact Us | Find Us |-->
		</div>
  
	</div>
  	
</div>