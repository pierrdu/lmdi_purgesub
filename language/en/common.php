<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'PSB_SETTINGS'		=> 'Purge subscribed topics',
	'PSB_SETTING_SAVED'	=> 'Settings have been saved successfully!',
	'PSB_PURGE_DONE'	=> 'Settings have been saved and topic purging done.',
	'PSB_VALIDATION'	=> 'Validate Purge subscribed topics in UCP',
	'ACP_PSB_TITLE'		=> 'Purge subscribed topics',
	'ACP_PSB'				=> 'Settings',
	'ACP_PSB_VALIDATION'	=> 'Validate the Purge subscribed topics feature',
	'ACP_PSB_VAL_EXPLAIN'	=> 'The feature will be accessible in the user control panel.',
	'ACP_PSB_NOMBRE'		=> 'Total number of subscribed topics',
	'ACP_PSB_NB_EXPLAIN'	=> 'Total number of all subscribed topics by all forum users.',
	'ACP_PSB_PURGE'		=> 'Purge subscribed topics',
	'ACP_PSB_PURGE_LABEL'	=> 'Purge subscribed topics older than',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Subscribed topics older than the number of months will be deleted for all users.',
	'MONTHS'				=> 'month(s)',
	'UCP_PSB_TITLE'		=> 'Purge subscribed topics',
	'UCP_PSB'				=> 'Settings',
	
));

?>
