<?php
/**
 *  {$action_path}
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: d67e3c504b4d261dc3b448ddb8ef9de286c53c8d $
 */

/**
 *  {$action_name} Form implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class {$action_form} extends Wiki_ActionForm
{
    /**
     *  @access protected
     *  @var    array   form definition.
     */
    public $form = array(
       /*
        *  TODO: Write form definition which this action uses.
        *  @see http://ethna.jp/ethna-document-dev_guide-form.html
        *
        *  Example(You can omit all elements except for "type" one) :
        *
        *  'sample' => array(
        *      // Form definition
        *      'type'        => VAR_TYPE_INT,    // Input type
        *      'form_type'   => FORM_TYPE_TEXT,  // Form type
        *      'name'        => 'Sample',        // Display name
        *
        *      //  Validator (executes Validator by written order.)
        *      'required'    => true,            // Required Option(true/false)
        *      'min'         => null,            // Minimum value
        *      'max'         => null,            // Maximum value
        *      'regexp'      => null,            // String by Regexp
        *
        *      //  Filter
        *      'filter'      => 'sample',        // Optional Input filter to convert input
        *      'custom'      => null,            // Optional method name which
        *                                        // is defined in this(parent) class.
        *  ),
        */
    );

    /**
     *  Form input value convert filter : sample
     *
     *  @access protected
     *  @param  mixed   $value  Form Input Value
     *  @return mixed           Converted result.
     */
    /*
    protected function _filter_sample($value)
    {
        //  convert to upper case.
        return strtoupper($value);
    }
    */
}

/**
 *  {$action_name} action implementation.
 *
 *  @author     {$author}
 *  @access     public
 *  @package    Wiki
 */
class {$action_class} extends Wiki_ActionClass
{
    /**
     *  preprocess of {$action_name} Action.
     *
     *  @access public
     *  @return string    forward name(null: success.
     *                                false: in case you want to exit.)
     */
    public function prepare()
    {
        return null;
    }

    /**
     *  {$action_name} action implementation.
     *
     *  @access public
     *  @return string  forward name.
     */
    public function perform()
    {
        return null;
    }
}
