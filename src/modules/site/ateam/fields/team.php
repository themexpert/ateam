<?php
/**
 * @package aTeam Module
 * @version ##VERSION##
 * @author ThemeXpert http://www.themexpert.com
 * @copyright Copyright (C) 2010 - 2015 ThemeXpert
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 */

// no direct access
defined( '_JEXEC' ) or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldTeam extends JFormField{

    protected $type = 'Team';


    protected function getInput()
    {
        $app = JFactory::getApplication();
        if($app->isSite()){
          $adminyes = false;
        }else{
          $adminyes = true;
        }
        $existingItems = ( !empty($this->value) )? count($this->value) : 1;
        $ajaxUrl = JUri::root() . 'index.php?option=com_ajax&plugin=ateam&format=raw';

        $js = ' var itemId = 0 + ' . $existingItems . ',
                ajaxUrl = "'. $ajaxUrl .'",
                adminyes = "'. $adminyes .'",
                name = "'. $this->name .'";';

        // Include module helper
        include_once JPATH_SITE . '/plugins/ajax/ateam/ateam.php';

        // Add new button
        $html[] = '<div class="clearfix"><a href="#" class="btn btn-success action-new">+ Add New</a></div>';
        // Start accordion
        $html[] = JHtmlBootstrap::startAccordion('repeatable', array('active'=>'slide-1'));
        // Get Form from data
        $html[] = PlgAjaxATeam::buildForm( $this->name, $this->value, 1 );
        // End accordion
        $html[] = JHtmlBootstrap::endAccordion();

        // Load Admin, Sortable js file
        $admin_js       = JUri::root(true) . '/modules/mod_ateam/assets/js/ateam-admin.js';
        $sortable_js    = JUri::root(true) . '/modules/mod_ateam/assets/js/jquery-sortable.js';
        JFactory::getDocument()->addScript($sortable_js);
        JFactory::getDocument()->addScript($admin_js);

        // Css
        $admin_css          = JUri::root(true) . '/modules/mod_ateam/assets/css/ateam-admin.css';
//        $animate_css       = JUri::root(true) . '/modules/mod_ateam/assets/css/animate.css';
//        JFactory::getDocument()->addStyleSheet($animate_css);
        JFactory::getDocument()->addStyleSheet($admin_css);
        // Load media script
        $this->loadMediaScripts();

        // Load Js to DOM
        JFactory::getDocument()->addScriptDeclaration($js);

        return implode('', $html);
    }

    protected function getLabel(){
        return ;
    }


    protected function loadMediaScripts()
    {
        JHtml::_('behavior.modal');

        // Build the script.
        $script = array();
        $script[] = '	function jInsertFieldValue(value, id) {';
        $script[] = '		var $ = jQuery.noConflict();';
        $script[] = '		var old_value = $("#" + id).val();';
        $script[] = '		if (old_value != value) {';
        $script[] = '			var $elem = $("#" + id);';
        $script[] = '			$elem.val(value);';
        $script[] = '			$elem.trigger("change");';
        $script[] = '			if (typeof($elem.get(0).onchange) === "function") {';
        $script[] = '				$elem.get(0).onchange();';
        $script[] = '			}';
        $script[] = '			jMediaRefreshPreview(id);';
        $script[] = '		}';
        $script[] = '	}';

        $script[] = '	function jMediaRefreshPreview(id) {';
        $script[] = '		var $ = jQuery.noConflict();';
        $script[] = '		var value = $("#" + id).val();';
        $script[] = '		var $img = $("#" + id + "_preview");';
        $script[] = '		if ($img.length) {';
        $script[] = '			if (value) {';
        $script[] = '				$img.attr("src", "' . JUri::root() . '" + value);';
        $script[] = '				$("#" + id + "_preview_empty").hide();';
        $script[] = '				$("#" + id + "_preview_img").show()';
        $script[] = '			} else { ';
        $script[] = '				$img.attr("src", "")';
        $script[] = '				$("#" + id + "_preview_empty").show();';
        $script[] = '				$("#" + id + "_preview_img").hide();';
        $script[] = '			} ';
        $script[] = '		} ';
        $script[] = '	}';


        // Add the script to the document head.
        JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));
    }
}
