<!doctype html>
<html>
<head prefix="og: http://ogp.me/ns# <?php echo Yii::app()->fb->appNamespace; ?>: http://ogp.me/ns/apps/<?php echo Yii::app()->fb->appNamespace; ?>#">
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead', array(
		'defaultDescription'=>Yii::app()->params['appDescription'],
		'httpEquivs'=>array('Content-Type'=>'text/html; charset=utf-8', 'Content-Language'=>'en-US'),
		'title'=>array('class'=>'ext.seo.widgets.SeoTitle', 'separator'=>' :: '),
	)); ?>
	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico">
	<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/styles.css'); ?>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
<!-- start Mixpanel --><script type="text/javascript">(function(d,c){var a,b,g,e;a=d.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===d.location.protocol?"https:":"http:")+'//api.mixpanel.com/site_media/js/api/mixpanel.2.js';b=d.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b);c._i=[];c.init=function(a,d,f){var b=c;"undefined"!==typeof f?b=c[f]=[]:f="mixpanel";g="disable track track_links track_forms register register_once unregister identify name_tag set_config".split(" ");for(e=0;e<
g.length;e++)(function(a){b[a]=function(){b.push([a].concat(Array.prototype.slice.call(arguments,0)))}})(g[e]);c._i.push([a,d,f])};window.mixpanel=c})(document,[]);
mixpanel.init("733930f08f73894be317b7fdbfd15229");</script><!-- end Mixpanel -->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-29040179-1']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>

<body id="top">

<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : <?php echo Yii::app()->fb->appID; ?>, // App ID
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});

		// Additional initialization code here
	};

	// Load the SDK Asynchronously
	(function(d){
		var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
		js = d.createElement('script'); js.id = id; js.async = true;
		js.src = "//connect.facebook.net/en_US/all.js";
		d.getElementsByTagName('head')[0].appendChild(js);
	}(document));
</script>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
	'type'=>'inverse',
	'brand'=>CHtml::encode(Yii::app()->name),
	'collapse'=>true,
	'items'=>array(
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
				array('label'=>'Demo', 'url'=>Yii::app()->homeUrl,
						'active'=>Yii::app()->controller->id === 'site' && Yii::app()->controller->action->id === 'index'),
				array('label'=>'JsonGrid', 'url'=>array('site/json')),
				array('label'=>'Setup', 'url'=>array('site/setup')),
			),
			'htmlOptions'=>array('class'=>'pull-left'),
		),
		'<div class="add-this pull-right">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style">
			<a class="addthis_button_facebook"></a>
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_google"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_compact"></a>
			<a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<!-- AddThis Button END -->
		</div>',
		array(
			'class'=>'bootstrap.widgets.TbMenu',
			'items'=>array(
				array('label'=>'Bootstrap Docs', 'url'=>'http://twitter.github.com/bootstrap', 'linkOptions'=>array('target'=>'_blank')),
				array('label'=>'Fork me on Bitbucket', 'url'=>'http://www.bitbucket.org/Crisu83/yii-bootstrap', 'linkOptions'=>array('target'=>'_blank')),
				array('label'=>'Follow me on Twitter', 'url'=>'http://www.twitter.com/Crisu83', 'linkOptions'=>array('target'=>'_blank')),
			),
			'htmlOptions'=>array('class'=>'pull-right'),
		),
	),
)); ?>

<div class="container">

	<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit', array(
		'heading'=>Yii::app()->name,
	)); ?>
		<p>
			Bringing together the <?php echo CHtml::link('Yii PHP framework', 'http://www.yiiframework.com'); ?> and
			<?php echo CHtml::link('Twitter Bootstrap', 'http://twitter.github.com/bootstrap/'); ?>.
        </p>
        <p>
			<?php echo CHtml::link('Yii-Bootstrap', 'http://www.yiiframework.com/extension/bootstrap/'); ?>
			is an extension for Yii that provides a wide range of widgets that allow developers to easily use Bootstrap with Yii.
			All widgets have been developed following Yii's conventions and work seamlessly together with Bootstrap and its jQuery plugins.
		</p>
	<?php $this->endWidget(); ?>

	<?php if (!empty($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>

	<?php echo $content; ?>

	<hr />

	<footer>

		<p class="powered">
			Powered by <?php echo CHtml::link('Yii PHP framework', 'http://www.yiiframework.com', array('target'=>'_blank')); ?> /
			<?php echo CHtml::link('jQuery', 'http://www.jquery.com', array('target'=>'_blank')); ?> /
			<?php echo CHtml::link('Yii-Bootstrap', 'http://www.yiiframework.com/extension/bootstrap', array('target'=>'_blank')); ?> /
			<?php echo CHtml::link('Yii-LESS', 'http://www.yiiframework.com/extension/less', array('target'=>'_blank')); ?>  /
			<?php echo CHtml::link('Yii-SEO', 'http://www.yiiframework.com/extension/seo', array('target'=>'_blank')); ?> /
			<?php echo CHtml::link('Yii-Facebook', '#', array('rel'=>'tooltip', 'title'=>'Link available soon')); ?> /
			<?php echo CHtml::link('Bootstrap', 'http://twitter.github.com/bootstrap', array('target'=>'_blank')); ?> /
			<?php echo CHtml::link('LESS', 'http://www.lesscss.org', array('target'=>'_blank')); ?>
		</p>

		<p class="copy">
			&copy; Christoffer Niska <?php echo date('Y'); ?>
		</p>

	</footer>

</div>

<?php Yii::app()->clientScript->registerScriptFile('http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4f362fc83fc39768', CClientScript::POS_END); ?>

</body>
</html>
