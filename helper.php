<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Site
 * @subpackage mod_emailform
 * @license        GNU/GPL, see LICENSE.php
 * mod_emailform is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

class ModEmailFormHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getHello($params)
    {
        return 'Hello, World!';
    }
}

