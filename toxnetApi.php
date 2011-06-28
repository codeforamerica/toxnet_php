<?php

class toxnetApi extends APIBaseClass{

	public static $api_url = 'http://toxgate.nlm.nih.gov/cgi-bin/sis/search/';
	// Modded to do json by default ... even though default output is html, for developers this isn't so helpful	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	
	public static $base_options array(
		'db'=> array('hsdb','ccris','genetox','iris','iter','lact')
	);
	
	public function chemical_search_get($db,$keyword){
	// spaces replaced with '+' signs, special char replaced with % and ASCII code
	// for long queries use HTTP POST
	
	}

	public function chemical_search_post($queryxxx,$chemsyn=1,$db,$stemming=NULL){
	
	/*
	queryxxx 	Keyword.
	chemsyn 	Must be 1 to turn on query expansion with chemical synonyms and CAS Registry Number.
	database 	Database to search.
	Valid database names are hsdb, ccris, genetox, iris, iter, and lact. Please note that the database name must be in lowercase.
	Stemming 	Must be 1 to turn on stemming.
	and 	Must be 1.
	second_search 	Must be 1.
	gateway 	Must be 1.

	*/
	
	}

	
}