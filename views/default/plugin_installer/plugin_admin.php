<?php
	/**
	* Plugin Installer
	* 
	* @package plugin_installer
	* @author ColdTrick IT Solutions
	* @copyright Coldtrick IT Solutions 2009
	* @link http://www.coldtrick.com/
	*/
	$ts = time();
	$token = generate_action_token($ts);
	
	$plugins = $vars['installed_plugins'];
	ksort($plugins);
	foreach($plugins as $pluginname => $plugindata){
		if($plugindata['active'] == 1){
			$class = "plugin_active";
		} else {
			$class = "plugin_inactive";
		}
		$options .= "<option class='" . $class . "' value='" . $pluginname . "'>" . $pluginname . "</option>";
	}
	
?>
<div class="contentWrapper">
	<table>
		<tr>
			<td><B><?php echo elgg_echo("plugin_installer:plugin_admin:plugin");?></B></td>
			<td>
				<select id="plugin">
					<?php echo $options;?>
				</select> 
			</td>
			<td><input type="submit" value="<?php echo elgg_echo("disable");?>" onclick="deactivatePlugin($('#plugin').val())" style="margin:1px;"></td>
			<td><input type="submit" value="<?php echo elgg_echo("enable");?>" onclick="activatePlugin($('#plugin').val());" style="margin:1px;"></td>
			<td><input type="submit" value="<?php echo elgg_echo("plugin_installer:plugin_admin:reactivate");?>" onclick="reActivatePlugin($('#plugin').val());" style="margin:1px;"></td>
		</tr>
	</table>
	<A href="javascript:showInActive();"><?php echo elgg_echo("plugin_installer:plugin_admin:show");?></A>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("div[class='plugin_details not-active']").hide();
});

function showInActive(){
	$("div[class='plugin_details not-active']").toggle();
}

function activatePlugin(plugin_name){
	$("a[href*='enable?plugin=" + plugin_name + "']").each(function (){
		this.click();
	});
}

function deactivatePlugin(plugin_name){
	$("a[href*='disable?plugin=" + plugin_name + "']").each(function (){
		this.click();
	});
}

function reActivatePlugin(plugin_name){
	document.location.href="<?php echo $CONFIG->wwwroot;?>action/plugin_installer/re_enable?plugin="+ plugin_name +"&__elgg_token=<?php echo $token;?>&__elgg_ts=<?php echo $ts;?>";
}
</script>