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

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

// Load MVC style css file
modAteamHelper::loadStyleSheet();

require JModuleHelper::getLayoutPath('mod_ateam', $params->get('layout', 'default'));
