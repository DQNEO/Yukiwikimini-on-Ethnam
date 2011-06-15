<?php
/**
 *  Read.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: dfb80334e237b1b07f70a643598adbd84be40f22 $
 */

/**
 *  Read view implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_View_Read extends Wiki_ViewClass
{
    /**
     *  preprocess before forwarding.
     *
     *  @access public
     */
    function preforward()
    {
        $content = $this->pm->get($this->af->get('mypage'));
        $this->af->setAppNe('content', $content);
        $this->af->setApp('canedit', true);
    }

}

