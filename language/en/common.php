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
// ACP
	'ACP_PSB_TITLE'	=> 'Purge subscribed topics',
	'PSB_SETTINGS'		=> 'Purge subscribed topics',
	'PSB_SETTING_SAVED'	=> 'Settings have been saved successfully!',
	'PSB_PURGE_DONE'	=> 'Topic purged successfully.',
	'PSB_NADA'		=> 'No changes made.',
	'PSB_PURGE_SETT'	=> 'Settings have been saved and topic purging done.',
	'PSB_VALIDATION'	=> 'Enable Purge subscribed topics in UCP',
	'ACP_PSB'				=> 'Settings',
	'ACP_PSB_VALIDATION'	=> 'Enable the Purge subscribed topics feature',
	'ACP_PSB_VAL_EXPLAIN'	=> 'The feature will be accessible for each user in the user control panel .',
	'ACP_PSB_NOMBRE'		=> 'Total number of subscribed topics',
	'ACP_PSB_NB_EXPLAIN'	=> 'Total number of all subscribed topics by all forum users.',
	'ACP_PSB_NOPOSTS'		=> 'Subscribed topics without new posts',
	'ACP_PSB_NOP_EXPLAIN'	=> 'Number of all subscribed topics without any new posts on this period.',
	'ACP_PSB_NOVIEW'		=> 'Subscribed topics not visited',
	'ACP_PSB_NOV_EXPLAIN'	=> 'Number of all subscribed topics without any visit on this period.',
	'ACP_PSB_DISPLAY'		=> 'Situation of subscribed topics',
	'ACP_PSB_DISPLAY_SELECT'	=> 'Display subscribed topics older than',
	'ACP_PSB_DISPLAY_EXPLAIN' => 'Display subscribed topics older than the selected number of months and without new posts or visits',
	'ACP_PSB_PURGE'		=> 'Purge subscribed topics',
	'ACP_PSB_PURGE_LABEL'	=> 'Purge subscribed topics older than',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Subscribed topics older than the number of months will be deleted for all users.',

// UCP
	'UCP_PSB_TITLE'		=> 'Your subscribed topics',
	'UCP_PSB_MANAGE'		=> 'Manage subscribed topics',
	'UCP_PSB'				=> 'Main page',
	'UCP_PSB_NOMBRE'		=> 'Grand total of subscribed topics',
	'UCP_PSB_NB_EXPLAIN'	=> 'Total number of your subscribed topics.',
	'UCP_PSB_PURGE'		=> 'Purge subscribed topics',
	'UCP_PSB_PURGE_LABEL'	=> 'Purge subscribed topics older than',
	'UCP_PSB_PURGE_EXPLAIN'	=> 'Your subscribed topics older than the number of months will be deleted.',

	'UCP_SITUATION'		=> 'Situation of subscribed topics',
	'UCP_EXPLORATION'		=> 'Exploration of subscribed topics',
	'UCP_PSB_AFFICHAGE'	=> 'Display subscribed topics older than',
	'UCP_PSB_AFF_EXPLAIN'	=> 'Display number of subscribed topics older than the number of months without a post or a visit.',
	'UCP_PSB_NB_VISIT'		=> 'Total number of topics without a visit',
	'UCP_PSB_NB_VIS_EXPLAIN'	=> 'Total number of your subscribed topics without a visit on this period.',
	'UCP_PSB_NB_POST'		=> 'Total number of topics without a new post',
	'UCP_PSB_NB_POST_EXPLAIN'	=> 'Total number of your subscribed topics without a new post on this period.',

	'UCP_PURGE_SUB'		=> 'Purge subscribed topics',
	'UCP_PURGE_VISIT'		=> 'Purge topics without visits',
	'UCP_PURGE_POSTS'		=> 'Purge topics without posts',
	'UCP_RESULT_PURGE'		=> 'Number of deleted topics: ',


// Common
	'MONTHS'				=> 'month(s)',
	'YES'				=> 'Yes',
	'NO'					=> 'No',
));

