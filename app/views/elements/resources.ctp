<?php
// Inserts appropiate CSS and scripts links on layouts.
// $type : Type of the resource list to add ('css' or 'script')
// $files : The resource filenames of given $type (relative to APP_WEBROOT_DIR/{css|js})

// Configure folder and file extension
switch( $type ) {
	case 'css':
		$folder = 'css'; $extension = '.css';
		break;
	case 'script':
		$folder = 'js'; $extension = '.js';
		break;
}

// Insert web resource files
foreach( $files as $file )
	if( is_readable( APP.WEBROOT_DIR.DS.$folder.DS.$file.$extension ) )
		echo $this->Html->$type( $file ) . PHP_EOL;
