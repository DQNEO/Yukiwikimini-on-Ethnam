<?php
/**
 *  Index.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 6a152841e30d3c762e3a60c8ac0899a72c0641d2 $
 */

/**
 *  index view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_View_Index extends Wiki_ViewClass
{
    /** @var boolean  layout template use flag   */
    var $use_layout = true;

    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    function preforward()
    {
        $this->af->setApp('title', 'Index');
        $this->af->setApp('pages', $this->pm->getList());
    }
}

