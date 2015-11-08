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
	'ACP_PSB_TITLE'	=> 'Délestage des sujets surveillés',
	'PSB_SETTINGS'		=> 'Délestage des sujets surveillés',
	'PSB_SETTING_SAVED'	=> 'Les paramètres ont été sauvegardés.',
	'PSB_PURGE_DONE'	=> 'Le délestage a bien été effectué.',
	'PSB_PURGE_SETT'	=> 'Les paramètres ont été sauvegardés et le délestage effectué.',
	'PSB_NADA'		=> 'Aucun changement effectué.',
	'PSB_VALIDATION'	=> 'Validation du délestage dans le Panneau de l\'utilisateur',
	'ACP_PSB'			=> 'Paramètres',
	'ACP_PSB_VALIDATION'	=> 'Validation de la fonction',
	'ACP_PSB_VAL_EXPLAIN'	=> 'La fonction sera accessible dans le panneau de l\'utilisateur.',
	'ACP_PSB_PURGE'		=> 'Délestage des sujets surveillés',
	'ACP_PSB_NOMBRE'		=> 'Nombre total de sujets surveillés',
	'ACP_PSB_NB_EXPLAIN'	=> 'Il s\'agit du nombre total de sujets surveillés par tous les utilisateurs du forum.',
	'ACP_PSB_PURGE_LABEL'	=> 'Délestage des sujets plus anciens que',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Les sujets surveillés plus anciens que le nombre de mois ci-contre seront supprimés pour tous les utilisateurs.',
	'MONTHS'				=> 'mois',
// UCP
	'UCP_PSB_TITLE'		=> 'Délestage des sujets surveillés',
	'UCP_PSB_MANAGE'		=> 'Gestion des sujets surveillés',
	'UCP_PSB'				=> 'Délestage des sujets surveillés',
// MCP
	'MCP_FOO'				=> 'Module MCP',
	'MCP_PAGE_TITLE'		=> 'Page MCP',
	'MCP_PAGE_MODE_ONE_TITLE'	=> 'Sous-page MCP 1',
	'MCP_PAGE_MODE_TWO_TITLE'	=> 'Sous-page MCP 2',


// Module de suppression
	'ACL_U_MY_ACC_POST_DELETE'	=> 'Peut supprimer ses messages lors de la suppression de son compte.',
	'UCP_PROFILE_MY_ACC_DELETE'	=> 'Supprimer votre compte',
	'LOG_MY_ACC_DELETE'			=> '<strong>Suppression du compte de l’utilisateur</strong><br />» %s',
	'LOG_MY_ACC_POST_DELETE'	=> '<strong>Suppression du compte de l’utilisateur et de ses messages</strong><br />» %s',
	'MY_ACC_DELETE_CONFIRM'			=> 'Confirmer la suppression de votre compte',
	'MY_ACC_DELETE_CONFIRM_ERROR'	=> 'La suppression de votre compte n’a pas été confirmée.',
	'MY_ACC_DELETE_EXPLAIN'			=> 'Avant de supprimer votre compte :<br /><em>Veuillez noter que, si vous le faites vos données ne pourront pas être restaurées !</em>',
	'MY_ACC_DELETE_FOUNDER_ERROR'	=> 'Les fondateurs du forum ne peuvent pas supprimer leur compte.',
	'MY_ACC_DELETE_SUCCESS'			=> 'Votre compte a été supprimé avec succès',
	'MY_ACC_POST_DELETE'			=> 'Supprimer vos messages',
	'MY_ACC_POST_DELETE_EXPLAIN'	=> 'Vos messages seront supprimés du forum.',
	
));

?>
