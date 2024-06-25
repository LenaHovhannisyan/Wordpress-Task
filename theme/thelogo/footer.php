<?php
/**
 * Footer
 */

?>
</div><!-- page -->
<footer class="site-footer">
	<div class="site-info">
		<?php the_custom_logo(); ?>

		<div class="social-links">
			<?php
			$social_links_title = get_theme_mod('footer_social_links_title', __('Follow Us', 'thelogo'));
			$social_networks = array(
				'facebook' => 'fab fa-facebook-f',
				'twitter' => 'fab fa-twitter',
				'instagram' => 'fab fa-instagram',
				'linkedin' => 'fab fa-linkedin-in'
			);

			if (!empty($social_links_title)) {
				echo '<h3 class="footer-social-links-title">' . esc_html($social_links_title) . '</h3>';
			}

			foreach ($social_networks as $network => $icon_class) {
				$network_url = get_theme_mod("footer_{$network}_link");
				if ($network_url) {
					echo '<div class="social-icon"><a href="' . esc_url($network_url) . '" target="_blank" class="social-icon ' . esc_attr($network) . '"><i class="' . esc_attr($icon_class) . '"></i><span class="screen-reader-text">' . ucfirst($network) . '</span></a></div>';
				}
			}
			?>
		</div>

	</div><!-- .site-info -->
	<div class="copyright">
		<?php
		$copyright_text = get_theme_mod('footer_copyright_text', 'Your Company Name. All rights reserved.');
		$current_year = date('Y');
		echo sprintf('Copyright © %s %s', $current_year, esc_html($copyright_text));
		?>
	</div><!-- .copyright -->
</footer><!-- footer -->


<?php wp_footer(); ?>

</body>

</html>