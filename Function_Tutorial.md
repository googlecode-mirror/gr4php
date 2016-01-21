# Introduction #
GR4PHP provides six different PHP functions for consuming [GoodRelations](http://purl.org/goodrelations/) data from a known SPARQL endpoint. Each function can be called with four input parameters:
  * **inputArray** (MANDATORY): Contains all your search parameters, e.g. EAN.
  * **wantedElements** (OPTIONAL): By this you can choose which elements you would like to get back. This array is optional. If you don't use it you will get all possible results by default. <u>Attention</u>: This way take much longer time!
  * **Mode** (OPTIONAL): Mode of SPARQL-Query divides into two options:
    * ":lax": At the end of the values of all search elements a wildcard "`*`" is added to get more results.
    * ":strict": Only the given values of all search elements be sougth
  * **Limit** (OPTIONAL): Contains a number for how many result objects you like to have. The default value is 20, e.g. 20 offers for a specific EAN.
  * **searchProperties** (OPTIONAL): User-defined properties to be searched for on a conceptual entity. For more details cf. section 2.2 in our [Quickstart Guide](http://code.google.com/p/gr4php/wiki/Quickstart_Guide).

This site includes descriptions and examples for the follow functions:
  * [getCompany](#getCompany.md)
  * [getLocation](#getLocation.md)
  * [getOffers](#getOffers.md)
  * [getOpeningHours](#getOpeningHours.md)
  * [getProductModel](#getProductModel.md)
  * [getStore](#getStore.md)



&lt;hr /&gt;




# getCompany #
([back to top](#Introduction.md))

### Description ###

<blockquote>Return information for GoodRelation BusinessEntity.</blockquote>

### Function call ###
<blockquote><code>string getCompany( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code></blockquote>

### Parameter ###
  * **inputArray**:
| **Parameter** | **Example** | **Specification** |
|:--------------|:------------|:------------------|
| legalName     |             | [http://www.heppnetz.de/ontologies/goodrelations/v1.html#legalName](http://www.heppnetz.de/ontologies/goodrelations/v1.html#legalName)|
| title         | BestBuy Co., Inc. | [http://www.w3.org/2000/01/rdf-schema#comment](http://www.w3.org/2000/01/rdf-schema#comment) <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> <br>
<tr><td> duns          </td><td>             </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasDUNS'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasDUNS</a> </td></tr>
<tr><td> gln           </td><td>             </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> isicv4        </td><td>             </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasISICv4'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasISICv4</a> </td></tr>
<tr><td> naics         </td><td>             </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasNAICS'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasNAICS</a> </td></tr></li></ul>

  * **wantedElements**:
| **Parameter** | **Example** | **Specification** |
|:--------------|:------------|:------------------|
| duns          |             | [http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasDUNS](http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasDUNS) |
| gln           |             | [http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber](http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber) |
| isicv4        |             | [http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasISICv4](http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasISICv4) |
| naics         |             | [http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasNAICS](http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasNAICS) |
| street        |             | [http://www.w3.org/2001/vcard-rdf/3.0#Street](http://www.w3.org/2001/vcard-rdf/3.0#Street)<br> <a href='http://www.w3.org/2006/vcard/ns#street-address'>http://www.w3.org/2006/vcard/ns#street-address</a> <br>
<tr><td> post          </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Pobox'>http://www.w3.org/2001/vcard-rdf/3.0#Pcode</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Postal'>http://www.w3.org/2006/vcard/ns#Postal</a> </td></tr>
<tr><td> city          </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Locality'>http://www.w3.org/2001/vcard-rdf/3.0#Locality</a> <br> <a href='http://www.w3.org/2006/vcard/ns#locality'>http://www.w3.org/2006/vcard/ns#locality</a> </td></tr>
<tr><td> country       </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Country'>http://www.w3.org/2001/vcard-rdf/3.0#Country</a> <br> <a href='http://www.w3.org/2006/vcard/ns#country-name'>http://www.w3.org/2006/vcard/ns#country-name</a> </td></tr>
<tr><td> phone         </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#TEL'>http://www.w3.org/2001/vcard-rdf/3.0#TEL</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Tel'>http://www.w3.org/2006/vcard/ns#Tel</a> </td></tr>
<tr><td> email         </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#EMAIL'>http://www.w3.org/2001/vcard-rdf/3.0#EMAIL</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Email'>http://www.w3.org/2006/vcard/ns#Email</a> </td></tr>
<tr><td> long          </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#longitude'>http://www.w3.org/2001/vcard-rdf/3.0#longitude</a><br> <a href='http://www.w3.org/2006/vcard/ns#longitude'>http://www.w3.org/2006/vcard/ns#longitude</a><br> <a href='http://www.w3.org/2003/01/geo/wgs84_pos#long'>http://www.w3.org/2003/01/geo/wgs84_pos#long</a> </td></tr>
<tr><td> lat           </td><td>             </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#latitude'>http://www.w3.org/2001/vcard-rdf/3.0#latitude</a><br> <a href='http://www.w3.org/2006/vcard/ns#latitude'>http://www.w3.org/2006/vcard/ns#latitude</a><br> <a href='http://www.w3.org/2003/01/geo/wgs84_pos#lat'>http://www.w3.org/2003/01/geo/wgs84_pos#lat</a></td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getCompany(array("legalName"=&gt;"BestBuy"),FALSE,":lax",2)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [uri] =&gt; http://linkeddata.uriburner.com/about/id/entity/http/www.bestbuy.com/site/olspage.jsp?skuId=4220872&amp;type=product&amp;id=90450&amp;cmp=RMX&amp;ky=1wWjQQG4Xiol7quPUpCeYTX0osPgj3eWB#Vendor [title] =&gt; BestBuy Co., Inc. [gln] =&gt; [name] =&gt; BestBuy Co., Inc. [duns] =&gt; [isicv4] =&gt; [naics] =&gt; [street] =&gt; [post] =&gt; [city] =&gt; [country] =&gt; [phone] =&gt; [email] =&gt; [long] =&gt; [lat] =&gt; ) [1] =&gt; Array ( [uri] =&gt; http://linkeddata.uriburner.com/about/id/entity/http/www.bestbuy.com/site/olspage.jsp?skuId=4220872&amp;type=product&amp;id=90450&amp;cmp=RMX&amp;ky=1wWjQQG4Xiol7quPUpCeYTX0osPgj3eWB#Vendor [title] =&gt; The legal agent making the offering [gln] =&gt; [name] =&gt; BestBuy Co., Inc. [duns] =&gt; [isicv4] =&gt; [naics] =&gt; [street] =&gt; [post] =&gt; [city] =&gt; [country] =&gt; [phone] =&gt; [email] =&gt; [long] =&gt; [lat] =&gt; ) )</code></blockquote>

<br>
<br>
<hr /><br>
<br>
<br>
<br>
<br>
<h1>getLocation</h1>
(<a href='#Introduction.md'>back to top</a>)<br>
<br>
<h3>Description</h3>

<blockquote>Return stores near by known geographic coordinates.</blockquote>

<h3>Function call</h3>
<blockquote><code>string getLocation( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code></blockquote>

<h3>Parameter</h3>
<ul><li><b>inputArray</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> gln              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> title            </td><td> Martin Hepp    </td><td> <a href='http://www.w3.org/2000/01/rdf-schema#comment'>http://www.w3.org/2000/01/rdf-schema#comment</a> <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> </td></tr></li></ul></tbody></table>

<ul><li><b>wantedElements</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> gln              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> geo              </td><td> POINT(11.6416 48.08) </td><td>                      </td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getLocation(array("title"=&gt;"Martin Hepp"),array("uri", "title", "geo"),":lax",30)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [uri] =&gt; http://www.heppnetz.de/semanticweb.rdf#LocationOfSalesOrServiceProvisioning_1 [title] =&gt; Martin Hepp [geo] =&gt; POINT(11.6416 48.08)))</code></blockquote>

<ul><li><b>notice</b>:<br>
</li></ul><blockquote>Function use as startpoint 11.87455 (latitude) and 48.13155 (longitude). A location close to munich (Germany)! Please set latitude and longitude to your prefer location.<br>
<br>
<br>
<hr /><br>
<br>
</blockquote>


<h1>getOffers</h1>
(<a href='#Introduction.md'>back to top</a>)<br>
<br>
<h3>Description</h3>

<blockquote>Provides information for GoodRelation Offering.</blockquote>

<h3>Function call</h3>
<blockquote><code>string getOffers( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code>}</blockquote>

<h3>Parameter</h3>
<ul><li><b>inputArray</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> sku              </td><td> WMN6330D       </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit</a> </td></tr>
<tr><td> ean13            </td><td> 0729507800318  </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13</a> </td></tr>
<tr><td> title            </td><td> Wall Mount for 63" PPM63H3 Plasma </td><td> <a href='http://www.w3.org/2000/01/rdf-schema#comment'>http://www.w3.org/2000/01/rdf-schema#comment</a> <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> </td></tr>
<tr><td> manufacturer     </td><td> <a href='http://linkedopencommerce.com/supplier/samsung'>http://linkedopencommerce.com/supplier/samsung</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer</a> </td></tr>
<tr><td> gtin14           </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14 </a> </td></tr>
<tr><td> validFrom        </td><td> 2009-11-28T16:28:23+01:00 </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#validFrom'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#validFrom</a> </td></tr>
<tr><td> validThrough     </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#validThrough'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#validThrough</a> </td></tr>
<tr><td> maxPrice         </td><td>                </td><td> [<a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasMaxCurrencyValue'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasMaxCurrencyValue</a> </td></tr>
<tr><td> currency         </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency'>[http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency</a> </td></tr>
<tr><td> acceptedPaymentMethod </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#acceptedPaymentMethods'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#acceptedPaymentMethods</a> </td></tr>
<tr><td> businessFunction </td><td> <a href='http://purl.org/goodrelations/v1#Sell'>http://purl.org/goodrelations/v1#Sell</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasBusinessFunction'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasBusinessFunction</a> </td></tr>
<tr><td> minWarrantyInMonths </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#durationOfWarrantyInMonths'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#durationOfWarrantyInMonths</a> </td></tr>
<tr><td> eligibleCustomerTypes </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#BusinessEntityType'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#BusinessEntityType</a></td></tr>
<tr><td> eligibleRegions  </td><td>                </td><td> [<a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions</a> </td></tr>
<tr><td> availabilityStarts </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityStarts'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityStarts</a> </td></tr>
<tr><td> availabilityAtOrFrom </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableAtOrFrom'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableAtOrFrom</a> </td></tr></li></ul></tbody></table>

<ul><li><b>wantedElements</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> sku              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit</a> </td></tr>
<tr><td> ean13            </td><td> 0729507800318  </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13</a> </td></tr>
<tr><td> manufacturer     </td><td> <a href='http://linkedopencommerce.com/supplier/samsung'>http://linkedopencommerce.com/supplier/samsung</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer</a> </td></tr>
<tr><td> gtin14           </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14 </a> </td></tr>
<tr><td> acceptedPaymentMethod </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#acceptedPaymentMethods'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#acceptedPaymentMethods</a> </td></tr>
<tr><td> businessFunction </td><td> <a href='http://purl.org/goodrelations/v1#Sell'>http://purl.org/goodrelations/v1#Sell</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasBusinessFunction'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasBusinessFunction</a> </td></tr>
<tr><td> eligibleCustomerTypes </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#BusinessEntityType'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#BusinessEntityType</a></td></tr>
<tr><td> eligibleRegions  </td><td>                </td><td> [<a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions</a> </td></tr>
<tr><td> availabilityAtOrFrom </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableAtOrFrom'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableAtOrFrom</a> </td></tr>
<tr><td> availabilityStarts </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityStarts'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityStarts</a> </td></tr>
<tr><td> availabilityEnds </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityEnds'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availabilityEnds</a> </td></tr>
<tr><td> price            </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue</a> </td></tr>
<tr><td> currency         </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency</a> </td></tr>
<tr><td> validFrom        </td><td> 2009-11-28T16:28:23+01:00 </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#validFrom'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#validFrom</a> </td></tr>
<tr><td> validThrough     </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#validThrough'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#validThrough</a> </td></tr>
<tr><td> availableDeliveryMethods </td><td> <a href='http://purl.org/goodrelations/v1#DeliveryModeDirectDownload'>http://purl.org/goodrelations/v1#DeliveryModeDirectDownload</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableDeliveryMethods'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#availableDeliveryMethods</a> </td></tr>
<tr><td> minWarrantyInMonths </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#durationOfWarrantyInMonths'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#durationOfWarrantyInMonths</a> </td></tr>
<tr><td> paymentCurrency  </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency</a> </td></tr>
<tr><td> paymentCurrencyValue </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue</a> </td></tr>
<tr><td> paymentTaxIncluded </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#valueAddedTaxIncluded'>[http://www.heppnetz.de/ontologies/goodrelations/v1.html#valueAddedTaxIncluded</a> </td></tr>
<tr><td> deliveryRegion   </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#eligibleRegions</a> </td></tr>
<tr><td> deliveryCurrency </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrency</a> </td></tr>
<tr><td> deliveryCurrencyValue </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasCurrencyValue</a> </td></tr>
<tr><td> deliveryTaxIncluded </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#valueAddedTaxIncluded'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#valueAddedTaxIncluded</a> </td></tr>
<tr><td> minValue         </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1#hasInventoryLevel'>http://www.heppnetz.de/ontologies/goodrelations/v1#hasInventoryLevel</a> </td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getOffers(array("ean13"=&gt;"07295078"),FALSE,":lax",1)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [uri] =&gt; http://linkedopencommerce.com/product/samsung/wmn6330d [title] =&gt; Wall Mount for 63" PPM63H3 Plasma [ean13] =&gt; 0729507800318 [gtin] =&gt; [sku] =&gt; WMN6330D [manufacturer] =&gt; http://linkedopencommerce.com/supplier/samsung [businessFunction] =&gt; http://purl.org/goodrelations/v1#Sell [acceptedPaymentMethod] =&gt; [price] =&gt; [currency] =&gt; [eligibleRegions] =&gt; [eligibleCustomerTypes] =&gt; [minValue] =&gt; [validFrom] =&gt; 2009-11-28T16:28:23+01:00 [validThrough] =&gt; [description] =&gt; [availableAtOrFrom] =&gt; [availabilityStarts] =&gt; [availabilityEnds] =&gt; [availableDeliveryMethods] =&gt; http://purl.org/goodrelations/v1#DeliveryModeDirectDownload [minWarrantyInMonths] =&gt; [paymentCurrency] =&gt; [paymentCurrencyValue] =&gt; [paymentTaxIncluded] =&gt; [deliveryRegion] =&gt; [deliveryCurrency] =&gt; [deliveryCurrencyValue] =&gt; [deliveryTaxIncluded] =&gt; ) )</code>
<br>
<br>
<hr /><br>
<br>
</blockquote>


<h1>getOpeningHours</h1>
(<a href='#Introduction.md'>back to top</a>)<br>
<br>
<h3>Description</h3>

<blockquote>Provides information for GoodRelation LocationOfSalesOrServiceProvisioning.</blockquote>

<h3>Function call</h3>
<blockquote><code>string getOpeningHours( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code></blockquote>

<h3>Parameter</h3>
<ul><li><b>inputArray</b>: [<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> gln              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> title            </td><td> Team EWS Ingenieure </td><td> <a href='http://www.w3.org/2000/01/rdf-schema#comment'>http://www.w3.org/2000/01/rdf-schema#comment</a> <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> </td></tr></li></ul></tbody></table>

<ul><li><b>wantedElements</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> openMonday       </td><td> 08:00:00+01:00 </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeMonday      </td><td> 13:00:00+01:00 </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openTuesday      </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeTuesday     </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openWednesday    </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeWednesday   </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openThursday     </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeThursday    </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openFriday       </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeFriday      </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openSaturday     </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeSaturday    </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> openSunday       </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeSunday      </td><td>                </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getOpeningHours(array("title"=&gt;"Team EWS Ingenieure"),array("openMonday", "closeMonday"),":lax",30)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [openMonday] =&gt; [closeMonday] =&gt; ) [1] =&gt; Array ( [openMonday] =&gt; 08:00:00+01:00 [closeMonday] =&gt; 12:00:00+01:00 ) [2] =&gt; Array ( [openMonday] =&gt; 13:00:00+01:00 [closeMonday] =&gt; 18:00:00+01:00 ) )</code></blockquote>

<br>
<br>
<hr /><br>
<br>
<br>
<br>
<br>
<h1>getProductModel</h1>
(<a href='#Introduction.md'>back to top</a>)<br>
<br>
<h3>Description</h3>

<blockquote>Return information for GoodRelation ProductModel.</blockquote>

<h3>Function call</h3>

<blockquote><code>string getProductModel( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code></blockquote>


<h3>Parameter</h3>

<ul><li><b>inputArray</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> ean13            </td><td> 0729507800318  </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13</a> </td></tr>
<tr><td> gtin14           </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14</a> </td></tr>
<tr><td> title            </td><td> WALLMOUNT HORIZONTAL F/ PPM63H3X NS </td><td> <a href='http://www.w3.org/2000/01/rdf-schema#comment'>http://www.w3.org/2000/01/rdf-schema#comment</a> <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> </td></tr>
<tr><td> manufacturer     </td><td> <a href='http://linkedopencommerce.com/supplier/samsung'>http://linkedopencommerce.com/supplier/samsung</a> </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer</a> </td></tr></li></ul></tbody></table>

<ul><li><b>wantedElemtens</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> sku              </td><td> WMN6330D       </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasStockKeepingUnit</a> </td></tr>
<tr><td> ean13            </td><td> 0729507800318  </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasEAN_UCC-13</a> </td></tr>
<tr><td> gtin14           </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGTIN-14 </a> </td></tr>
<tr><td> description      </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#description'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#description</a> </td></tr>
<tr><td> manufacturer     </td><td> "<a href='http://linkedopencommerce.com/supplier/samsung'>http://linkedopencommerce.com/supplier/samsung</a>" </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasManufacturer</a></td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getProductModel(array("ean13"=&gt;"07295078"),FALSE,":lax",3)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [uri] =&gt; http://linkedopencommerce.com/product/samsung/wmn6330d [title] =&gt; Wall Mount for 63" PPM63H3 Plasma [sku] =&gt; WMN6330D [ean13] =&gt; 0729507800318 [gtin] =&gt; [description] =&gt; [website] =&gt; [manufacturer] =&gt; http://linkedopencommerce.com/supplier/samsung ) [1] =&gt; Array ( [uri] =&gt; http://linkedopencommerce.com/product/samsung/wmn6330d [title] =&gt; WALLMOUNT HORIZONTAL F/ PPM63H3X NS [sku] =&gt; WMN6330D [ean13] =&gt; 0729507800318 [gtin] =&gt; [description] =&gt; [website] =&gt; [manufacturer] =&gt; http://linkedopencommerce.com/supplier/samsung ) [2] =&gt; Array ( [uri] =&gt; http://linkedopencommerce.com/product/samsung/wmn6330d [title] =&gt; WMN6330D [sku] =&gt; WMN6330D [ean13] =&gt; 0729507800318 [gtin] =&gt; [description] =&gt; [website] =&gt; [manufacturer] =&gt; http://linkedopencommerce.com/supplier/samsung ) )</code></blockquote>

<br>
<br>
<hr /><br>
<br>
<br>
<br>
<br>
<h1>getStore</h1>
(<a href='#Introduction.md'>back to top</a>)<br>
<br>
<h3>Description</h3>

<blockquote>Return the response on the SPARQL query about GoodRelation LocationOfSalesOrServiceProvisioning.</blockquote>

<h3>Function call</h3>
<blockquote><code>string getStore( array $inputArray, [array $wantedElements = FALSE], [string $mode = Configuration::MODE_LAX], [integer $limit = Configuration::LIMIT], [array $searchProperties = FALSE])</code></blockquote>

<h3>Parameter</h3>
<ul><li><b>inputArray</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> gln              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> title            </td><td> Team EWS Ingenieure</td><td> <a href='http://www.w3.org/2000/01/rdf-schema#comment'>http://www.w3.org/2000/01/rdf-schema#comment</a> <br> <a href='http://www.w3.org/2000/01/rdf-schema#label'>http://www.w3.org/2000/01/rdf-schema#label</a> <br> <a href='http://dublincore.org/2010/10/11/dcelements.rdf#title'>http://dublincore.org/2010/10/11/dcelements.rdf#title</a> </td></tr>
<tr><td> city             </td><td>                </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Locality'>http://www.w3.org/2001/vcard-rdf/3.0#Locality</a> <br> <a href='http://www.w3.org/2006/vcard/ns#locality'>http://www.w3.org/2006/vcard/ns#locality</a> </td></tr>
<tr><td> country          </td><td>                </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Country'>http://www.w3.org/2001/vcard-rdf/3.0#Country</a> <br> <a href='http://www.w3.org/2006/vcard/ns#country-name'>http://www.w3.org/2006/vcard/ns#country-name</a> </td></tr></li></ul></tbody></table>

<ul><li><b>wantedElements</b>:<br>
<table><thead><th> <b>Parameter</b> </th><th> <b>Example</b> </th><th> <b>Specification</b> </th></thead><tbody>
<tr><td> gln              </td><td>                </td><td> <a href='http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber'>http://www.heppnetz.de/ontologies/goodrelations/v1.html#hasGlobalLocationNumber</a> </td></tr>
<tr><td> street           </td><td> Garberweg 23   </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Street'>http://www.w3.org/2001/vcard-rdf/3.0#Street</a><br> <a href='http://www.w3.org/2006/vcard/ns#street-address'>http://www.w3.org/2006/vcard/ns#street-address</a> </td></tr>
<tr><td> post             </td><td> I-39010        </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Pobox'>http://www.w3.org/2001/vcard-rdf/3.0#Pcode</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Postal'>http://www.w3.org/2006/vcard/ns#Postal</a> </td></tr>
<tr><td> city             </td><td> St. Martin in Passeier </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Locality'>http://www.w3.org/2001/vcard-rdf/3.0#Locality</a> <br> <a href='http://www.w3.org/2006/vcard/ns#locality'>http://www.w3.org/2006/vcard/ns#locality</a> </td></tr>
<tr><td> country          </td><td> Italy          </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#Country'>http://www.w3.org/2001/vcard-rdf/3.0#Country</a> <br> <a href='http://www.w3.org/2006/vcard/ns#country-name'>http://www.w3.org/2006/vcard/ns#country-name</a> </td></tr>
<tr><td> phone            </td><td> +39-393-9765131 </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#TEL'>http://www.w3.org/2001/vcard-rdf/3.0#TEL</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Tel'>http://www.w3.org/2006/vcard/ns#Tel</a> </td></tr>
<tr><td> email            </td><td>                </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#EMAIL'>http://www.w3.org/2001/vcard-rdf/3.0#EMAIL</a> <br> <a href='http://www.w3.org/2006/vcard/ns#Email'>http://www.w3.org/2006/vcard/ns#Email</a> </td></tr>
<tr><td> long             </td><td>                </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#longitude'>http://www.w3.org/2001/vcard-rdf/3.0#longitude</a><br> <a href='http://www.w3.org/2006/vcard/ns#longitude'>http://www.w3.org/2006/vcard/ns#longitude</a><br> <a href='http://www.w3.org/2003/01/geo/wgs84_pos#long'>http://www.w3.org/2003/01/geo/wgs84_pos#long</a> </td></tr>
<tr><td> lat              </td><td>                </td><td> <a href='http://www.w3.org/2001/vcard-rdf/3.0#latitude'>http://www.w3.org/2001/vcard-rdf/3.0#latitude</a><br> <a href='http://www.w3.org/2006/vcard/ns#latitude'>http://www.w3.org/2006/vcard/ns#latitude</a><br> <a href='http://www.w3.org/2003/01/geo/wgs84_pos#lat'>http://www.w3.org/2003/01/geo/wgs84_pos#lat</a></td></tr>
<tr><td> openTime         </td><td> 08:00:00+01:00 </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr>
<tr><td> closeTime        </td><td> 12:00:00+01:00 </td><td> <a href='http://www.w3.org/TR/xmlschema-2/#time'>http://www.w3.org/2001/XMLSchema#time</a> </td></tr></li></ul></tbody></table>

<ul><li><b>example</b>:<br>
</li></ul><blockquote><u>Request</u>: <code>$gr4php-&gt;getStore(array("title"=&gt;"Team EWS Ingenieure"),FALSE,":lax",30)</code></blockquote>

<blockquote><u>Response</u>: <code>Array ( [0] =&gt; Array ( [uri] =&gt; http://www.ews-ingenieure.com/#LOSOSP_1 [title] =&gt; Team EWS Ingenieure [gln] =&gt; [street] =&gt; Garberweg 23 [post] =&gt; I-39010 [city] =&gt; St. Martin in Passeier [country] =&gt; Italy [phone] =&gt; +39-393-9765131 [email] =&gt; [long] =&gt; [lat] =&gt; [openTime] =&gt; 08:00:00+01:00 [closeTime] =&gt; 12:00:00+01:00 ) [1] =&gt; Array ( [uri] =&gt; http://www.ews-ingenieure.com/#LOSOSP_1 [title] =&gt; Team EWS Ingenieure [gln] =&gt; [street] =&gt; Garberweg 23 [post] =&gt; I-39010 [city] =&gt; St. Martin in Passeier [country] =&gt; Italy [phone] =&gt; +39-393-9765131 [email] =&gt; [long] =&gt; [lat] =&gt; [openTime] =&gt; 13:00:00+01:00 [closeTime] =&gt; 18:00:00+01:00 ) )</code>