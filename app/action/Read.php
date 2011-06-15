<?php
/**
 *  Read.php
 *
 *  @author    {$author}
 *  @package   Wiki
 *  @version   $Id: e9824c6746d92ba53ac34b3b3ecafa454b9972ff $
 */

/**
 *  Read form implementation
 *
 *  @author    {$author}
 *  @access    public
 *  @package   Wiki
 */

class Wiki_Form_Read extends Wiki_ActionForm
{
    /**
     *  @access   private
     *  @var      array   form definition.
     */
    var $form = array(
        'mypage',
    );
}

/**
 *  Read action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Action_Read extends Wiki_ActionClass
{
    /**
     *  preprocess Read action.
     *
     *  @access    public
     *  @return    string  Forward name (null if no errors.)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'error';
        }

        if ($this->af->get('mypage') === null) {
            $this->af->set('mypage', 'FrontPage');
        }
        return null;
    }

    /**
     *  Read action implementation.
     *
     *  @access    public
     *  @return    string  Forward Name.
     */
    function perform()
    {
        $this->af->setApp('title', $this->af->get('mypage'));
        return 'read';
    }
}

