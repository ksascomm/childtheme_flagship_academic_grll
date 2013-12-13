<?php
	$home_url = site_url();
	$program_slug = get_the_program_slug($post);
    $page = get_queried_object_id();
    $ancestors = get_post_ancestors( $page );
    $page_object = get_post($page);
    if (count($ancestors) == 1 ) {$url = $page_object->post_name . '/';} else $url = '';
    $programs = get_terms('program', array(
    		'orderby'       => 'name', 
    		'order'         => 'ASC',
    		'hide_empty'    => false, 
    		));
    		
    $count_programs =  count($programs); ?>
<header>
<?php if(is_handheld()) { ?>
	<div class="row show-for-small" id="mobile-header">
			<div class="four columns centered">
			<div class="mobile-logo centered"><a href="http://krieger.jhu.edu">Home</a></div>
			<h2 class="white capitalize" align="center"><?php echo $program_slug . ' Program'; ?></h2>
		<div class="row" id="site_title">
			<div class="three columns program">	
				<select id="program_switch">
					<option>Switch Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug . '/' . $url; ?>"><?php echo $program->name; ?></option>
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
		<div class="row">
			<div class="three columns hide-for-small" id="logo_nav">
				<li class="logo"><a href="<?php echo network_home_url(); ?>" title="Krieger School of Arts & Sciences">Krieger School of Arts & Sciences</a></li>
			</div>
		</div>
		
		
		<div class="row hide-for-small hide-for-print" id="site_title">
			<div class="three columns program">	
				<select id="program_switch">
					<option>Switch Program &#9662;</option>
					<option value="<?php echo $home_url; ?>">Department Home</option>
					<?php if ( $count_programs > 0 ) { foreach ( $programs as $program ) { ?>
							<option value="<?php echo $home_url . '/' . $program->slug . '/' . $url; ?>"><?php echo $program->name; ?></option>
					<?php } } ?>
				</select>
			</div>
			<div class="nine columns">	
				<a href="<?php echo site_url('/') . $program_slug; ?>"><h1 class="white"><span class="small"><?php echo get_bloginfo ( 'title' ); ?></span>	<span class="capitalize">				<?php echo $program_slug . ' Program'; ?></span></h1></a>
			</div>
		</div>
<? } ?>	
		<div class="row hide-for-print">
			<?php 
				if (false === ( $program_menu = get_transient('menu_' . $program_slug . '_query'))) {
                	// parameter echo will return the menu instead of echoing it
					$program_menu = wp_nav_menu( array( 
						'menu' => $program_slug, 
						'menu_class' => 'nav-bar', 
						'container' => 'nav',
						'container_id' => 'main_nav', 
						'container_class' => 'twelve columns',
						'fallback_cb' => 'foundation_page_menu',
						'walker' => new foundation_navigation(),
						'depth' => 2,
						 'echo' => 0  ));
					set_transient('menu_' . $program_slug . '_query', $program_menu, 2592000);
				}
 
				echo $program_menu; ?>
		</div>

</header>