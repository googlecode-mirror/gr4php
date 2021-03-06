<?php
/**
 * --- GR4PHP (GoodRelations FOR PHP) ---
 * This class creates the SPARQL-Query to search for gr-data
 * 
 * @author	Martin Anding, Stefan Dietrich, Alex Stolz (University of German Armed Forces Munich)
 * 			API is a result of a study project in "GoodRelations" in the year of 2010.
 * 			This work is based on the GoodRelations ontology, developed by Martin Hepp
 * @link    http://purl.org/goodrelations/
 * @license GNU LESSER GENERAL PUBLIC LICENSE
 * @version 1.0
 */
include_once 'gr4php_template.php';
include_once 'gr4php_configuration.php';
include_once 'gr4php_general.php';
include_once 'gr4php_exception.php';

class GR4PHP{
	
	private $endpoint;
	private $timeout;
	private $sparqlQuery;
	private $url;
	private $selectedElements=FALSE;
	
	// Constructor of Class
	public function __construct($endpoint=Configuration::ENDPOINT_URIBURNER,$timeout=10000){
			$this->endpoint=$endpoint;
			$this->timeout=$timeout;	
	} 
	/**
	 *
	 * Wrapper function for creating a SPARQL Query (private function)
	 * @param		string		$functionName String designating the function that is calling the wrapper function
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are:gln,title,country,city (see example 1)
	 * @example example/examples.php 2) $wantedElements=array("street","post")
	 *
	 * @example example/examples.php 1) $inputArray=array("gln"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: gln,street,post,city,country,phone,email,long,lat,openTime,closeTime (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	private function createQuery($functionName, $inputArray, $wantedElements, $mode, $limit, $searchProperties){
		// define variable 
		$sparql="";

		$selectPart = array();
		$customInputValues = array(":lax"=>array(), ":strict"=>array());
		$customOutputValues = array($functionName => array());
		// custom properties to search for
		if(!empty($searchProperties)) {
			foreach($searchProperties as $prop) { // custom prefix binding
				if(in_array(strtok($prop, ":"), array_keys(Configuration::$prefixes))) {
					$var = preg_replace("/:/", "_", $prop);
					$selectPart[] = "?$var"; // Result Form
					$customInputValues[":lax"][$var] = array("?uri $prop ?$var. FILTER(contains(?$var, '","value","')) .");
					$customInputValues[":strict"][$var] = array("?uri $prop '","value","'^^xsd:string.");
					$customOutputValues[$functionName][$var] = "OPTIONAL {?uri $prop ?$var.} "; // OPTIONAL clause
				}
				elseif(strpos($prop, "://")) { // full URIs
				    $var = "custom_".preg_replace("/.*[\/#]/")
					$selectPart[] = "?$var"; // Result Form
					$customInputValues[":lax"][$var] = array("?uri <$prop> ?$var. FILTER(contains(?$var, '","value","')) .");
					$customInputValues[":strict"][$var] = array("?uri <$prop> '","value","'^^xsd:string.");
					$customOutputValues[$functionName][$var] = "OPTIONAL {?uri <$prop> ?$var.} "; // OPTIONAL clause
				}
			}
			GR4PHP_Template::addCustomValues($mode, $functionName, $customInputValues, $customOutputValues);
		}

		///// EXCEPTION-Part: At first check all possible errors

		// 1) check Mode
		$mode=GR4PHP_Exception::checkMode($mode);

		// 2) check Limit
		$limit=GR4PHP_Exception::checkLimit($limit);

		// 3) not empty input array?
		GR4PHP_Exception::isNotEmptyInputArray($inputArray); 

		// 4) all input elments are allowed?
		GR4PHP_Exception::isPossibleInputElementOfFunction($inputArray,$functionName);

		// 5) Control amount of elements and values (equal)
		GR4PHP_Exception::isEqualElementAndValueAmount($inputArray);

		// 6) Control format of input values
		GR4PHP_Exception::isCorrectValueForInputElement($inputArray);

		// 7) Control length of values in input Array 
		GR4PHP_Exception::isCorrectLengthOfValueCausedByWildcardRule($inputArray);

		// 8) Correct length of some gr-values (only in strict mode.)
		if ($mode==Configuration::MODE_STRICT){
			GR4PHP_Exception::correctLengthOfValueInSrictMode($inputArray);
		}
		// 9) Check the SELECT elements (only by using a specific SELECT-part)
		if (is_array($wantedElements)){
			GR4PHP_Exception::isPossibleSelectElementOfFunction($wantedElements,$functionName);
		}

		///// SELECT-Part

		if($functionName == "getLocation") {
			// No error! The query building begins; 
			// default: latitude and longitude of Munich!
			if (empty($inputArray['geo']['distance'])){
				$inputArray['geo']['distance']=100;
			}
			if (empty($inputArray['geo']['lat'])){
				$inputArray['geo']['lat']=11.87455;
			}
			if (empty($inputArray['geo']['long'])){
				$inputArray['geo']['long']=48.13155;
			}
			// get SELECT-part of getOffers
			$selectPartspec=GR4PHP_Template::getSelectPartsByFunction($functionName);
			$selectPartspec2=GR4PHP_Template::getSpecialSelectPartsByFunction($functionName, $inputArray);
			// get SELECT-part (here:general-part)
			$selectPartDefault=GR4PHP_Template::getSelectPartsByFunction("general");
			$selectPartComplete=array_merge($selectPartDefault,$selectPartspec,$selectPartspec2);
		}
		else {
			//get SELECT-Part of function
			$selectPartspec=GR4PHP_Template::getSelectPartsByFunction($functionName);

			// get SELECT-part (here:general-part)
			$selectPartDefault=GR4PHP_Template::getSelectPartsByFunction("general");

			$selectPartComplete=array_merge($selectPartDefault,$selectPartspec);	
		}

		//get only wanted Elements
		if ($wantedElements==FALSE){
			$selectPart=$selectPartComplete;
		}
		else{
			$selectPart=getWantedElements((array)$wantedElements,$selectPartComplete);
			$this->selectedElements=(array)$wantedElements;
		}
		
		$sparql.= "SELECT DISTINCT ".getArray2String($selectPart)." WHERE { ";

		///// WHERE-Part

		$deleteOptionalInput=array();

		// set WHERE-part of query
		//cut the length of certain elements (here: gln)
		$inputArray=isLengthOfElementRight($inputArray);
		foreach ((array)$inputArray as $column => $value){
			$sparql.=GR4PHP_Template::getInputValues($mode,$column,$value);
			if ($mode==Configuration::MODE_LAX){
				$deleteOptionalInput[]=$column;
			}
		}

		if($functionName == "getStore") {
			$sparql.=" {?uri a gr:LocationOfSalesOrServiceProvisioning} UNION {?uri a gr:Location} ";
		}
		else if($functionName == "getCompany") {
			$sparql.=" ?uri a gr:BusinessEntity. ";
		}
		else if($functionName == "getProductModel") {
			$sparql.=" ?uri a gr:ProductOrServiceModel. ";
		}
		else if($functionName == "getOffers") {
			$sparql.=" ?uri a gr:Offering. ";
		}
		else if($functionName == "getOpeningHours") {
			$sparql.= " {?uri a gr:LocationOfSalesOrServiceProvisioning. ?uri gr:hasOpeningHoursSpecification ?time.} UNION {?uri a gr:Location. ?uri gr:hasOpeningHoursSpecification ?time.} ";
		}
		else if($functionName == "getLocation") {
			$sparql.= " {?uri a gr:LocationOfSalesOrServiceProvisioning} UNION {?uri a gr:Location} ";
		}

		///// OPTIONAL-Part
		
		// just attach this OPTIONAL clause, if country, street, ... patterns are not already covered by inputArray processing
		//if(in_array($functionName,array("getStore", "getCompany")) && !array_intersect(array("country","street","post","city"), array_keys($inputArray))) {
		// Thanks to Philipp Feucht and his team for spotting an issue with the above if-clause and providing this bugfix!!
		if(in_array($functionName,array("getStore", "getCompany")) && count(array_intersect(array("country","street","post","city","phone","email"), array_merge(array_keys($inputArray), array_values($wantedElements)))) > 0) {
			$sparql.="OPTIONAL {{?uri vc:ADR ?adr} UNION {?uri vcard:adr ?adr} ";
		}

		// Optional Values
		$outputValues=GR4PHP_Template::getOutputValuesByFunction($functionName);

		foreach((array)$outputValues as $aloneOutput => $output){
			// set OPTIONAL-part
			if (!in_array($aloneOutput, $deleteOptionalInput) && in_array("?".$aloneOutput,$selectPart)){
				if (in_array($aloneOutput, array("openTime","closeTime"))){
					if(!in_array("openNow", array_keys($inputArray))) // else, openTime and closeTime are supposed to be already known
						$sparql.=GR4PHP_Template::getSpecialOutputValues($functionName, $aloneOutput);
				}
				else
					$sparql.=$output;
			}
		}
		
		// close the outer OPTIONAL opened above
		if(in_array($functionName,array("getStore", "getCompany")) && count(array_intersect(array("country","street","post","city","phone","email"), array_merge(array_keys($inputArray), array_values($wantedElements)))) > 0) {
			$sparql.="} ";
		}

		///// LIMIT-Part

		//set LIMIT of query
		$sparql.="} LIMIT ".$limit;
		
		// NAMESPACE PREFIX addition
		GR4PHP_TEMPLATE::appendPrefixes($sparql);

		return self::connectGR4PHP($sparql);
	}
	
	/**
	 *
	 * Return SPARQL Query for gr:LocationOfSalesOrServiceProvisioning
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are:gln,title,country,city (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("street","post")
 	 *
	 * @example example/examples.php 1) $inputArray=array("gln"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: gln,street,post,city,country,phone,email,long,lat,openTime,closeTime (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getStore($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX,$limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getStore", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Return SPARQL Query for gr:BusinessEntity
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are: legalName, title, duns, gln, isicv4, naics (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("street","post")
 	 *
	 * @example example/examples.php 1) $inputArray=array("legalName"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: gln, name, duns, isicv4, naics, street, post, city, country, phone, email, long, lat (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getCompany($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX, $limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getCompany", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Return SPARQL Query for gr:ProductModelInfo
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are: ean13, gtin, title, manufacturer (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("sku","ean13")
 	 *
	 * @example example/examples.php 1) $inputArray=array("ean13"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: sku, ean13, gtin, description, website, manufacturer (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getProductModel($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX, $limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getProductModel", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Return SPARQL Query for gr:ProductModelInfo
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are: ean13, gtin14, title, sku, manufacturer,
	 * validThrough, validFrom, maxPrice, currency, acceptedPaymentMethod, businessFunction, minWarrantyInMonths, eligibleCustomerTypes,
	 * eligibleRegions, availabilityStarts, availabilityAtOrFrom (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("sku","ean13")
 	 *
	 * @example example/examples.php 1) $inputArray=array("ean13"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: ean13, gtin, sku, manufacturer, businessFunction, acceptedPaymentMethod, price, currency,
	 * eligibleRegions, eligibleCustomerTypes, minValue, validFrom, validThrough, description, availableAtOrFrom, availabilityStarts,
	 * availabilityEnds, availableDeliveryMethods, minWarrantyInMonths, paymentCurrency, paymentCurrencyValue, paymentTaxIncluded,
	 * deliveryRegion, deliveryCurrency, deliveryCurrencyValue, deliveryTaxIncluded (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getOffers($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX, $limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getOffers", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Return SPARQL Query for gr:LocationOfSalesOrServiceProvisioning
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are: gln, title (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("openMonday","closeMonday")
 	 *
	 * @example example/examples.php 1) $inputArray=array("gln"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: openMonday, closeMonday, openTuesday, closeTuesday, openWednesday, closeWednesday, openThursday,
	 * closeThursday, openFriday, closeFriday, openSaturday, closeSaturday, openSunday, closeSunday (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sought 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getOpeningHours($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX, $limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getOpeningHours", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Return SPARQL Query for stores near by...
	 * @param 		array  		$inputArray	Array with search elements. Allowed elements are: gln, title (see example 1)
 	 * @example example/examples.php 2) $wantedElements=array("gln","geo")
 	 *
	 * @example example/examples.php 1) $inputArray=array("gln"=>"value1","title"=>"value2")
	 * 
	 * @param 		array  		$wantedElements Which elements should be shown? Default: All elements of the function.
	 * Allowed elements are: gln, geo (see example 2)
	 * @param 		string		$mode  Mode of SPARQL-Query. Options are: 
	 * ":lax"-> At the end of the values of all search elements a wildcard "*" is added to get more results.
	 * ":strict"-> Only the given values of all search elements be sougth 
	 * 
	 * @param 		integer		$limit Result-Limit (Default: 20 --> see configuration.php)
	 *
	 * @param		array 		$searchProperties Properties that can be provided for doing custom property searches on the main conceptual element (denoted by x), e.g. array("foo:bar","foo:prop")
	 *
	 * @return 		string		$sparql	SPARQL Query
	 */
	public function getLocation($inputArray,$wantedElements=FALSE,$mode=Configuration::MODE_LAX, $limit=Configuration::LIMIT, $searchProperties=FALSE){
		return self::createQuery("getLocation", $inputArray, $wantedElements, $mode, $limit, $searchProperties);
	}
	
