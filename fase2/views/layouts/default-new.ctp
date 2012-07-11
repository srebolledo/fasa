<?php
/*
  default.thtml design for CakePHP (http://www.cakephp.org)
  ported from http://contenteddesigns.com/ (open source template)
  ported by Shunro Dozono (dozono :@nospam@: gmail.com)
  2006/7/6
*/
		$usuario = $this->Session->read("Auth.User");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CakePHP : The PHP Rapid Development Framework :: <?php echo $title_for_layout?></title>
<?php echo $html->charset('UTF-8')?>
<meta name="description" content="Website description" />
<meta name="keywords" content="keyword1,keyword2,keyword2,keyword4" />
<?php echo $html->css('cake.forms', 'stylesheet', array("media"=>"all" ));?>
<?php echo $html->css('contented1', 'stylesheet', array("media"=>"all" ));?>
</head>
<body>
<div id="header">

<div id="title">Sistema de reportes</div>

<div id="contact"><a href="#">CONTACT US</a></div>

<div id="slogan">Contented: How a content-filled design feels</div>

</div>

<div id="nav">
	<?php echo $this->Html->link(__('Agregar planificación', true), array('controller'=>'tworeports', 'action' => 'add'));?>
	<?php echo $this->Html->link(__('Agregar idea', true), array('controller'=>'onereports', 'action' => 'add'));?>
	<?php echo $this->Html->link(__('Ver mi planificación', true), array('controller' => 'tworeports', 'action' => 'abiertas')); ?>
	<?php
			if($usuario["group_id"] == 1){

		?>
		<li><?php echo $this->Html->link(__('Reportes', true), array('controller' => 'reportes', 'action' => 'reporte')); ?> </li>
	
	
		<?php
			}
			
		?>
</div>

<div id="content">
<div id="maincontent">
<?php echo $this->Session->flash(); ?>
<?php echo $content_for_layout?>



<ul>
<li>Internet Explorer 6.0.2900.2180</li>
<li>Firefox 1.5.0.2</li>
<li>Opera 8.53</li>
</ul>

<p>
Current version: Contented1 Version 1.02 (May 17, 2006)
</p>
		  
<h1>Using this Design</h1>

<p>
Contented1 is an open source template. You're free to modify it and
use it for any purpose without cost or obligation. We
prefer that you leave the link to our website  in the
footer but it's not required.
</p>

<p>
If you have comments or questions, please contact us at <a
href="http://www.contenteddesigns.com">Contented Designs</a>.  Thanks!
</p>

</div>

<div id="sidecontent">

<h1>News</h1> Use this sidebar for recent news, press releases,
upcoming events, notes.

<p>
<a href="#">This is a link to a page describing a news item.</a> (2006-04-02)
</p>

<p>
<a href="#">This is a link to a page describing a news item.</a> (2006-04-01)
</p>

<p>
<a href="#">This is a link to a page describing a news item.</a> (2006-03-22)
</p>

<p>
<a href="#">This is a link to a page describing a news item.</a> (2006-03-17)
</p>

</div>
</div>

<div id="footer">

<div id="copyrightdesign">
Copyright &copy; 2006 Your Name |
Design by <a href="http://ContentedDesigns.com">Contented Designs</a>
</div>

<div id="footercontact">
<a href="#">Contact Us</a>
</div>

</div>

<p>
 CakePHP : <a href="http://www.cakefoundation.org/pages/copyright/">&copy; 2006 Cake Software Foundation, Inc.</a>
</p>
<a href="http://www.w3c.org/" target="_new">
 <?php echo $html->image('w3c_css.png', array('alt'=>"valid css", 'border'=>"0"))?>
</a>
<a href="http://www.w3c.org/" target="_new">
 <?php echo $html->image('w3c_xhtml10.png', array('alt'=>"valid xhtml", 'border'=>"0"))?>
</a>
<a href="http://www.cakephp.org/" target="_new">
 <?php echo $html->image('cake.power.png', array('alt'=>"CakePHP : Rapid Development Framework", 'border'=>"0"))?>
</a>

<?php echo $cakeDebug;?>
</body>
</html>
