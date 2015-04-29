<?php
/**
 *  Write.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 313d2f94a569be1b093001aa38bb6769a72827a6 $
 */

/**
 *  write Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Form_Write extends Wiki_ActionForm
{
    /**
     *  @access private
     *  @var    array   form definition.
     */
    var $form = array(
        'mypage' => array(
            'required' => true,
            ),

        'mymsg' => array(
            // Form definition
            'type'        => VAR_TYPE_STRING,    // Input type
            'form_type'   => FORM_TYPE_TEXTAREA,  // Form type
            'name'        => 'コンテンツ',        // Display name

            //  Validator (executes Validator by written order.)
            'required'    => false,            // Required Option(true/false)
            'min'         => null,            // Minimum value
            'max'         => 1024,            // Maximum value
            'regexp'      => null,            // String by Regexp
            'regexp'    => null,            // Multibype string by Regexp

            //  Filter
            'custom'      => null,            // Optional method name which
                                              // is defined in this(parent) class.
        ),
    );

}

/**
 *  write action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Action_Write extends Wiki_ActionClass
{
    /**
     *  preprocess of write Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    function prepare()
    {
        if ($this->af->validate() > 0) {
            return 'error';
        }
        return null;
    }

    /**
     *  write action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    function perform()
    {
        if ($this->af->get('mymsg')) {
            $this->pm->set($this->af->get('mypage'), $this->af->get('mymsg'));
            $this->af->setApp('title', $this->af->get('mypage'));
        } else {
            $this->pm->delete($this->af->get('mypage'));
            $this->af->setApp('title', $this->af->get('mypage') . ' is deleted');
        }
        return 'read';
    }
}
