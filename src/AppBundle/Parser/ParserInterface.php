<?php

namespace AppBundle\Parser;

/**
 * @author Christopher LOUËT.
 *
 */
interface ParserInterface {
	
	/**
	 * Get file extension.
	 */
	public function getExtension();
	
	/**
	 * Convert file to array.
	 * 
	 * @param string $path
	 * @param string $name
	 */
	public function toArray($path,$name);
	
}