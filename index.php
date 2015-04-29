<?php
//var_dump(getcwd());  => "/app/www"
chdir('www');
//var_dump(getcwd()); =>  "/app/www/www" 
require_once 'www/index.php';

