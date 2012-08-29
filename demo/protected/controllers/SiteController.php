<?php

class SiteController extends Controller
{
	/**
	 * Declares the behaviors.
	 * @return array the behaviors
	 */
	public function behaviors()
	{
		return array(
			'seo'=>'ext.seo.components.SeoControllerBehavior',
		);
	}

	/**
	 * Declares class-based actions.
	 * @return array the actions
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$model = new TestForm();

		$tabs = array(
			array('label'=>'Home', 'content'=>'<p>Raw denim you probably haven\'t heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>', 'active'=>true),
			array('label'=>'Profile', 'content'=>'<p>Food truck fixie locavore, accusamus mcsweeney\'s marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>'),
			array('label'=>'Dropdown', 'items'=>array(
				array('label'=>'@fat', 'content'=>'<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney\'s organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven\'t heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>'),
				array('label'=>'@mdo', 'content'=>'<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>'),
			)),
		);

		$tabbable = array(
			array('label'=>'Section 1', 'content'=>'<p>I\'m in Section 1.</p>', 'active'=>true),
			array('label'=>'Section 2', 'content'=>'<p>Howdy, I\'m in Section 2.</p>'),
			array('label'=>'Section 3', 'content'=>'<p>What up girl, this is Section 3.</p>'),
		);

		$mark = new Person();
		$mark->id = 1;
		$mark->firstName = 'Mark';
		$mark->lastName = 'Otto';
		$mark->language = 'CSS';

		$jacob = new Person();
		$jacob->id = 2;
		$jacob->firstName = 'Jacob';
		$jacob->lastName = 'Thornton';
		$jacob->language = 'JavaScript';

		$stu = new Person();
		$stu->id = 3;
		$stu->firstName = 'Stu';
		$stu->lastName = 'Dent';
		$stu->language = 'HTML';

		$persons = array($mark, $jacob, $stu);

		$gridDataProvider = new CArrayDataProvider($persons);

		$gridColumns = array(
			array('name'=>'id', 'header'=>'#', 'htmlOptions'=>array('style'=>'width: 60px')),
			array('name'=>'firstName', 'header'=>'First name'),
			array('name'=>'lastName', 'header'=>'Last name'),
			array('name'=>'language', 'header'=>'Language'),
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'viewButtonUrl'=>null,
				'updateButtonUrl'=>null,
				'deleteButtonUrl'=>null,
			)
		);

		$rawData = array();
		for ($i = 0; $i < 8; $i++)
			$rawData[] = array('id'=>$i + 1);

		$listDataProvider = new CArrayDataProvider($rawData);

		$phpLighter = new CTextHighlighter();
		$phpLighter->language = 'PHP';

		$jsLighter = new CTextHighlighter();
		$jsLighter->language = 'JAVASCRIPT';

		$htmlLighter = new CTextHighlighter();
		$htmlLighter->language = 'HTML';

		$this->render('index', array(
			'model'=>$model,
			'person'=>new Person(),
			'tabs'=>$tabs,
			'tabbable'=>$tabbable,
			'gridDataProvider'=>$gridDataProvider,
			'gridColumns'=>$gridColumns,
			'listDataProvider'=>$listDataProvider,
			'phpLighter'=>$phpLighter,
			'jsLighter'=>$jsLighter,
			'htmlLighter'=>$htmlLighter,
		));
	}

	public function actionSetup()
	{
		$parser = new CMarkdownParser();
		Yii::app()->clientScript->registerCss('TextHighligther', file_get_contents($parser->getDefaultCssFile()));

		$this->render('setup', array(
			'parser'=>$parser,
		));
	}

	public function actionJson()
	{
		$parser = new CMarkdownParser();
		Yii::app()->clientScript->registerCss('TextHighligther', file_get_contents($parser->getDefaultCssFile()));

		$this->render('json', array(
			'parser'=>$parser,
		));
	}
	public function actionMaintenance()
	{
		$this->layout = '/layouts/maintenance';
		$this->render('maintenance');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

    public function getTabularFormTabs($form, $model)
    {
        $tabs = array();
        $count = 0;

        foreach (array('en'=>'English', 'fi'=>'Finnish', 'sv'=>'Swedish') as $locale => $language)
        {
            $tabs[] = array(
                'active'=>$count++ === 0,
                'label'=>$language,
                'content'=>$this->renderPartial('_tabular', array(
                    'form'=>$form,
                    'model'=>$model,
                    'locale'=>$locale,
                    'language'=>$language,
                ), true),
            );
        }

        return $tabs;
    }
}
