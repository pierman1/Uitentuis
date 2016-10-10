<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    
<!-- Meta  -->
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
<!-- Favicons -->
    
<!-- wp_head(); -->
<?php wp_head(); ?>
</head>
    
<body <?php body_class(); ?>>

<header class="header">
	
	<a href="<?php echo home_url();?>#showcase">
		<img class="header__logo" src="<?php echo ICONS_URL; ?>/
		solar_made_logo.svg" alt="solar made logo">
	</a>

	<?php wp_nav_menu($args = array('menu' => 'primary', 'container' => 'nav', 'container_class' => 'header__nav')) ?>
</header>
