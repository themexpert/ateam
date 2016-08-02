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
defined('_JEXEC') or die;

// Load bootstrap helper
jimport('cms.html.bootstrap');

abstract class modAteamHelper
{
    public static function loadStyleSheet()
    {
        $doc        = JFactory::getDocument();
        $template   = JFactory::getApplication()->getTemplate();
        $mod_url    = 'modules/mod_ateam/assets/css';
        $tmpl_url   = 'templates/' . $template . '/css';
        $css_file = 'ateam.css';

        if( file_exists($tmpl_url . '/' . $css_file) )
        {
            $doc->addStyleSheet(JURI::root(true) . '/'. $tmpl_url . '/' . $css_file);
        }elseif( file_exists($mod_url . '/' . $css_file) )
        {
            $doc->addStyleSheet(JURI::root(true) . '/'. $mod_url . '/' . $css_file);
        }

    }
    
}
