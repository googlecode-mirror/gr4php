# Introduction #

Below you find important information about how you can configure and set up GR4PHP for your projects:

### 1. Download code ###

Download the latest version of GR4PHP and upload it into the project folder on your Web server.

### 2. Insert code ###

#### 2.1 Basic example ####

Insert the following code into a PHP file, where you want to use GR4PHP.

```
// Requirements: the following include tag
// In this case the API is in the same folder like GR4PHP.
// Information about using of include tags. See PHP manual. 
include_once 'gr4php.php';

// first instruction: Instantiation of GR4PHP-Class
$connection = new GR4PHP(Configuration::ENDPOINT_URIBURNER);

// second instruction: Select function, input array, wanted elements, mode and limt
// Here: Result of function is shown on display (print_r). 
// Before you show the result on display you can edit the result.   
print_r($connection->getStore(array("title"=>"Team EWS Ingenieure"),FALSE,":lax",30));
```

#### 2.2 On how to deal with custom properties ####

If you need to, you can search for object values of custom properties/predicates as well. The following code snippet provides an example on how to do this.

```
include_once 'gr4php.php';

// add custom namespace prefix bindings
Configuration::bindPrefix("media","http://search.yahoo.com/searchmonkey/media/");
Configuration::bindPrefix("commerce","http://search.yahoo.com/searchmonkey/commerce/");

// debug - print registered prefixes
print_r(Configuration::$prefixes);

$connection = new GR4PHP(Configuration::ENDPOINT_URIBURNER);

// note the difference to the basic example above: an additional function parameter is used to pass the array of custom properties
// -> have to be attached directly to the BE/company in order to be found in this example
// variables will be set to ?media_image and ?commerce_hoursOfOperation
print_r($connection->getCompany(array("legalName"=>"EWS Ingenieure"),array("uri", "title"),":lax",30,array("media:image","commerce:hoursOfOperation")));

// debug - print sparql query string
echo $connection->printSparqlQuery();
```

### 3. Information about GR4PHP functions ###

For more information on how you can employ the different GR4PHP functions with their input and output parameters, so take a look at the [Function Tutorial](http://code.google.com/p/gr4php/wiki/Function_Tutorial) wiki page. We also highly recommend to take a closer look into the [GR4PHP documentation](http://www.ebusiness-unibw.org/tools/gr4php/doc/).