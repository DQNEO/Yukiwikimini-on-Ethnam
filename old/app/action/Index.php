<?php
/**
 *  Index.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 313d2f94a569be1b093001aa38bb6769a72827a6 $
 */

/**
 *  index action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Action_Index extends Wiki_ActionClass
{
    /**
     *  index action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    function perform()
    {
        return 'index';
    }
}

