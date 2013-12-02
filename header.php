<!DOCTYPE html>
<html lang="en" class="no-js"> 

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?php create_page_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.ico" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-144x144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-114x114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-72x72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-57x57-precomposed.png" />
  <!-- CSS Files: All pages -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/foundation.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/flagship.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css">
  <script async type="text/javascript" src="http://fast.fonts.com/jsapi/c5f514c7-d786-4bfb-9484-ea6c8fbd263f.js"></script>
  <!-- CSS Files: Conditionals -->
  
  <!-- Modernizr and Jquery Script -->
  <script async type="text/javascript" src="<?php echo get_template_directory_uri() ?>/assets/javascripts/modernizr.foundation.js"></script>
  <?php wp_enqueue_script('jquery', true); ?> 
  <?php wp_head(); ?>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script async src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php include_once("parts-analytics.php"); ?>
</head>
<?php $program_slug = get_the_program_slug($post); global $blog_id; $site_id = 'site-' . $blog_id; ?>
<body <?php body_class($program_slug . ' ' . $site_id); ?>>
	<?php if(!empty($program_slug)) { locate_template('parts-header-sub.php', true); } else { locate_template('parts-header-main.php', true); } ?>
	
	
