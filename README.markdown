Overview
========

TOXNET Web Service API
http://toxnet.nlm.nih.gov/toxnetapi/TOXNETWebService.html

TOXNET API offers a RESTful Web Service API that allows users to search TOXNET databases with keywords.

Usage
=====

<pre>
// Base API Class
require 'APIBaseClass.php';

require 'toxnetApi.php';

$new = new toxnetApi();

echo $new->chemical_search('hsdb','benzene');

echo $new->chemical_search('hsdb','benzene leukemia');

// Debug information
die(print_r($new).print_r(get_object_vars($new)).print_r(get_class_methods(get_class($new))));

</pre>
