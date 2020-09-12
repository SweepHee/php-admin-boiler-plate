<?php

/* config */
require_once(__DIR__."/config/config.php");

/* autoload */
require_once(__PATH__."/vendor/autoload.php");
/* -------basic include */



/* modules */
require_once(__PATH__."/modules/common.php");

/* routes */
require_once(__PATH__."/routes/index.php");
require_once(__PATH__."/routes/form.php");

$app = new app\libs\Application();
