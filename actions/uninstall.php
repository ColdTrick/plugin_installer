<?php
	/**
	* Plugin Installer - uninstaller
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	// Make sure action is secure
	admin_gatekeeper();
	action_gatekeeper();
	
	global $CONFIG;
	$plugin_name = get_input('plugin');
	//echo $CONFIG->pluginspath . "$plugin_name";exit();
	if($plugin_name){
		disable_plugin($plugin_name); 
		$res = rmdirr($CONFIG->pluginspath . "$plugin_name");
		regenerate_plugin_list();
		if($res){
			system_message(elgg_echo('plugin_installer:uninstall:success'));		
		} else {
			register_error(elgg_echo('plugin_installer:uninstall:error'));		
		}
	} else {
		register_error(elgg_echo('plugin_installer:uninstall:noplugin'));		
	}
	
	forward($_SERVER['HTTP_REFERER']);
	
	function rmdirr($dirname){
		// Sanity check
		if (!file_exists($dirname)) {
			return false;
		}

		// Simple delete for a file
		if (is_file($dirname) || is_link($dirname)) {
			return unlink($dirname);
		}

		// Loop through the folder
		$dir = dir($dirname);
		while (false !== $entry = $dir->read()) {
			// Skip pointers
			if ($entry == '.' || $entry == '..') {
				continue;
			}

			// Recurse
			rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
		}

		// Clean up
		$dir->close();
			return rmdir($dirname);
	}

?>