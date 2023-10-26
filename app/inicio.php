<?php
ini_set('display_errors', 1);

//Constantes iniciales
define('ROOT', DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . ROOT);
define('URL', '/var/www/mvctienda');
define('VIEWS', URL . APP . 'views' . ROOT);
define('ENCRIPTKEY', 'elperrodesanroque');

define('HEADER','/var/www/mvctienda/app/views/default/header.php');
define('FOOTER','/var/www/mvctienda/app/views/default/footer.php');
define('ERROR_FORM','/var/www/mvctienda/app/views/default/errorForm.php');

define('PRODUCT_TYPE','productType');
define('PRODUCT_STATUS','productStatus');

//Carga las clases iniciales
require_once 'libs/MySQLdb.php';
require_once 'libs/Controller.php';
require_once 'libs/Application.php';
require_once 'libs/Session.php';
require_once 'libs/Validate.php';