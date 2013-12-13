<header>
<?php
	$home_url = site_url();
	$program_slug = get_the_program_slug($post);
    $programs = get_terms('program', array(
    		'orderby'       => 'name', 
    		'order'         => 'ASC',
    		'hide_empty'    => false, 
    		));
    		
    $count_programs =  count($programs); ?>

<?php if(is_handheld()) { ?>
		<div class="row show-for-small" id="mobile-header">
			<div class="four columns centered">
			<div class="mobile-logo centered"><a href="http://krieger.jhu.edu">Home</a></div>
			<h2 class="white" align="center"><?php echo get_bloginfo('title'); ?></h2>
		<div class="row" id="site_title">
						
			<div class="three columns program">	
				<select id="program_switch">
					<option>Switch Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug . '/'; ?>"><?php echo $program->name; ?></option>
					<?php } } ?>
				</select>
			</div>
			</div>
		</div>
		</div>
<?php } ?>
		<div class="row hide-for-print">
			<div id="search-bar" class="offset-by-seven five mobile-four columns">
				<div class="row">
					<div class="six columns mobile-four">
					<?php $theme_option = flagship_sub_get_global_options(); 
							$collection_name = $theme_option['flagship_sub_search_collection'];
					?>

					<form method="GET" action="<?php echo site_url('/search'); ?>">
						<input type="submit" class="icon-search" value="&#xe004;" />
						<input type="text" name="q" placeholder="Search this site" />
						<input type="hidden" name="site" value="<?php echo $collection_name; ?>" />
					</form>
					</div>
						<?php wp_nav_menu( array( 
							'theme_location' => 'search_bar', 
							'menu_class' => '', 
							'fallback_cb' => 'foundation_page_menu', 
							'container' => 'div',
							'container_id' => 'search_links', 
							'container_class' => 'six columns links mobile-two inline hide-for-mobile',
							'depth' => 1,
							'items_wrap' => '%3$s', )); ?> 
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>	
<?php if(!is_handheld()) { ?>
		<div class="row hide-for-small hide-for-print">
			<div class="three columns hide-for-small" id="logo_nav">
				<li class="logo"><a href="http://krieger.jhu.edu" title="Krieger School of Arts & Sciences">Krieger School of Arts & Sciences</a></li>
			</div>
		</div>
		<div class="row hide-for-small grll" id="site_title">
			<div class="three columns program">	
				<select id="program_switch">
					<option>Select Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug; ?>"><?php echo $program->name; ?></option>
					<?php } } ?>
				</select>
			</div> 
			<div class="six columns end">	
				<a href="<?php echo $home_url; ?>"><h1 class="white"><span class="small"><?php echo get_bloginfo ( 'description' ); ?></span>					<?php echo get_bloginfo ( 'title' ); ?></h1></a>
			</div>
		</div>
<?php } ?>		
		<div class="row hide-for-print">
			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => 'nav-bar', 
				'container' => 'nav',
				'container_id' => 'main_nav', 
				'container_class' => 'twelve columns',
				'fallback_cb' => 'foundation_page_menu',
				'walker' => new foundation_navigation(),
				'depth' => 2  )); ?> 
		</div>

</header>