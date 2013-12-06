localStoragePHP
===============

PHP implementation of the Javascript LocalStorage

LocalStorage is used quite often in the front-end Javascript web developement, it allows to quickly store some data and persist them over the time. In PHP we usually use database for this, but in some cases when you only need few parameters to persist, the use of a database would be an overkill.

The LocalStorage will allow you to quickly store, persist and retrieve data on a server without using a database. All data is stored in a single local file. More information can be found here: http://dev.w3.org/html5/webstorage/#the-localstorage-attribute

###Quick start

Require and instantiate the LocalStorage class:
```
require 'src/localstorage.php';
$store = new localStorage();
```
Optionaly you can specify the file name where the datagonna be stored:
```
new localStorage("filestorage.db");
```
Perform an operation (for example: get an item value)
```
$item = $store->getItem("item");
```
There are only 4 methods: getItem, setItem, removeItem and clear, and their usage is identical to the Javascript version.

Optionaly this implementation allows to use standard PHP array functions (push/pop/shift/unshift) to access first and last elements of the LocalStorage. Their usage is identical the usage of their PHP counterparts, ex.:
```
$store->push("some data");  //adds the element to the top of the LocalStorage
```
