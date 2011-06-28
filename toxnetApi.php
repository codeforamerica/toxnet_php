<?php

class toxnetApi extends APIBaseClass{

	public static $api_url = 'http://toxgate.nlm.nih.gov';
	// Modded to do json by default ... even though default output is html, for developers this isn't so helpful	
	public function __construct($url=NULL)
	{
		parent::new_request(($url?$url:self::$api_url));
	}
	// this is an array with the available valid db options
	public static $base_options = array('db'=> array('hsdb','ccris','genetox','iris','iter','lact'));
	
	private function filter_params($params,$args){
	// abstracts the method calls to turn most method arguments into query parameters, provided an array with
	// the names of the keys in (data) correspondence to the method call order
		foreach($args as $loc => $arg)
			$data[$params[$loc]] = $arg;
		return $data;	
	}

	public function chemical_search($db,$keyword,$Stemming=null,$and=1,$chemsyn=1,$second_search=1,$gateway=1){
	// for long queries use HTTP POST
	
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
	
		if(in_array(strtolower($db),self::$base_options['db'])){
			// spaces replaced with '+' signs, special char replaced with % and ASCII code		
			$keyword = str_replace(' ','+',trim($keyword));
			$data = self::filter_params(array('db','keyword','Stemming','and','chemsyn','second_search','gateway'),func_get_args());
			return ($data?self::_request(self::$api_url.'/cgi-bin/sis/search', 'get',array_filter($data)):false);
		}
	
		else
			return false;
		}
	
	
	public function sub_requests($TemporaryFile,$n=0){
	/*
	
		Handles Subsequent Requests given a temporary file See below for more info
		
		http://toxgate.nlm.nih.gov/cgi-bin/sis/search/g?./temp/~zatH9T:20
		
		TemporaryFile 	The unique identifier returned in the initial search tag <TemporaryFile> which refers to the current search.
		n 				n indicates to start at the (n+1)th record and display the following 20 records. Note: n starts at 0.
		
	*/
	
		return self::_request(self::$api_url."/cgi-bin/sis/search/g?$TemporaryFile:$n");
	}
	
	
	public function full_chemical_record($db,$DOCNO){
	/*
		Request a full record in chemical databases
	
		This Web Service API provides full chemical records only in HTML format.
		db		Valid db
		DOCNO 	The record DOCNO.
	
	*/
		return (in_array(strtolower($db),self::$base_options['db'])? _request(self::$api_url."/cgi-bin/sis/search/r?dbs+$db:@term+@DOCNO+$DOCNO"): false);
	}
	

}