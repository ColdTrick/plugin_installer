<?php
	/**
	* Plugin Installer
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	
	global $CONFIG;
	
	function plugin_installer_init(){
		// extend css
		extend_view("css", "plugin_installer/css");
	}
	
	function plugin_installer_pagesetup(){
		global $CONFIG;
		
		if(isadminloggedin()){			
			if(get_context() == "admin"){
				add_submenu_item(elgg_echo("plugin_installer:title"), $CONFIG->wwwroot . "mod/plugin_installer/index.php");
				// fast tool admin
				extend_view("admin/plugins","plugin_installer/plugin_admin",400);
			}
		}
	}
	
	register_elgg_event_handler('init','system','plugin_installer_init');
	register_elgg_event_handler('pagesetup','system','plugin_installer_pagesetup');
	
	// actions
	register_action("plugin_installer/install", false, $CONFIG->pluginspath . "plugin_installer/actions/install.php");
	register_action("plugin_installer/uninstall", false, $CONFIG->pluginspath . "plugin_installer/actions/uninstall.php");
	register_action("plugin_installer/export", false, $CONFIG->pluginspath . "plugin_installer/actions/export.php");
	register_action("plugin_installer/re_enable", false, $CONFIG->pluginspath . "plugin_installer/actions/re_enable.php");
?>