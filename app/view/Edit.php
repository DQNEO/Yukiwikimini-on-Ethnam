<?php
/**
 *  Edit.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 6a152841e30d3c762e3a60c8ac0899a72c0641d2 $
 */

/**
 *  edit view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_View_Edit extends Wiki_ViewClass
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
        $this->af->setApp('title', $this->af->get('mypage'));

        $text = $this->pm->getText($this->af->get('mypage'));
        $this->af->setAppNe('content', $text);
    }
}

