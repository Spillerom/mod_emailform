<?php 
// No direct access
defined('_JEXEC') or die;

// 
JHTML::script('modules/mod_emailform/js/script.js');

// 
JHTML::stylesheet('modules/mod_emailform/css/style.css');

?>
<div id="nbjt-emailform-container">
    <input name="nbjt-emailform-name" id="nbjt-emailform-name" class="nbjt-emailform-input required" value="" type="text">
    <input name="nbjt-emailform-email" id="nbjt-emailform-email" class="nbjt-emailform-input required" value="" type="text">
    <input name="nbjt-emailform-phone" id="nbjt-emailform-phone" class="nbjt-emailform-input required" value="" type="text">
    <input name="nbjt-emailform-postnumber" id="nbjt-emailform-postnumber" class="nbjt-emailform-input required" value="" type="text">
    <input name="nbjt-emailform-residencesize" id="nbjt-emailform-residencesize" class="nbjt-emailform-input required" value="" type="text">
    <input name="nbjt-emailform-message" id="nbjt-emailform-message" class="nbjt-emailform-input required" value="" type="text">
</div>
