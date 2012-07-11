<?php
// Shows a vertical collapsible menu with clickable options.
// $name : The menu unique name
// $content : The content of the menu (see /config/menus.php for more info)
?>
<ul id="menu_<?php echo $name; ?>" class="menu collapsible">
<?php foreach( $content as $item_name => $item_content ) { ?>
	<?php if( is_array($item_content) ) { ?>

	<?php $expand=false; 
		$pattern = '/^\/'.$this->params['controller'].'/i';
		foreach($item_content as $content_target) {
			if(preg_match($pattern, $content_target )) $expand = true;
		}

		if($expand) echo "<li class=\"expand\">";
		else echo "<li>"
	?>
	
	<?php echo $html->link( $item_name, '#' ); ?><ul class="acitem">
		<?php foreach( $item_content as $content_name => $content_target ) { ?>
		<li><?php echo $html->link( $content_name, $content_target ); ?></li>
		<?php } ?>
	</ul></li>
	<?php } else { ?>
	<li><?php echo $html->link( $item_name, $item_content ); ?></li>
	<?php } ?>
<?php } ?>
</ul>

