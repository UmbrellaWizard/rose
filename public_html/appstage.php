<?php
// Define ROOT_DIR
define('ROOT_DIR', realpath('..'));
//Locale
setlocale(LC_MONETARY, 'en_US');

// List of servers we use
$dev		= array('rose');
$staging	= array('rose.test:8080', 'rose.test:8080');
$production	= array('rose.test');

// What is our host right now ?
$host = $_SERVER['HTTP_HOST'];

/*
 * Check in which server we are running,
 * and load some settings depending on it.
 */
if(in_array($host, $dev)) {
    define('APPSTAGE', 'development');
} elseif(in_array($host, $staging)) {
    define('APPSTAGE', 'staging');
} elseif(in_array($host, $production)) {
    define('APPSTAGE', 'production');
} else {
    // Default to development
    define('APPSTAGE', 'production');
}
