<?php
// vim: foldmethod=marker
/**
 *  Wiki_ViewClass.php
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @version    $Id: 5ad478e7b12cf03245782e338267e1b14fb6d6cb $
 */

// {{{ Wiki_ViewClass
/**
 *  View class.
 *
 *  @author     {$author}
 *  @package    Wiki
 *  @access     public
 */
class Wiki_ViewClass extends Ethna_ViewClass
{
    /**#@+
     *  @access protected
     */

    /** @var  string  set layout template file   */
    var $_layout_file = 'layout';

    /**#@+
     *  @access public
     */

    /** @var boolean  layout template use flag   */
    var $use_layout = true;

    public function __construct($backend, $forward_name, $forward_path)
    {
        parent::__construct($backend, $forward_name, $forward_path);
        $this->pm = $this->backend->getManager('page');
    }

    /**
     *  set common default value.
     *
     *  @access protected
     *  @param  object  Wiki_Renderer  Renderer object.
     */
    function _setDefault(&$renderer)
    {
    }

}
// }}}

