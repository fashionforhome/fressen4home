/**
* This is the ..... [Description]
*
* @category Main
* @package Main
*
* @author Eduard Bess <eduard.bess@fashion4home.de>
*
* @copyright (c) 2014 by fashion4home GmbH <www.fashionforhome.de>
* @license GPL-3.0
* @license http://opensource.org/licenses/GPL-3.0 GNU GENERAL PUBLIC LICENSE
*
* @version 1.0.0
*
* Date: 11.06.2014
* Time: 22:04
*/
<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = urldecode($uri);

$paths = require __DIR__.'/bootstrap/paths.php';

$requested = $paths['public'].$uri;

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' and file_exists($requested))
{
	return false;
}

require_once $paths['public'].'/index.php';
