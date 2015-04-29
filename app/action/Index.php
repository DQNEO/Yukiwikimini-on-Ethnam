<?php
/**
 *  Index.php
 *
 *  @author    {$author}
 *  @package   Wiki
 *  @version   $Id: e7e47c4178c0b8e3a1ef1b0daf9620f4323250e4 $
 */

/**
 *  Index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Action_Index extends Wiki_ActionClass
{
    /**
     *  Index action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    public function perform()
    {
        return 'index';
    }
}
