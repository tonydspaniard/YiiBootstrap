<?php
/**
 * FacebookConnect class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package facebook.components
 */

/**
 * Facebook connection application component.
 */
require(dirname(__FILE__) . '/../lib/facebook/src/facebook.php'); // Yii::import() will not work in this case
class FacebookConnect extends CApplicationComponent
{
	/**
	 * @var string Facebook application id.
	 */
	public $appID;
	/**
	 * @var string Facebook application secret.
	 */
	public $appSecret;
	/**
	 * @var string the application namespace.
	 */
	public $appNamespace;
	/**
	 * @var boolean whether file uploads are enabled.
	 */
	public $fileUpload;

	protected $_facebook;

	/**
	 * Initializes this component.
	 */
	public function init()
	{
		$config = array(
			'appId' => $this->appID,
			'secret' => $this->appSecret
		);

		if ($this->fileUpload !== null)
			$config['fileUpload'] = $this->fileUpload;

		$this->_facebook = new Facebook($config);
	}

	/**
	 * Registers an Open Graph action with Facebook.
	 * @param string $action the action to register.
	 * @param array $params the query parameters.
	 */
	public function registerAction($action, $params=array())
	{
		$this->api('me/'.$this->appNamespace.':'.$action, $params);
	}

	/**
	 * Calls the Facebook API.
	 * @param string $query the query to send.
	 * @param array $params the query parameters.
	 * @return array the response.
	 */
	public function api($query, $params=array())
	{
		$data = array();

		if ($params !== array())
			$query .= '?'.http_build_query($params);

		try
		{
			$data = $this->_facebook->api('/'.$query);
		}
		catch (FacebookApiException $e)
		{
		}

		return $data;
	}

	/**
	 * Returns the locale based on the application language.
	 * @return string the locale.
	 */
	public function getLocale()
	{
		$language = Yii::app()->language;

		if ($language !== null)
		{
			$pieces = explode('_', $language);
			if (count($pieces) === 2)
				return $pieces[0].'_'.strtoupper($pieces[1]);
		}

		return 'en_US';
	}

	/**
	 * Returns the Facebook application instance.
	 * @return Facebook the instance.
	 */
	public function getFacebook()
	{
		return $this->_facebook;
	}
}
