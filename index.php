<?php
	/**
	* Plugin Installer
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
	set_context('admin');
	// Display main admin menu
	page_draw(elgg_echo('plugin_installer:title'),elgg_view_layout("two_column_left_sidebar", '', elgg_view_title(elgg_echo('plugin_installer:title')) . elgg_view('plugin_installer/default')));
	
?>