<?php
// vim: foldmethod=marker
/**
 *  Wiki_ActionClass.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: f02b68159d59dac373657862b68c5771afee6d15 $
 */

// {{{ Wiki_ActionClass
/**
 *  action execution class
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @access     public
 */
class Wiki_ActionClass extends Ethna_ActionClass
{
    public function __construct($backend)
    {
        parent::__construct($backend);
        $this->pm  = $this->backend->getManager('page');
    }

    /**
     *  authenticate before executing action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    function authenticate()
    {
        return parent::authenticate();
    }

    /**
     *  Preparation for executing action. (Form input check, etc.)
     *
     *  @access public
     *  @return string  Forward name.
     *                  (null if no errors. false if we have something wrong.)
     */
    function prepare()
    {
        return parent::prepare();
    }

    /**
     *  execute action.
     *
     *  @access public
     *  @return string  Forward name.
     *                  (we does not forward if returns null.)
     */
    function perform()
    {
        return parent::perform();
    }
}
// }}}

