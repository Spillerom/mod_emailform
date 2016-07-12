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


    // 
    private static function sendMail($subject, $body, $to, $from) {
        # Invoke JMail Class
        $mailer = JFactory::getMailer();

        # Set sender array so that my name will show up neatly in your inbox
        $mailer->setSender($from);

        # Add a recipient -- this can be a single address (string) or an array of addresses
        $mailer->addRecipient($to);

        $mailer->setSubject($subject);
        $mailer->setBody($body);

        # If you would like to send as HTML, include this line; otherwise, leave it out
        $mailer->isHTML();

        # Send once you have set all of your options
        $mailer->send();
    }

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
        $columns = array('name', 'email', 'phone', 'postnumber', 'residencesize', 'message', 'pagetitle', 'ipaddress', 'browser', 'os', 'screenresolution', 'referrerurl');
 
        // Insert values.
        $values = array($db->quote($name), $db->quote($email), $db->quote($phone), $db->quote($postnumber), $db->quote($residencesize), $db->quote($message), $db->quote($pagetitle), $db->quote($ipaddress), $db->quote($browser), $db->quote($os), $db->quote($screenresolution), $db->quote($referrerurl) );
 
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
     * Insert form data into db..
     *
     * @return last db insert id
     */
    public static function storeFormDataAjax() {
        // 
        $name = JRequest::getVar('name');
        $email = JRequest::getVar('email');
        $phone = JRequest::getVar('phone');
        $postnumber = JRequest::getVar('postnumber');
        $residencesize = JRequest::getVar('residencesize');
        $message = JRequest::getVar('message');
        $pagetitle = JRequest::getVar('pagetitle');
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        $browser = ModEmailFormHelper::getBrowser();
        $os = ModEmailFormHelper::getOS();
        $screenresolution = JRequest::getVar('screenresolution');
        $referrerurl = JRequest::getVar('referrerurl');

        //
        $id = ModEmailFormHelper::insertData($name, $email, $phone, $postnumber, $residencesize, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl);

        $body = '';
        $body .= '<br><br>';
        $body .= 'Ticket: [#'.$id.']';
        $body .= 'Navn: '.$name;
        $body .= 'E-post: '.$email;
        $body .= 'Telefon: '.$phone;
        $body .= 'Postnummer: '.$postnumber;
        $body .= 'Størrelse på din bolig: '.$residencesize;
        $body .= 'Melding til oss: '.$message;
        $body .= 'Sidetittel: '.$pagetitle;
        $body .= 'ip-adresse: '.$ipaddress;
        $body .= 'Nettleser: '.$browser;
        $body .= 'Operativsystem: '.$os;
        $body .= 'Skjermoppløsning: '.$screenresolution;
        $body .= '<br><br>';

        $to = $email;

        //$from = array("post@pingvinklima.com", "General.no");
        $from = "post@pingvinklima.com";
        ModEmailFormHelper::sendMail("Uforpliktende tilbud", $body, $to, $from);

        // 
        die('{"status":"ok","message":"Takk for din henvendelse!"}');

    }
}

