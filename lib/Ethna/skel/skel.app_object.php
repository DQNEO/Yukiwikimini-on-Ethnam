<?php
/**
 *  {$app_path}
 *
 *  @author     {$author}
 *  @package    {$project_id}
 *  @version    $Id: 2043ca0d5627d5248d0761d3846d06ba3009300d $
 */

/**
 *  {$app_object}Manager
 *
 *  @author     {$author}
 *  @access     public
 *  @package    {$project_id}
 */
class {$app_object}Manager extends Ethna_AppManager
{
}

/**
 *  {$app_object}
 *
 *  @author     {$author}
 *  @access     public
 *  @package    {$project_id}
 */
class {$app_object} extends Ethna_AppObject
{
    /**
     *  property display name getter.
     *
     *  @access public
     */
    function getName($key)
    {
        return $this->get($key);
    }
}

