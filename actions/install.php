<?php
	/**
	* Plugin Installer - installer
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	
	// Make sure action is secure
	admin_gatekeeper();
	action_gatekeeper();

	$package = get_uploaded_file('module_package');
	$overwrite = get_input('overwrite', false);
	
	if($package){
		
		global $CONFIG;
		$filename = time() . $_FILES['module_package']['name'];
		
		$filehandler = new ElggFile();
		$filehandler->setFilename($filename);
		$filehandler->open("write");
		$filehandler->write($package);
		
		$zip = new ZipArchive();
		$res = $zip->open($filehandler->getFilenameOnFilestore());
		
		if ($res === TRUE) { 
			$plugin_name = false;
			$manifest = false;
			$start = false;
			for ($i=0; $i<$zip->numFiles;$i++) {
				$entry = $zip->statIndex($i); 
				if(stristr($entry['name'], "manifest.xml") && substr_count($entry['name'], "/") == 1){
					$manifest = true;
					$plugin_name = str_ireplace("/manifest.xml","",$entry['name']);
				} elseif(stristr($entry['name'], "start.php") && substr_count($entry['name'], "/") == 1){
					$start = true;
				}
			}
			if(!$manifest){
				register_error(elgg_echo('plugin_installer:upload:error:nomanifest'));
			} elseif(!$start){
				register_error(elgg_echo('plugin_installer:upload:error:nostart'));
			} else{
				if(!file_exists($CONFIG->pluginspath . $plugin_name) || $overwrite){
					$extract = $zip->extractTo($CONFIG->pluginspath);
					$zip->close();   
					if($extract === TRUE && file_exists($CONFIG->pluginspath . $plugin_name)){
						disable_plugin($plugin_name); 
						enable_plugin($plugin_name); 
						regenerate_plugin_list();
						system_message(elgg_echo('plugin_installer:upload:success'));
					} else {
						register_error(elgg_echo('plugin_installer:upload:error:unzip'));		
					}
				} else {
					register_error(elgg_echo('plugin_installer:upload:error:pluginexists'));		
				}
			}
		} else {   
			register_error(elgg_echo('plugin_installer:upload:error'));		
		}
		$filehandler->delete();
	} else {
		register_error(elgg_echo('plugin_installer:upload:missing'));		
	}
	
	forward($_SERVER['HTTP_REFERER']);
?>