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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>

		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css("style");
		echo $this->Html->css("menu");
		//echo $this->Html->css('default.advanced');
		//echo $this->Html->css("dropdown");
		//echo $this->Html->css("default");
	        echo $this->Html->css('jquery-ui-1.8.9.custom');
		//echo $this->Html->css('autocomplete');
		echo $this->Html->script('jquery-1.4.4.min');
		echo $this->Html->script('jquery-ui-1.8.9.custom.min');
		echo $this->Html->script('menu');
		


		echo $scripts_for_layout;
	?>

</head>
<body>
	<div id="container">
		<div id="header">
			
			<h1>
				<?php echo $this->Session->flash('auth');
					echo   $session->flash();
				if ($user = $this->Session->read('Auth.User')) {
					echo "Conectado como: ".$this->Session->read("nombre_de_usuario")." ";
					if($user["group_id"] == 1) echo $html->link("(admin)","/admin/acl");
					echo " | ";
					echo $html->link("salir",array("controller"=>"users","action"=>"logout"));

			}
				?>
			</h1>
			<div id = "title">
				<?php echo $this->Html->link("Sistema de reportes","/");?>
	
			</div>
	<?php
		if ($user = $this->Session->read('Auth.User')) {
		?>

<br><br>
<br>
<div id="nicemenu">
    <ul>
<?php //var_dump($this->Auth->user("role"));?>
        <li><span class="head_menu"><?php echo $this->Html->link("Inicio","/"); ?></span>

        <li><span class="head_menu">Planificación<?php echo $this->Html->image("../css/images/arrow.png",array("width"=>18,"height"=>"15","align"=>"top","class"=>"arrow"));?></span>
            <div class="sub_menu">
			<?php 
				if($user["group_id"]==2){
		        	echo $this->Html->link(__('Agregar planificación', true), array('controller'=>'tworeports', 'action' => 'add'));
					echo $this->Html->link(__('Ver mi planificación', true), array('controller'=>'tworeports', 'action' => 'abiertas'));
				 }
				else{
		            echo $this->Html->link(__('Ver planificación de ingenieros', true), array('controller'=>'tworeports', 'action' => 'index'));
						
	
				}	
			?>		
            </div>
        </li>
        <li><span class="head_menu">Ideas<?php echo $this->Html->image("../css/images/arrow.png",array("width"=>18,"height"=>"15","align"=>"top","class"=>"arrow"));?></span>
             <div class="sub_menu">
<?php 
				if($user["group_id"]==2){
		            echo $this->Html->link(__('Ver ideas de ingenieros', true), array('controller'=>'onereports', 'action' => 'abiertas'));
					echo $this->Html->link(__('Agregar idea', true), array('controller'=>'onereports', 'action' => 'add'));
				 }
				else{
		            echo $this->Html->link(__('Ver ideas de ingenieros', true), array('controller'=>'onereports', 'action' => 'index'));
						
	
				}			
               ?>
            </div>
        </li>

	
        <li><span class="head_menu">Reportes<?php echo $this->Html->image("../css/images/arrow.png",array("width"=>18,"height"=>"15","align"=>"top","class"=>"arrow"));?></span>
            <div class="sub_menu">
                <?php echo $this->Html->link(__('Ver reporte', true), array('controller'=>'reportes', 'action' => 'reporte'));?>
            </div>
        </li>
		<?php if($user["group_id"] == 1 || $user["group_id"] == 3){?>
        <li><span class="head_menu">Gestión de usuarios<?php echo $this->Html->image("../css/images/arrow.png",array("width"=>18,"height"=>"15","align"=>"top","class"=>"arrow"));?></span>
        	<div class="sub_menu">
        		<?php echo $this->Html->link(__('Ver usuarios', true), array('controller'=>'users', 'action' => 'index'));?>
				<?php echo $this->Html->link(__('Agregar usuario', true), array('controller'=>'users', 'action' => 'add'));?>

            </div>
        </li>
		<?php }?>
        <li><span class="head_menu">Datos<?php echo $this->Html->image("../css/images/arrow.png",array("width"=>18,"height"=>"15","align"=>"top","class"=>"arrow"));?></span>
        	<div class="sub_menu">
                <?php echo $this->Html->link(__('Ver emsefors', true), array('controller'=>'emsefors', 'action' => 'index'));?>
			    <?php echo $this->Html->link(__('Agregar emsefor', true), array('controller'=>'emsefors', 'action' => 'add'));?>
			    <?php echo $this->Html->link(__('Ver estados de planificación', true), array('controller'=>'states', 'action' => 'index'), array("class"=>"item_line"));?>
				<?php echo $this->Html->link(__('Agregar estado de planificación', true), array('controller'=>'emsefors', 'action' => 'add'));?>
 				<?php echo $this->Html->link(__('Ver estados de ideas', true), array('controller'=>'ideasstates', 'action' => 'index'), array("class"=>"item_line"));?>
				<?php echo $this->Html->link(__('Agregar estado de ideas', true), array('controller'=>'ideasstates', 'action' => 'add'));?>
 				<?php echo $this->Html->link(__('Ver estados de carta', true), array('controller'=>'cartastates', 'action' => 'index'), array("class"=>"item_line"));?>
				<?php echo $this->Html->link(__('Agregar estado de carta', true), array('controller'=>'cartastates', 'action' => 'add'));?>
				<?php echo $this->Html->link(__('Ver estados de proyecto', true), array('controller'=>'proyectostates', 'action' => 'index'), array("class"=>"item_line"));?>
				<?php echo $this->Html->link(__('Agregar estado de proyecto', true), array('controller'=>'proyectostates', 'action' => 'add'));?>
            </div>
        </li>
    </ul>
</div>


		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer" style="font-size:8px;">
			Realizado por Stephan Rebolledo.		
		</div>
	<?php } //echo $this->element('sql_dump'); ?>
</body>
</html>
