<?php
$this->pageTitle = array('JsonGrid', Yii::app()->params['appTitle']);
$this->addMetaProperty('og:title', 'JsonGrid - '.Yii::app()->name);
$this->addMetaProperty('og:type', 'website');
$this->addMetaProperty('og:url', $this->createUrl('json'));
$this->addMetaProperty('og:image', Yii::app()->request->getBaseUrl(true).'/images/bootstrap-avatar_normal.png');
$this->addMetaProperty('og:site_name', Yii::app()->name);
$this->addMetaProperty('og:locale',Yii::app()->fb->locale);
$this->addMetaProperty('fb:app_id', Yii::app()->fb->appID);
?>

<section id="jsongridview">

	<h2>JsonGridView <small>bootstrap.widgets.TbJsonGridView</small></h2>

	<p class="alert alert-block alert-info">Please note that this grid still under development. Nevertheless, this grid has been tested against a table of 5000 records with excellent results.</p>

	<p>The TbJsonGridView allows the use of localStorage (degrades to in-memory cache for non-HTML5 browsers) for caching results and avoid the use of repetitive ajax requests.</p>

	<p>To use it is like when you use any CGridView with a couple of extra configuration parameters (ie cache):</p>

	<?php echo $parser->safeTransform("~~~
[php]
\$this->widget('bootstrap.widgets.TbJsonGridView', array(
	'dataProvider' => \$model->search(),
	'filter' => \$model,
	'type' => 'striped bordered condensed',
	'summaryText' => false,
	'selectionChanged' => 'function(id){ console.log(  $(\"#\" + id).yiiJsonGridView(\"getSelection\")); }',
	'cacheTTL' => 10, // cache will be stored 10 seconds (see cacheTTLType)
	'cacheTTLType' => 's', // type can be of seconds, minutes or hours
	'columns' => array(
		array(
			'name' => 'name',
			'headerHtmlOptions' => array('class' => 'span4'),
			'type'=>'raw',
			// not that I have to, this is to prove that the grid supports regular use of CGridView features
			'value' => 'CHtml::link(\$data->name,\"#\",array(\"rel\"=>\"popover\",\"data-title\"=>\$data->name))'
		),
		array(
			'name' => 'create_time',
			'type' => 'datetime'
		),
		/* this is a special column that we can use to display content on a dropdown box */
		array(
			'class' => 'bootstrap.widgets.TbJsonPickerColumn',
			'name'=>'country_code',
			'pickerOptions' => array(
				'title' => 'My Title',
				'width' => '400px',
				'content' => 'js:function(){
						$.ajax({
							url: \"'.\$this->createUrl('site/yiiGrid').'\",
							success: function(r) {
								$(\".picker-content > *\").html(r);
							}
						});
						return \"<span id=\\\"picker-ajax-html\\\"><img src=\\\"http://www.flexvuefilms.com/img/loading.gif\\\"/></span>\";
					}'
			),
		),
		array(
			'header' => Yii::t('ses', 'Edit'),
			'class' => 'bootstrap.widgets.TbJsonButtonColumn',
			'template' => '{view} {delete}',
		),
	),
	));
~~~"); ?>

	<p>
		And that's it! Just like any CGridView. By the way, if you wish to work like a regular CGridView just set its ajaxUpdate to false.
	</p>

</section>
