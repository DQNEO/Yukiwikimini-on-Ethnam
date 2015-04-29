<?php
/**
 *  Wiki_Controller.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 8b11991fe0c901152c55bef5fbe0992dcd7364e2 $
 */

/** Application base directory */
define('BASE', dirname(dirname(__FILE__)));

/** include_path setting (adding "/app" and "/lib" directory to include_path) */
$app = BASE . "/app";
$lib = BASE . "/lib";
set_include_path(implode(PATH_SEPARATOR, array($app, $lib)) . PATH_SEPARATOR . get_include_path());

require_once BASE . '/vendor/autoload.php';
require_once 'Wiki_Error.php';
require_once 'Wiki_ActionClass.php';
require_once 'Wiki_ActionForm.php';
require_once 'Wiki_ViewClass.php';
//require_once 'Wiki_UrlHandler.php';

define('WIKI_NAME', '([A-Z][a-z]+([A-Z][a-z]+)+)');
define('WIKI_NAME_VALIDATE', '/^' . WIKI_NAME . '$/');


/**
 *  Wiki application Controller definition.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Controller extends Ethna_Controller
{
    /**#@+
     *  @access protected
     */

    /**
     *  @var    string  Application ID(appid)
     */
    protected $appid = 'WIKI';

    /**
     *  @var    array   forward definition.
     */
    protected $forward = array(
        /*
         *  TODO: write forward definition here.
         *
         *  Example:
         *
         *  'index'         => array(
         *      'view_name' => 'Wiki_View_Index',
         *  ),
         */
    );

    /**
     *  @var    array   action definition.
     */
    protected $action = array(
        /*
         *  TODO: write action definition here.
         *
         *  Example:
         *
         *  'index'     => array(
         *      'form_name' => 'Sample_Form_SomeAction',
         *      'form_path' => 'Some/Action.php',
         *      'class_name' => 'Sample_Action_SomeAction',
         *      'class_path' => 'Some/Action.php',
         *  ),
         */
    );

    /**
     *  @var    array       application directory.
     */
    protected $directory = array(
        'action'        => 'app/action',
        'action_cli'    => 'app/action_cli',
        'action_xmlrpc' => 'app/action_xmlrpc',
        'app'           => 'app',
        'plugin'        => 'app/plugin',
        'bin'           => 'bin',
        'etc'           => 'etc',
        'filter'        => 'app/filter',
        'locale'        => 'locale',
        'log'           => 'log',
        'plugins'       => array('app/plugin/Smarty'),
        'template'      => 'template',
        'template_c'    => 'tmp',
        'tmp'           => 'tmp',
        'view'          => 'app/view',
        'www'           => 'www',
        'test'          => 'app/test',
        'database'      => 'database',
    );

    /**
     *  @var    array       database access definition.
     */
    protected $db = array(
        ''              => DB_TYPE_RW,
    );

    /**
     *  @var    array       extention(.php, etc) configuration.
     */
    protected $ext = array(
        'php'           => 'php',
        'tpl'           => 'tpl',
    );

    /**
     *  @var    array   class definition.
     */
    public $class = array(
        /*
         *  TODO: When you override Configuration class, Logger class,
         *        SQL class, don't forget to change definition as follows!
         */
        'class'         => 'Ethna_ClassFactory',
        'backend'       => 'Ethna_Backend',
        'config'        => 'Ethna_Config',
        'db'            => 'Ethna_DB_PEAR',
        'error'         => 'Ethna_ActionError',
        'form'          => 'Wiki_ActionForm',
        'i18n'          => 'Ethna_I18N',
        'logger'        => 'Ethna_Logger',
        'plugin'        => 'Ethna_Plugin',
        'session'       => 'Ethna_Session',
        'view'          => 'Wiki_ViewClass',
        'renderer'      => 'Ethna_Renderer_Smarty',
        'url_handler'   => 'Wiki_UrlHandler',
    );

    /**
     *  @var    array       filter definition.
     */
    protected $filter = array(
        /*
         *  TODO: when you use filter, write filter plugin name here.
         *  (If you specify class name, Ethna reads filter class in
         *   filter directory)
         *
         *  Example:
         *
         *  'ExecutionTime',
         */
    );

    /**#@-*/

    /**
     *  Get Default language and locale setting.
     *  If you want to change Ethna's output encoding, override this method.
     *
     *  @access protected
     *  @return array   locale name(e.x ja_JP, en_US .etc),
     *                  system encoding name,
     *                  client encoding name(= template encoding)
     *                  (locale name is "ll_cc" format. ll = language code. cc = country code.)
     */
    protected function _getDefaultLanguage()
    {
        return array('ja_JP', 'UTF-8', '{$client_enc}');
    }

    /**
     *  set Default Template Engine
     *
     *  @access protected
     *  @param  object  Ethna_Renderer
     *  @obsolete
     */
    protected function _setDefaultTemplateEngine($renderer)
    {
    }
}
