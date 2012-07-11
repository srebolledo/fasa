<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
//get and set the name of the user_id
  		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>

		<?php echo $title_for_layout; ?>
	</title>
	<?php
		// Link to CSS and scripts files
		echo $this->element( 'resources', array(
			'type' => 'css', 'files' => $css_for_layout
		) );
		
		echo $this->element( 'resources', array(
			'type' => 'script', 'files' => $js_for_layout
		) );
	?>
	<link rel="stylesheet" type="text/css" href="/fasa/css/impresion.css"  media= "print" />
	
</head>
<body>

		<div id="header">
				<h1 class="infoUsuario">
					<?php echo $this->Session->flash('auth');
						echo   $session->flash();
					if ($user = $this->Session->read('Auth.User')) {
						echo "Conectado como: ".$html->link($this->Session->read("nombre_de_usuario"),array('controller'=>'users','action'=>'editar_info'))." ";
						if($user["group_id"] == 1) echo $html->link("(admin)","/admin/acl");
						echo " | ";
					
						echo $html->link("salir",array("controller"=>"users","action"=>"logout"));
				}
					?>
				</h1>
				
		</div>

		<div id="contenido">
			<div id="menu">
				<?php
					echo $this->element('menu', array(
					'name' => 'main',
					'content' => $menus['main'],
				));?>
			</div>
			<div id="headContent">
				<?php 
					$titulo = explode('|',$title_for_layout);
					echo $titulo[1];
					
				?>
			</div>
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		<div id="footer" style="font-size:8px;">
			Realizado por Stephan Rebolledo.		
		</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
