<?php

define('__PATH__', $_SERVER['DOCUMENT_ROOT']);
define("__VIEW__", __PATH__."/views");
define("__ADMIN__", __VIEW__."/admin");
define("__COMPONENT__", __PATH__."/components");


define('__URL__', "");
define("__ASSETS__", __URL__."/assets");
define("__CSS__", __ASSETS__."/css");
define("__IMG__", __ASSETS__."/images");

define("__SRC__", __URL__."/src");
define("__JS__", __SRC__."/js");




define('_DBTYPE', 'mysql');
define('_HOST', 'localhost');
define('_DBNAME', 'publichealthform');
define('_DBUSER', 'root');
define('_DBPASSWORD', '1234');
define('_CHARSET', 'utf8');
