<?php
	/**
	* Plugin Installer (this is a copy of enable actions of core)
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/

	require_once(dirname(dirname(dirname(dirname(__FILE__)))) . "/engine/start.php");
	
	// block non-admin users
	admin_gatekeeper();
	
	// Validate the action
	action_gatekeeper();
	
	// Get the plugin 
	$plugin = get_input('plugin');
	if (!is_array($plugin))
		$plugin = array($plugin);
	
	foreach ($plugin as $p)
	{
		// Re enable
		if (disable_plugin($p) && enable_plugin($p))
			system_message(sprintf(elgg_echo('plugin_installer:plugin_admin:reactivate:yes'), $p));
		else
			register_error(sprintf(elgg_echo('plugin_installer:plugin_admin:reactivate:no'), $p));		
	}
		
	elgg_view_regenerate_simplecache();
	
	$cache = elgg_get_filepath_cache();
	$cache->delete('view_paths');
	
	forward($vars['url'] . "pg/admin/plugins/");
	exit;
?>