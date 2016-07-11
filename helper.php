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

class ModEmailFormHelper {
    //public static $user_agent;

    /**
      * Insert form data into db..
      *
      * @param  name
      * @param  email
      * @param  phone
      * @param  postnumber
      * @param  residencesize
      * @param  message
      * @param  pagetitle
      * @param  ipaddress
      * @param  browser
      * @param  os
      * @param  screenresolution
      * @param  referrerurl
      * @access public
      * @return last db insert id
      */
     private static function insertData($name, $email, $phone, $postnumber, $residencesize, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl) {
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
            ->insert($db->quoteName('#__emailform'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
 
        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();

        // Return last insert id
        return $db->insertid();
    }

    /**
     * Detect which os the user is using 
     *
     * @return os
     */
    private static function getOS() { 
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
                                '/windows nt 10/i'     =>  'Windows 10',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile'
                            );

        foreach ($os_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $os_platform    =   $value;
            }
        }   

        return $os_platform;
    }

    /**
     * Insert form data into db..
     *
     * @return browser
     */
    private static function getBrowser() {
        //global $user_agent;
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        =   "Unknown Browser";
        $browser_array  =   array(
                                '/msie/i'       =>  'Internet Explorer',
                                '/firefox/i'    =>  'Firefox',
                                '/safari/i'     =>  'Safari',
                                '/chrome/i'     =>  'Chrome',
                                '/edge/i'       =>  'Edge',
                                '/opera/i'      =>  'Opera',
                                '/netscape/i'   =>  'Netscape',
                                '/maxthon/i'    =>  'Maxthon',
                                '/konqueror/i'  =>  'Konqueror',
                                '/mobile/i'     =>  'Handheld Browser'
                            );

        foreach ($browser_array as $regex => $value) { 
            if (preg_match($regex, $user_agent)) {
                $browser    =   $value;
            }
        }

        return $browser;
    }

    /**
     * Get post variable
     *
     * @param var 
     * @return variable value (if variable is set)
     */
    private static function GetPostVar($var) {
        // 
        if( !isset($_POST[$var] )) {
            die('{"status":"error","message":"'.$var.' mangler. Alle feltene må være utfyllt."}');
        } else {
            return $_POST[$var];
        }
    }

    /**
     * Insert form data into db..
     *
     * @return last db insert id
     */
    public static function storeFormData() {
        $name = GetPostVar('name');
        $email = GetPostVar('email');
        $phone = GetPostVar('phone');
        $postnumber = GetPostVar('postnumber');
        $residencesize = GetPostVar('residencesize');
        $message = GetPostVar('message');
        $pagetitle = GetPostVar('pagetitle');
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $browser = getBrowser();
        $os = getOS();
        $screenresolution = GetPostVar('screenresolution');
        $referrerurl = GetPostVar('referrerurl');

        echo '{"status":"ok","insert_id": '.$id.',"message":"Takk for din henvendelse!"}';

        //
        $id = ModEmailFormHelper::insertData($name, $email, $phone, $postnumber, $residencestyle, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl);

        // 
        echo '{"status":"ok","insert_id": '.$id.',"message":"Takk for din henvendelse!"}';

    }
}

