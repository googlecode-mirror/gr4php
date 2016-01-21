# Introduction #

Page is divided into two parts. First one contains all important system requirements. Please check the requirements before you want to use GR4PHP. Next one is a  list of current limitations, which you can find in GR4PHP.


# System Requirements #

The current release of GR4PHP has the following requirements:
  * location (e.g Appache HTTP Server or IIS) which support php >= 5.2.0

# Limitations of GR4PHP #
Limitations are:
  * Sometimes you don't get results from SPARQL endpoint. The causes of no result are      different. In some cases SPARQL endpoint could have some problems (e.g routine    maintenance) or there aren't results with your specification. Do you have a problem like this. At first check all endpoints (see gr4php\_configuration.php)
  * SPARQL query in GR4PHP use VIRTUOSO specification like bif:contains. If you want to add new endpoints to GR4PHP. Please check the endpoint of supporting of VIRTUOSO specification.
  * To protect the SPARQL endpoint (e.g overloading) set the limit of every query lower than 100 (Default is 20!)