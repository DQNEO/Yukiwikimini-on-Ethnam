<?php
/**
 *  AddAppManager.php
 *
 *  @author     nozzzzz <nozzzzz@gmail.com>
 *  @license    http://www.opensource.org/licenses/bsd-license.php The BSD License
 *  @package    Ethna
 *  @version    $Id: 4562fa8cbac490aa2d8d22f96de0503a65a9b597 $
 */

require_once 'Ethna/class/Plugin/Handle/AddAppObject.php';

// {{{ Ethna_Plugin_Handle_AddAppManager
/**
 *  add-app-manager handler
 *
 *  @author     nozzzzz <nozzzzz@gmail.com>
 *  @access     public
 *  @package    Ethna
 */
class Ethna_Plugin_Handle_AddAppManager extends Ethna_Plugin_Handle_AddAppObject
{
    /**
     *  add app-manager
     *
     *  @access public
     */
    function perform()
    {
        return $this->_perform('AppManager');
    }

    /**
     *  get handler's description
     *
     *  @access public
     */
    function getDescription()
    {
        return <<<EOS
add new app-manager to project:
    {$this->id} [-b|--basedir=dir] [app-manager name]

EOS;
    }

    /**
     *  get usage
     *
     *  @access public
     */
    function getUsage()
    {
        return <<<EOS
ethna {$this->id} [-b|--basedir=dir] [app-manager name]
EOS;
    }
}
// }}}
