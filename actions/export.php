<?php
	/**
	* Plugin Installer - export
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
	$plugin_folder = $CONFIG->pluginspath . $plugin_name . "/";
	
	if($plugin_name && file_exists($plugin_folder)){
		
		$filename = "export_" . $plugin_name . ".zip";
		
		$filehandler = new ElggFile();
		$filehandler->setFilename($filename);
		
		$destination = $filehandler->getFilenameOnFilestore();
		
		$zip = new ZipArchive();
		$res = $zip->open($destination, ZipArchive::CREATE);
		if ($res === TRUE) {
			addFolderToZip($plugin_folder, $zip, $plugin_name . "/");
			$zip->close();
			$zipData = $filehandler->grabFile();
			
			$filehandler->delete();
			
			header('Content-type: application/zip');
			header('Content-Disposition: filename="' . $filename . '"');

			echo $zipData;
			
		} else {   
			die(elgg_echo('plugin_installer:export:error'));		
		}
	} else {
		die(elgg_echo('plugin_installer:export:noplugin'));		
	}
	exit();
	
	// Function to recursively add a directory,
	// sub-directories and files to a zip archive
	function addFolderToZip($dir, $zipArchive, $zipdir = ''){
		
		if (is_dir($dir)) {
			if ($dh = opendir($dir)) {

				// Loop through all the files
				while (($file = readdir($dh)) !== false) {
					
					//If it's a folder, run the function again!
					if(!is_file($dir . $file)){
						// Skip parent and root directories
						if( ($file !== ".") && ($file !== "..")){
							addFolderToZip($dir . $file . "/", $zipArchive, $zipdir . $file . "/");
						}
					   
					}else{
						// Add the files
						$zipArchive->addFile($dir . $file, $zipdir . $file);
					   
					}
				}
			}
		}
	}
?>