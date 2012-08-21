<?php
/**
 * LessCompiler class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version 0.10.0
 */

require(dirname(__FILE__).'/../lib/lessphp/lessc.inc.php');

class LessCompiler extends CApplicationComponent
{
	/**
	 * @var string base path.
	 */
	public $basePath;
	/**
	 * @var array paths to process.
	 */
	public $paths = array();
	/**
	 * @var boolean indicates whether to always compile all files.
	 */
	public $forceCompile = false;
	/**
	 * @var lessc LESS compiler instance.
	 */
	protected $_parser;

	/**
	 * Initializes the component.
	 * @throws CException if the base path does not exist.
	 */
	public function init()
	{
		if (!isset($this->basePath))
			$this->basePath = Yii::getPathOfAlias('webroot');

		if (!file_exists($this->basePath))
			throw new CException(__CLASS__.': Failed to initialize compiler. Base path does not exist!');

		if (!is_dir($this->basePath))
			throw new CException(__CLASS__.': Failed to initialize compiler. Base path is not a directory!');

		$this->_parser = new lessc();

		if ($this->forceCompile || $this->hasChanges())
			$this->compileAll();
	}

	/**
	 * Compiles a LESS file to a CSS file.
	 * @param string $from the path to the source LESS file.
	 * @param string $to the path to the target CSS file.
	 * @throws CException if the compilation fails or the source path does not exist.
	 */
	public function compile($from, $to)
	{
		if (file_exists($from))
		{
			try
			{
				$this->_parser->importDir = dirname($from); // Set the correct context.
				file_put_contents($to, $this->_parser->parse(file_get_contents($from)));
			}
			catch (exception $e)
			{
				throw new CException(__CLASS__.': Failed to compile less file with message: '.$e->getMessage().'.');
			}
		}
		else
			throw new CException(__CLASS__.': Failed to compile less file. Source path does not exist!');
	}

	/**
	 * Compiles all LESS files.
	 */
	protected function compileAll()
	{
		foreach ($this->paths as $lessPath => $cssPath)
		{
			$from = $this->basePath.'/'.$lessPath;
			$to = $this->basePath.'/'.$cssPath;
			$this->compile($from, $to);
		}
	}

	/**
	 * Returns whether any of files configured to be compiled has changed.
	 * @return boolean the result.
	 */
	protected function hasChanges()
	{
		$dirs = array();
		foreach ($this->paths as $source => $destination)
		{
			$compiled = $this->getLastModified($destination);
			if (!isset($lastCompiled) || $compiled < $lastCompiled)
				$lastCompiled = $compiled;

			if (!in_array(dirname($source), $dirs))
				$dirs[] = $source;
		}

		foreach ($dirs as $dir) {
			$modified = $this->getLastModified($dir);
			if (!isset($lastModified) || $modified < $lastModified)
				$lastModified = $modified;
		}

		return isset($lastCompiled) && isset($lastModified) && $lastModified > $lastCompiled;
	}

	/**
	 * Returns the last modified for a specific path.
	 * @param string $path the path.
	 * @return integer the last modified (as a timestamp).
	 */
	protected function getLastModified($path)
	{
		if (!file_exists($path))
			return 0;
		else
		{
			if (is_file($path))
			{
				$stat = stat($path);
				return $stat['mtime'];
			}
			else
			{
				$lastModified = null;

				/** @var Directory $dir */
				$dir = dir($path);
				while ($entry = $dir->read())
				{
					if (strpos($entry, '.') === 0)
						continue;

					$path .= '/'.$entry;

					if (is_dir($path))
						$modified = $this->getLastModified($path);
					else
					{
						$stat = stat($path);
						$modified = $stat['mtime'];
					}

					if (isset($lastModified) || $modified > $lastModified)
						$lastModified = $modified;
				}

				return $lastModified;
			}
		}
	}
}
