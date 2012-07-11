<?php
echo $form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
?>
<div id="box">
	<div id="leftside">
		<div id="login-title">
			Sistema de reportes
		</div>
	</div>
	<div id="rightside">
		<?php
			echo $form->input('User.username',array("label"=>"Nombre de usuario"));
			echo $form->input('User.password',array("label"=>"Clave"));
			echo $form->end('Iniciar sesión');
		?>	
	</div>
</div>
