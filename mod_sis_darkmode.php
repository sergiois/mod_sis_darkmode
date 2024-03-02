<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_sis_darkmode
 *
 * @copyright	Copyright © 2024 - All rights reserved.
 * @license		GNU General Public License v2.0
 * @author 		Sergio Iglesias (@sergiois)
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

require ModuleHelper::getLayoutPath('mod_sis_darkmode', $params->get('layout', 'default'));
