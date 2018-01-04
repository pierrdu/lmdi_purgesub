<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015-2018 Pierre Duhem - LMDI
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
	'PSB_VALIDATION'	=> 'Enable subscription management in UCP',
	'ACP_PSB'				=> 'Extension settings',
	'ACP_PSB_VALIDATION'	=> 'Enable the subscription management feature',
	'ACP_PSB_VAL_EXPLAIN'	=> 'The feature will be accessible for each user in the user control panel.',
	'ACP_PSB_NOMBRE'		=> 'Total number of subscribed topics',
	'ACP_PSB_NB_EXPLAIN'	=> 'Total number of all subscribed topics by all forum users.',
	'ACP_PSB_NOPOSTS'		=> 'Subscribed topics without new posts',
	'ACP_PSB_NOP_EXPLAIN'	=> 'Number of all subscribed topics without any new posts on this period.',
	'ACP_PSB_NOVIEW'		=> 'Subscribed topics not visited',
	'ACP_PSB_NOV_EXPLAIN'	=> 'Number of all subscribed topics without any visit on this period.',
	'ACP_PSB_DISPLAY'		=> 'Situation of subscribed topics',
	'ACP_PSB_DISPLAY_SELECT'	=> 'Display subscribed topics older than',
	'ACP_PSB_DISPLAY_EXPLAIN' => 'Display subscribed topics older than the selected number of months and without new posts or visits',
	'ACP_PSB_PURGE'		=> 'Purge subscriptions',
	'ACP_PSB_PURGE_LABEL'	=> 'Purge subscriptions older than',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Subscriptions older than the number of months will be deleted for all users.',

// UCP
	'UCP_PSB_TITLE'		=> 'Subscriptions',
	'UCP_PSB_MANAGE'		=> 'Manage subscriptions',
	'UCP_PSB_MANAGEF'		=> 'Manage subscribed forums',
	'UCP_PSB_MANAGET'		=> 'Manage subscribed topics',
	'UCP_PSB_FORUMS'		=> 'Forums subscriptions',
	'UCP_PSB_TOPICS'		=> 'Topics subscriptions',
	'UCP_PSB_NOMBRE'		=> 'Grand total of subscribed topics',
	'UCP_PSB_NB_EXPLAIN'	=> 'Total number of your subscribed topics.',
	'UCP_PSB_PURGE'		=> 'Purge subscribed topics',
	'UCP_PSB_PURGE_LABEL'	=> 'Purge subscribed topics older than',
	'UCP_PSB_PURGE_EXPLAIN'	=> 'Your subscription to topics older than the number of months will be deleted.',

	'UCP_SITUATION'		=> 'Subscribed topics',
	'UCP_EXPLORATION'		=> 'Analyse of subscribed topics',
	'UCP_PSB_AFFICHAGE'		=> 'Number of subscribed topics older than',
	'UCP_PSB_AFF_EXPLAIN'	=> 'Display the number of subscribed topics older than the number of months without a new post or a new visit.',
	'UCP_PSB_NB_VISIT'		=> 'Topics without a new visit',
	'UCP_PSB_NB_VIS_EXPLAIN'	=> 'Total number of your subscribed topics without a visit in this period.',
	'UCP_PSB_NB_POST'		=> 'Topics without a new post',
	'UCP_PSB_NB_POST_EXPLAIN'	=> 'Total number of your subscribed topics without a new post in this period.',

	'UCP_PURGE_SUB'		=> 'Purge subscribed topics',
	'UCP_PURGE_VISIT'		=> 'Purge topics without new visits',
	'UCP_PURGE_POSTS'		=> 'Purge topics without new posts',
	'UCP_RESULT_PURGE'		=> 'Number of deleted subscriptions: ',
	'UCP_WATCHEDF_EXPLAIN'	=> 'Below is a list of forums you are subscribed to. You will be notified of new posts in each one. To unsubscribe mark the forum and then press the <em>Unwatch marked</em> button.',
	'UCP_WATCHEDT_EXPLAIN'	=> 'Below is a list of topics you are subscribed to. You will be notified of new posts in each one. To unsubscribe mark the topic and then press the <em>Unwatch marked</em> button.',


// Common
	'MONTHS'				=> 'month(s)',
	'YES'				=> 'Yes',
	'NO'					=> 'No',
));
