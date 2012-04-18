<?php
	/**
	* Plugin Installer
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	$bodyInstall .= elgg_view("input/file",array("internalname"=>"module_package")) . "<br />";
	$bodyInstall .= elgg_view("input/checkboxes",array("internalname"=>"overwrite", "options"=>array(elgg_echo("plugin_installer:upload:overwrite")=>"overwrite"))) . "<br />";
	$bodyInstall .= elgg_view("input/submit",array("internalname"=>"submitButtonInstall", "value"=>elgg_echo("plugin_installer:upload")));
	$formInstall = elgg_view("input/form",array('body' => $bodyInstall,'method' => 'post', 'enctype' => 'multipart/form-data' ,'action' => $vars['url'] . "action/plugin_installer/install"));
	
	$plugins = get_installed_plugins();
	ksort($plugins);
	foreach($plugins as $pluginname => $plugindata){
		$pluginOptions .= "<option value='" . $pluginname . "'>" . $pluginname . "</option>";
	}
	
	$bodyUnInstall .= "<select name='plugin'>". $pluginOptions . "</select> ";
	$bodyUnInstall .= elgg_view("input/submit",array("internalname"=>"submitButtonUninstall", "value"=>elgg_echo("plugin_installer:uninstall")));
	$formUnInstall = elgg_view("input/form",array('body' => $bodyUnInstall,'method' => 'post', 'action' => $vars['url'] . "action/plugin_installer/uninstall"));
	
	$bodyExport .= "<select name='plugin'>". $pluginOptions . "</select> ";
	$bodyExport .= elgg_view("input/submit",array("internalname"=>"submitButtonExport", "value"=>elgg_echo("plugin_installer:export")));
	$formExport = elgg_view("input/form",array('body' => $bodyExport,'method' => 'post', 'action' => $vars['url'] . "action/plugin_installer/export"));
	
?>
<div class="contentWrapper">
<?php
	echo "<h3 class='settings'>" . elgg_echo("plugin_installer:install") . "</h3>";
	echo $formInstall;
	echo "<h3 class='settings'>" . elgg_echo("plugin_installer:uninstall") . "</h3>";
	echo $formUnInstall;
	echo "<h3 class='settings'>" . elgg_echo("plugin_installer:export") . "</h3>";
	echo $formExport;
?>
</div>