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
	'PSB_VALIDATION'	=> 'Validate Purge subscribed topics in UCP',
	'ACP_PSB'				=> 'Settings',
	'ACP_PSB_VALIDATION'	=> 'Validate the Purge subscribed topics feature',
	'ACP_PSB_VAL_EXPLAIN'	=> 'The feature will be accessible in the user control panel.',
	'ACP_PSB_NOMBRE'		=> 'Total number of subscribed topics',
	'ACP_PSB_NB_EXPLAIN'	=> 'Total number of all subscribed topics by all forum users.',
	'ACP_PSB_PURGE'		=> 'Purge subscribed topics',
	'ACP_PSB_PURGE_LABEL'	=> 'Purge subscribed topics older than',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Subscribed topics older than the number of months will be deleted for all users.',
	'MONTHS'				=> 'month(s)',
// UCP
	'UCP_PSB_TITLE'		=> 'Purge subscribed topics',
	'UCP_PSB_MANAGE'		=> 'Manage subscribed topics',
	'UCP_PSB'				=> 'Purge subscribed topics',
// MCP
	'MCP_FOO'				=> 'MCP Module',
	'MCP_PAGE_TITLE'		=> 'MCP Page',
	'MCP_PAGE_MODE_ONE_TITLE'	=> 'Subpage MCP 1',
	'MCP_PAGE_MODE_TWO_TITLE'	=> 'Subpage MCP 2',
	
// Module de suppression
	'ACL_U_MY_ACC_POST_DELETE'	=> 'Can delete posts when deleting registration',
	'UCP_PROFILE_MY_ACC_DELETE'	=> 'Delete my registration',
	'LOG_MY_ACC_DELETE'			=> '<strong>Delete my registration</strong><br />» %s',
	'LOG_MY_ACC_POST_DELETE'	=> '<strong>Delete my registration along with the posts.</strong><br />» %s',
	'MY_ACC_DELETE_CONFIRM'			=> 'Delete my registration confirmation',
	'MY_ACC_DELETE_CONFIRM_ERROR'	=> 'Deletion of registration has not been confirmed!',
	'MY_ACC_DELETE_EXPLAIN'			=> 'Delete my registration<br /><em>Please note, if you do then there is no way to restore your data!</em>',
	'MY_ACC_DELETE_FOUNDER_ERROR'	=> 'Board founders can not delete their registration!',
	'MY_ACC_DELETE_SUCCESS'			=> 'Registration is successfully deleted',
	'MY_ACC_POST_DELETE'			=> 'Post delete',
	'MY_ACC_POST_DELETE_EXPLAIN'	=> 'your posts will be deleted on the board',
	
));

?>
