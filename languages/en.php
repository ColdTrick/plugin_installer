<?php
	$english = array(
		// Main title
		'plugin_installer' => "Plugin Installer",
		'plugin_installer:title' => "Plugin Installer",
		'plugin_installer:shorttitle' => "Plugin Installer",
		
		'plugin_installer:install' => "Install",
		'plugin_installer:uninstall' => "Uninstall",
		
		'plugin_installer:export' => "Export Plugin to Zip",
		
		// Upload
		'plugin_installer:upload' => "Upload",
		'plugin_installer:upload:overwrite' => "Overwrite existing plugins",
		'plugin_installer:upload:success' => "Succesfull installed new package",
		'plugin_installer:upload:missing' => "No package was uploaded. Please select one.",
		'plugin_installer:upload:error' => "Error while installing new package",
		'plugin_installer:upload:error:nomanifest' => "Package didn't contain a manifest file",
		'plugin_installer:upload:error:nostart' => "Package didn't contain a start file",
		'plugin_installer:upload:error:unzip' => "Error while unzipping package",
		'plugin_installer:upload:error:pluginexists' => "Plugin already exists and you didn't allow an overwrite",
	
		// uninstall
		'plugin_installer:uninstall:noplugin' => "Error uninstalling. No plugin selected.",
		'plugin_installer:uninstall:error' => "Error uninstalling. Failed to remove plugin. Probably you don't have sufficient rights.",
		'plugin_installer:uninstall:success' => "Plugin succesful removed.",
		
		// export
		'plugin_installer:export:error' => "Error exporting. Zip-file can't be created.",
		'plugin_installer:export:noplugin' => "Error exporting. No plugin selected.",
		
		
		// plugin_admin
		'plugin_installer:plugin_admin:plugin' => "Plugin",
		'plugin_installer:plugin_admin:reactivate' => "Re-activate",
		'plugin_installer:plugin_admin:reactivate:yes' => "Plugin %s succesfully re-enabled.",
		'plugin_installer:plugin_admin:reactivate:no' => "Plugin %s unsuccesfully re-enabled.",
		
		'plugin_installer:plugin_admin:show' => "Show inactive plugins",
		
		
	);
	
	add_translation("en", $english);
?>