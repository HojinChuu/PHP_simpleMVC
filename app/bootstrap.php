<?php
// Load Config 
require_once 'config/config.php';

// Load Helpers
require_once 'helpers/session_helper.php';
require_once 'helpers/redirect_helper.php';

// Autoload Core libraries
spl_autoload_register(function($className) {
    require_once 'lib/' . $className . '.php';
});