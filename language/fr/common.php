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
	'PSB_SETTINGS'		=> 'Délestage des sujets surveillés',
	'PSB_SETTING_SAVED'	=> 'Les paramètres ont été sauvegardés.',
	'PSB_PURGE_DONE'	=> 'Les paramètres ont été sauvegardés et le délestage effectué.',
	'PSB_VALIDATION'	=> 'Validation du délestage dans le Panneau de l\'utilisateur',
	'ACP_PSB_TITLE'		=> 'Délestage des sujets surveillés',
	'ACP_PSB'			=> 'Paramètres',
	'ACP_PSB_VALIDATION'	=> 'Validation de la fonction',
	'ACP_PSB_VAL_EXPLAIN'	=> 'La fonction sera accessible dans le panneau de l\'utilisateur.',
	'ACP_PSB_PURGE'		=> 'Délestage des sujets surveillés',
	'ACP_PSB_NOMBRE'		=> 'Nombre total de sujets surveillés',
	'ACP_PSB_NB_EXPLAIN'	=> 'Il s\'agit du nombre total de sujets surveillés par tous les utilisateurs du forum.',
	'ACP_PSB_PURGE_LABEL'	=> 'Délestage des sujets plus anciens que',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Les sujets surveillés plus anciens que le nombre de mois ci-contre seront supprimés pour tous les utilisateurs.',
	'MONTHS'				=> 'mois',
	'UCP_PSB_TITLE'		=> 'Délestage des sujets surveillés',
	'UCP_PSB'			=> 'Paramètres',
	
));

?>
