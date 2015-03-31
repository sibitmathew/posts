<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class post{
/*
 * Function to filter text for urls
 * 
 */	
	function filter($text){
		$content_array = explode(" ", $text);
		$output = '';
		
		foreach($content_array as $content)
		{
			//starts with http://
			if(substr($content, 0, 7) == "http://")
			$content = '<a href="' . $content . '" target=_blank>' . $content . '</a>';
			
			if(substr($content, 0, 8) == "https://")
			$content = '<a href="' . $content . '" target=_blank>' . $content . '</a>';
			
			//starts with www.
			if(substr($content, 0, 4) == "www.")
			$content = '<a href="http://' . $content . '" target=_blank>' . $content . '</a>';
			
			$output .= " " . $content;
			
		}
		
		$output = trim($output);
		return $output;
	}
	
	
}