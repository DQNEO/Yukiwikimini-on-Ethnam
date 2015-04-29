<?php
error_reporting(E_ALL);
require_once dirname(__FILE__) . '/../app/Wiki_Controller.php';

Wiki_Controller::main('Wiki_Controller', array(
    '__ethna_unittest__',
    )
);
