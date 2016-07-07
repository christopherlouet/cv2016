<?php

namespace AppBundle\Parser;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Translation\Exception\InvalidResourceException;

/**
 * @author Christopher LOUËT.
 *
 */
class JsonParser implements ParserInterface {
	
	protected $root;
	
	public function __construct($root)
	{
		$this->root = $root;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \BimeoBundle\Parser\ParserInterface::getExtension()
	 */
	public function getExtension() {
		return "json";
	}
	
	/**
	 * Convert json file to array.
	 * 
	 * @param string $path
	 * @param string $name
	 * @throws InvalidResourceException
	 * @return mixed
	 */
	public function toArray($path,$name)
	{
		$datas = array();
		$locator = new FileLocator(array($path));
		$json = $locator->locate($name, null, true);
	
		$dataSet = array();
		if ($data = file_get_contents($json))
		{
			$dataSet = json_decode($data, true);
			if (0 < $errorCode = json_last_error()) {
				throw new InvalidResourceException(sprintf('Error parsing JSON - %s', $this->getJSONErrorMessage($errorCode)));
			}
			$datas = $dataSet[$this->root];
		}
	
		return $datas;
	}
	
	/**
	 * JSON Error messages.
	 * 
	 * @param int $errorCode
	 * @return string
	 */
	private function getJSONErrorMessage($errorCode)
	{
		switch ($errorCode) {
			case JSON_ERROR_DEPTH:
				return 'Maximum stack depth exceeded';
			case JSON_ERROR_STATE_MISMATCH:
				return 'Underflow or the modes mismatch';
			case JSON_ERROR_CTRL_CHAR:
				return 'Unexpected control character found';
			case JSON_ERROR_SYNTAX:
				return 'Syntax error, malformed JSON';
			case JSON_ERROR_UTF8:
				return 'Malformed UTF-8 characters, possibly incorrectly encoded';
			default:
				return 'Unknown error';
		}
	}
}