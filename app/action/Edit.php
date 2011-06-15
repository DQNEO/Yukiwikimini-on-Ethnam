<?php
/**
 *  Edit.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 313d2f94a569be1b093001aa38bb6769a72827a6 $
 */

/**
 *  edit Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Form_Edit extends Wiki_ActionForm
{
    /**
     *  @access private
     *  @var    array   form definition.
     */
    var $form = array(
         'mypage' => array(
             'required' => true,
         ),
    );

}

/**
 *  edit action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class Wiki_Action_Edit extends Wiki_ActionClass
{
    /**
     *  preprocess of edit Action.
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
     *  edit action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    function perform()
    {
        return 'edit';
    }
}

