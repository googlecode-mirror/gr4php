# Future Work #

GoodRelation provides a lot of attributes, but not all of them are at the moment in usage. Therefore GR4PHP don't use them in the SPARQL queries. This keeps the queries short and fast.

**Elements, which aren't used**:
  * [gr:isVariantOf](http://www.heppnetz.de/ontologies/goodrelations/v1.html#isVariantOf)
  * [gr:predecessorOf](http://www.heppnetz.de/ontologies/goodrelations/v1.html#predecessorOf)
  * [gr:successorOf](http://www.heppnetz.de/ontologies/goodrelations/v1.html#successorOf)
  * [gr:isConsumableFor](http://www.heppnetz.de/ontologies/goodrelations/v1.html#isConsumableFor)
  * [gr:isSimiliarTo](http://www.heppnetz.de/ontologies/goodrelations/v1.html#isSimilarTo)
  * [gr:isAccessoryOrSparePartFor](http://www.heppnetz.de/ontologies/goodrelations/v1.html#isAccessoryOrSparePartFor)
These Elements describe different types of relations. In the future there will be more relationships define by these elements. A Extension of GR4PHP with this attributes will be useful.

**Supported by a lower version PHP version than PHP 5.2.0**: At the moment GR4PHP need the support of PHP 5.2 or higher. A change of the PHP API for a lower version than PHP 5.2 would be valuable.

**Check endpoint for virtuoso features**: GR4PHP uses virtuoso functions, e.g. bif:contains, therefore the PHP API is limited to virtuoso endpoints. Further extensions will include a automatic check of endpoints for virtuoso functions.

**Extend exception calls**: Exceptions are useful to identifier errors. The more exceptions are created the more mistakes can be found easier.

**Only one function call**: A possible extension is to reduce the number of function calls. One function with an additional parameter $function could be used to consolidate six all six function calls. E.g. a function call with parameter $function = getStore.