	/**
	 *
	 * Send Query to endpoint and give result back
	 * @param 		string		$query SPARQL Query
	 * @return 		array		$resultArray Result array
	 */
	private function connectGR4PHP($query){
		$url="";
		$this->sparqlQuery=$query;		
		$url = self::buildURL($query, "json");
		$result = self::httpGet($url);
		$resultArray = (array)self::getResultArray($result);
		$this->url=$url;
		return $resultArray;
	}
	
	/**
	 *
	 * Return URL with SPARQL Query (converted for HTTP GET)
	 * @param 		string		$query SPARQL Query
	 * @param 		string		$result_format Result format(here: json)
	 * @return 		string		$url	Complete URL
	 */
	private function buildURL($query, $result_format){
    	$url="";
		$url .= $this->endpoint."?default-graph-uri=&should-sponge=&query=".str_replace("%26", "&", str_replace("%29", ")", str_replace("%28", "(", str_replace("%7D", "}",str_replace("%7B", "{", str_replace("%3B", ";", str_replace("%26amp%3B", "&", urlencode($query))))))));; // \" to "
    	$url .= "&format=".$result_format;
    	$url .= "&timeout=".$this->timeout;
    	return $url;
	}
	
	/**
	 *
	 * Response of HTTP GET
	 * @param 		string		$url	URL
	 * @return 		string		HTTP GET Response 
	 */
	private function httpGet($url)
	{
    	if (ini_get('allow_url_fopen') == '1') {
    		$result=@file_get_contents($url);
				if (false==$result)
				{
   					echo "<br /><b>Error: Time Out</b><br />";
				} else {
					return file_get_contents($url);
				} 
     	}
     	else {
     		echo "else-teil <br>";
        	$url = parse_url($url);
           	$port = isset($url['port']) ? $url['port'] : 80;
           	$fp = fsockopen($url['host'], $port);
           	if(!$fp) {
               echo "Cannot retrieve $url";
           }
           else {
               // send the necessary headers to get the file
               fwrite($fp, "GET ".$url['path']."?".$url['query']."HTTP/1.0\r\n".
                    "Host:". $url['host']."\r\n".
                    "Accept: application/sparql-results+xml,application/rdf+xml\r\n".
                    "Connection: close\r\n\r\n");

               // retrieve response from server
               $buffer = "";
               while($line = fread($fp, 4096))
               {
                    $buffer .= $line;
               }
               fclose($fp);
                 
               $pos = strpos($buffer,"\r\n\r\n");
               return substr($buffer,$pos);
          }
    	}
	}
	
	/**
	 *
	 * Return result as Array
	 * @param 		string		$httpResult HTTP GET Result
	 * @return 		array		$resultArray Result array
	 */
	private function getResultArray($httpResult){
		$httpResultArray = json_decode($httpResult, true);
		$ra = (array) $httpResultArray["results"]["bindings"];
		
		$resultArray = array();
		foreach($ra as $key => $value) {
			$elemArray = array();
			foreach($value as $subkey => $subvalue)
				$elemArray[$subkey] = $subvalue["value"];
			$resultArray[] = $elemArray;
		}
		return $resultArray;
	}
	
	/**
	 *
	 * Print SPARQL Query String
	 * @return 		string		SPARQL QUERY
	 */
	public function printSparqlQuery(){
		return htmlentities($this->sparqlQuery);
	}
}