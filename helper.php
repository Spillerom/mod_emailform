<?php
/**
 * Helper class for Email Form module
 * 
 * @package    Joomla.Site
 * @subpackage m
 * @license        GNU/GPL, see LICENSE.php
 * mod_emailform is free software. This version may have been modified t
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;

class ModEmailFormHelper
{
    /**
      * Insert form data into db..
      *
      * @param  array
      * @access public
      * @return last db insert id
      */
    public static function storeFormData($name, $email, $phone, $postnumber, $residencesize, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl) {
        // Get a db connection.
        $db = JFactory::getDbo();
 
        // Create a new query object.
        $query = $db->getQuery(true);
 
        // Insert columns.
        $columns = array('name', 'email', 'phone', 'postnumber', 'residencesize', 'message', 'pagetitle', 'idaddress', 'browser', 'os', 'screenresolution', 'referrerurl');
 
        // Insert values.
        $values = array($name, $email, $phone, $postnumber, $residencesize, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl);
 
        // Prepare the insert query.
        $query
            ->insert($db->quoteName('#__user_profiles'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
 
        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();

        // Return last insert id
        return $db->insertid();
    }
}

