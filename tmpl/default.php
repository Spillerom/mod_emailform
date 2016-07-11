<?php 
// No direct access
defined('_JEXEC') or die;

// load jQuery, if not loaded before
$doc = JFactory::getDocument();
if (!JFactory::getApplication()->get('jquery')) {
    JFactory::getApplication()->set('jquery', true);
    JHtml::_('jquery.framework');
}

// 
JHTML::script('modules/mod_emailform/js/script.js');

// 
JHTML::stylesheet('modules/mod_emailform/css/style.css');

?>
<div id="nbjt-emailform-container">
    <input name="nbjt-emailform-name" type="text"id="nbjt-emailform-name" class="nbjt-emailform-input required" placeholder="Navn">
    <input name="nbjt-emailform-email" type="text" id="nbjt-emailform-email" class="nbjt-emailform-input required" placeholder="E-post">
    <input name="nbjt-emailform-phone" type="text" id="nbjt-emailform-phone" class="nbjt-emailform-input required" placeholder="Telefon">
    <input name="nbjt-emailform-postnumber" type="text" id="nbjt-emailform-postnumber" class="nbjt-emailform-input required" placeholder="Postnummer">
    <input name="nbjt-emailform-residencesize" type="text" id="nbjt-emailform-residencesize" class="nbjt-emailform-input required" placeholder="Størrelse på din bolig?">
    <input name="nbjt-emailform-message" type="text" id="nbjt-emailform-message" class="nbjt-emailform-input required" placeholder="Evt. melding til oss">
    <p class="nbjt-emailform-error"></p>
    <p class="nbjt-emailform-description">Vurderer du å installere varmepumpe? IKKE VENT, FÅ <span>GRATIS BEFARING NÅ!</span></p>
    <button type="button" id="nbjt-emailform-button" class="btn">JA TAKK, JEG ØNSKER TILBUD</button> 

</div>
