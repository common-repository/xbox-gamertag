<?php
/*
Plugin Name: XBOX Gamertag 
Plugin URI: http://guill3.wordpress.com
Description: Adds your XBOX Live Gamertag to your sidebar.
Version: 0.1
Author: Guillermo López
Author URI: http://guill3.wordpress.com
*/

/*  Copyright 2009  Guillermo López  (email : guillelo11@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function widget_xboxgamertag_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_xboxgamertag($args) {
		extract($args);
		$options = get_option('widget_xboxgamertag');
		$title = $options['title'];
		$gamertag = $options['gamertag'];
		echo $before_widget . $before_title . $title . $after_title;
		echo '<a href="http://profile.mygamercard.net/'.$gamertag.'"><img src="http://card.mygamercard.net/'.$gamertag.'.png" height="135" width="199"></a>';
		echo $after_widget;
	}

	function widget_xboxgamertag_control() {

		$options = get_option('widget_xboxgamertag');
		if ( !is_array($options) )
			$options = array('title'=>'XBOX Gamertag', 'gamertag'=>'guillelo11');
		if ( $_POST['xboxgamertag-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['xboxgamertag-title']));
			$options['gamertag'] = strip_tags(stripslashes($_POST['xboxgamertag-gamertag']));
			update_option('widget_xboxgamertag', $options);
		}
		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		$gamertag = htmlspecialchars($options['gamertag'], ENT_QUOTES);
		echo '<p style="text-align:left;"><label for="xboxgamertag-title">Title: <input style="width: 199px;" id="xboxgamertag-title" name="xboxgamertag-title" type="text" value="'.$title.'" /></label></p>';
		echo '<p style="text-align:left;"><label for="xboxgamertag-gamertag">Gamertag: <input style="width: 199px;" id="xboxgamertag-gamertag" name="xboxgamertag-gamertag" type="text" value="'.$gamertag.'" /></label></p>';
		echo '<input type="hidden" id="xboxgamertag-submit" name="xboxgamertag-submit" value="1" />';
	}

	register_sidebar_widget('XBOX Gamertag', 'widget_xboxgamertag');
	register_widget_control('XBOX Gamertag', 'widget_xboxgamertag_control', 199, 135);

}
add_action('plugins_loaded', 'widget_xboxgamertag_init');

?>