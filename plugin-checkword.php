<?php
/*
Plugin Name: plugin-check word
Plugin URI:
Description: In this plugin will check the similarity of the words.
Author: Matt Atiwat Phongprayoon
Version: 0.1
Author URI:
*/

/**********
Global
**********/
$wptab_options = get_option('wp_tab_setting_up');
//original article
$original = $wptab_options['original'] ?? '';

//Description article
$rewritten = $wptab_options['rewrite'] ?? '';

//Compare article
$wp_comparefunction = similar_text($original, $rewritten, $result);

//admin article page
function wp_checkword_page(){
global $wptab_options;
global $result;
ob_start();?>

<div class="wrap">
<form action= "options.php" method="POST">
<?php settings_fields('wp_tap_name'); ?>

<h1> Word Similarity Check </h1>
<p>
<h3> Please Fill-up Original Article </h3>
</p>
<textarea name="wp_tab_setting_up[original]" rows="20" cols="85"><?php echo $wptab_options['original'] ?? ''; ?></textarea>

<p>
<h3> Please fill your Re-Article .... here </h3>
</p>
<textarea name="wp_tab_setting_up[rewrite]" rows="20" cols="85"><?php echo $wptab_options['rewrite'] ?? ''; ?></textarea>
<p>
<input type="submit" class="button-primary" Value="Compare article word">
<input type="button" class="button" value="<?php echo $result.'%'; ?>"
</p>

</form>
</div>
<?php

echo ob_get_clean();
}

// admin tab (for storing information)
function wp_tab(){

add_options_page('wp_tab_desc', 'wp_tab_display', 'manage_options', 'wptab', 'wp_checkword_page');
}
add_action('admin_menu', 'wp_tab'); // add_action is for texture parameter, admin_page is hook function to load page.


// register settings
function wp_tab_setting(){

register_setting('wp_tap_name', 'wp_tab_setting_up'); // this function will display result page
}
add_action('admin_init', 'wp_tab_setting');
