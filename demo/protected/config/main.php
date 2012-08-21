<?php

// Set the path of Bootstrap to be the root of the project.
Yii::setPathOfAlias('bootstrap', realpath(dirname(__FILE__).'/../../../'));

$config = array(
	'basePath'=>realpath(dirname(__FILE__).'/..'),
	'name'=>'Yii-Bootstrap',

	'preload'=>array(
		'bootstrap',
		'log',
	),

	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'boot',
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths'=>array('bootstrap.gii'),
		),
	),

	'components'=>array(
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap',
			'responsiveCss'=>true,
		),
		'errorHandler'=>array(
			'errorAction'=>'site/error',
		),
		'fb'=>array(
			'class'=>'ext.facebook.components.FacebookConnect',
			'appID'=>'106265262835735',
			'appNamespace'=>'yii-bootstrap',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'urlSuffix'=>'.html',
			'rules'=>array(
				'index'=>'site/index',
				'setup'=>'site/setup',
			),
		),
		'user'=>array(
			'allowAutoLogin'=>true,
		),
	),

	// Application-level parameters
	'params'=>array(
		'appTitle'=>'Yii-Bootstrap - Bringing together the Yii PHP framework and Twitter\'s Bootstrap',
		'appDescription'=>'Yii-Bootstrap is an extension for Yii that provides a wide range of server-side widgets that allow you to easily use Bootstrap with Yii.',
	),
);

return file_exists(dirname(__FILE__).'/local.php')
		? CMap::mergeArray($config, require('local.php'))
		: $config;
