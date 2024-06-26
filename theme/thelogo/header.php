<?php
/**
 * Header
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="container">
        <header id="masthead" class="site-header">
            <div class="site-branding">
                <?php
				the_custom_logo();
				if (is_front_page() && is_home()):
					?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                        rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php
				else:
					?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                        rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
				endif;
				?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php //esc_html_e('Primary Menu', 'thelogo'); ?></button>
                <?php
				wp_nav_menu(
					array(
						'theme_location' => 'main-menu',
						'menu_id' => 'primary-menu',
					)
				);
				?>
            </nav><!-- #site-navigation -->
        </header><!-- #masthead -->