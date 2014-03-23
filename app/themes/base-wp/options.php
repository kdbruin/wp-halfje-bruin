<?php
/**
 * The theme option name is set as 'options-theme-customizer' here.
 * In your own project, you should use a different option name.
 * I'd recommend using the name of your theme.
 *
 * This option name will be used later when we set up the options
 * for the front end theme customizer.
 */

function optionsframework_option_name() {

	$optionsframework_settings = get_option('optionsframework');
	
	// Edit 'options-theme-customizer' and set your own theme name instead
	$optionsframework_settings['id'] = 'options_theme_customizer';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {
	
	$options[] = array( "name" => "Basic Settings",
		"type" => "heading" );
		
	$options['favicon_uploader'] = array(
		"name" => "Add favicon",
		"desc" => "Upload your favicon.",
		"id" => "favicon_uploader",
		"type" => "upload" );	
	
	$options['logo_uploader'] = array(
		"name" => "Logo Upload",
		"desc" => "Upload your logo.",
		"id" => "logo_uploader",
		"type" => "upload" );	
	
	$options[] = array(
		'name' => __('Link color', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');

	
	$options[] = array(
		'name' => __('Link color hover', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
		
	$options[] = array(
		'name' => __('Footer text', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('Display credits link', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');

	
	$options[] = array(
		'name' => __('Meta Slider', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
		
	$options[] = array( "name" => "Advanced Settings",
		"type" => "heading" );	
	
	$options[] = array(
		'name' => __('Custom css', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Footer code', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
	
	$options[] = array( "name" => "Blog and post settings",
		"type" => "heading" );	
	
	$options[] = array(
		'name' => __('Show featured image in blog and archive page', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('Show featured image in single post', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
	
	$options[] = array(
		'name' => __('Display meta inforamtion', 'base'),
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
		
	$options[] = array(
		'name' => "Display sidebar in blog and archive page",
		'desc' => __('Only available in premium version', 'base'),
		'type' => 'info');
	
	
return $options;
}

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */

add_action( 'customize_register', 'options_theme_customizer_register' );

function options_theme_customizer_register($wp_customize) {

	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */
	 
	$options = optionsframework_options();
	
	/* Logo upload */

	$wp_customize->add_section( 'options_theme_customizer_logo', array(
		'title' => __( 'Logo Upload', 'base' ),
		'priority' => 110
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[logo_uploader]', array(
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_uploader', array(
		'label' => $options['logo_uploader']['name'],
		'section' => 'options_theme_customizer_logo',
		'settings' => 'options_theme_customizer[logo_uploader]'
	) ) );	
	
	
	/* Add favicon */

	$wp_customize->add_section( 'options_theme_customizer_favicon', array(
		'title' => __( 'Favicon', 'base' ),
		'priority' => 110
	) );
	
	$wp_customize->add_setting( 'options_theme_customizer[favicon_uploader]', array(
		'type' => 'option'
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon_uploader', array(
		'label' => $options['favicon_uploader']['name'],
		'section' => 'options_theme_customizer_favicon',
		'settings' => 'options_theme_customizer[favicon_uploader]'
	) ) );	
}


add_action('optionsframework_after','optionscheck_display_sidebar', 100);

function optionscheck_display_sidebar() { ?>
    <div class="metabox-holder upgrade">
        <div class="postbox">
            <h3>Upgrade to premium version</h3>
                <div class="inside">
                    <p>Upgrade to the premium version to get access to advanced options.</p>
                     <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="TBQRFHBL5SZ8Y">
<input type="image" src="http://www.iografica.it/wp/wp-content/uploads/2014/03/base-wp-premium-buynowbutton.jpg" border="0" name="submit" alt="PayPal - Il metodo rapido, affidabile e innovativo per pagare e farsi pagare.">
<img alt="" border="0" src="https://www.paypalobjects.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
<p>With premium version you have access to priority support and lifetime upgrade.</br>
We offer a 7 day full refund if you're not happy with your purchase.</p>
                </div>
        </div>
    </div>
<?php }

