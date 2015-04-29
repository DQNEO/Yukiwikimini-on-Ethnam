<?php
// vim: foldmethod=marker
/**
 *  Wiki_ActionForm.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 1d92c01639b2a2f873e44216c35a7d3356299201 $
 */

// {{{ Wiki_ActionForm
/**
 *  ActionForm class.
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @access     public
 */
class Wiki_ActionForm extends Ethna_ActionForm
{
    /**#@+
     *  @access protected
     */

    /** @var    array   form definition (default) */
    public $form_template = array(
         'mypage' => array(
             // Form definition
             'type'        => VAR_TYPE_STRING,    // Input type
             'form_type'   => FORM_TYPE_TEXT,  // Form type
             'name'        => 'ページ名',        // Display name
             //  Validator (executes Validator by written order.)
             'required'    => false,            // Required Option(true/false)
             'min'         => 1,            // Minimum value
             'max'         => 256,            // Maximum value
             'regexp'      =>  WIKI_NAME_VALIDATE,            // String by Regexp
             'regexp'    => null,            // Multibype string by Regexp
             //  Filter
             //'filter'      => 'sample',        // Optional Input filter to convert input
             'custom'      => null,            // Optional method name which
                                               // is defined in this(parent) class.
         ),
    );

    /**#@-*/

    /**
     *  Error handling of form input validation.
     *
     *  @access public
     *  @param  string      $name   form item name.
     *  @param  int         $code   error code.
     */
    public function handleError($name, $code)
    {
        return parent::handleError($name, $code);
    }

    /**
     *  setter method for form template.
     *
     *  @access protected
     *  @param  array   $form_template  form template
     *  @return array   form template after setting.
     */
    protected function _setFormTemplate($form_template)
    {
        return parent::_setFormTemplate($form_template);
    }

    /**
     *  setter method for form definition.
     *
     *  @access protected
     */
    protected function _setFormDef()
    {
        return parent::_setFormDef();
    }

}
// }}}
