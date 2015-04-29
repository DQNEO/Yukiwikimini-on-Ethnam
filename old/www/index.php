<?php

require_once dirname(__FILE__) . '/../app/Wiki_Controller.php';

/**
 * If you want to enable the UrlHandler, comment in following line,
 * and then you have to modify $action_map on app/Wiki_UrlHandler.php .
 *
 */
// $_SERVER['URL_HANDLER'] = 'index';

/**
 * Run application.
 */
Wiki_Controller::main('Wiki_Controller', 'read');

