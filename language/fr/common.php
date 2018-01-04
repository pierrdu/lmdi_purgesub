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
	'ACP_PSB_TITLE'	=> 'Délestage des sujets surveillés',
	'PSB_SETTINGS'		=> 'Délestage des sujets surveillés',
	'PSB_SETTING_SAVED'	=> 'Les paramètres ont été sauvegardés.',
	'PSB_PURGE_DONE'	=> 'Le délestage a bien été effectué.',
	'PSB_PURGE_SETT'	=> 'Les paramètres ont été sauvegardés et le délestage effectué.',
	'PSB_NADA'		=> 'Aucun changement effectué.',
	'PSB_VALIDATION'	=> 'Validation de la fonction dans le Panneau de l’utilisateur',
	'ACP_PSB'			=> 'Configuration de l’extension',
	'ACP_PSB_VALIDATION'	=> 'Validation de la fonction',
	'ACP_PSB_VAL_EXPLAIN'	=> 'La fonction sera accessible dans le panneau de l’utilisateur.',
	'ACP_PSB_PURGE'		=> 'Délestage des sujets surveillés',
	'ACP_PSB_NOMBRE'		=> 'Nombre total de sujets surveillés',
	'ACP_PSB_NB_EXPLAIN'	=> 'Il s’agit du nombre total de sujets surveillés par tous les utilisateurs du forum.',
	'ACP_PSB_NOPOSTS'		=> 'Sujets surveillés sans nouveaux messages',
	'ACP_PSB_NOP_EXPLAIN'	=> 'Nombre total des sujets surveillés sans nouveaux messages au cours de cette période.',
	'ACP_PSB_NOVIEW'		=> 'Sujets surveillés sans nouvelle visite',
	'ACP_PSB_NOV_EXPLAIN'	=> 'Nombre total des sujets surveillés sans nouvelle visite au cours de cette période.',
	'ACP_PSB_DISPLAY'		=> 'Situation des sujets surveillés',
	'ACP_PSB_DISPLAY_SELECT'	=> 'Affichage des sujets plus anciens que',
	'ACP_PSB_DISPLAY_EXPLAIN' => 'Affichage des sujets surveillés plus anciens que le nombre sélectionné de mois.',
	'ACP_PSB_PURGE'		=> 'Délestage des sujets surveillés',
	'ACP_PSB_PURGE_LABEL'	=> 'Délestage des sujets plus anciens que',
	'ACP_PSB_PURGE_EXPLAIN'	=> 'Les sujets surveillés plus anciens que le nombre de mois ci-contre seront supprimés pour tous les utilisateurs.',

// UCP
	'UCP_PSB_TITLE'		=> 'Surveillances',
	'UCP_PSB_MANAGE'		=> 'Gestion des surveillances',
	'UCP_PSB_MANAGEF'		=> 'Gestion des forums surveillés',
	'UCP_PSB_MANAGET'		=> 'Gestion des sujets surveillés',
	'UCP_PSB_FORUMS'		=> 'Surveillance des forums',
	'UCP_PSB_TOPICS'		=> 'Surveillance des sujets',
	'UCP_PSB_NOMBRE'		=> 'Nombre total des sujets surveillés',
	'UCP_PSB_NB_EXPLAIN'	=> 'Il s’agit du nombre total des sujets que vous surveillez.',
	'UCP_PSB_PURGE_LABEL'	=> 'Délestage des sujets ayant plus de',
	'UCP_PSB_PURGE_EXPLAIN'	=> 'Les sujets surveillés plus anciens que le nombre de mois ci-contre seront supprimés.',
	'UCP_SITUATION'		=> 'Sujets surveillés',
	'UCP_EXPLORATION'		=> 'Analyse des sujets surveillés',
	'UCP_PSB_AFFICHAGE'		=> 'Nombre de sujets ayant plus de',
	'UCP_PSB_AFF_EXPLAIN'	=> 'Affichage des sujets surveillés plus anciens que le nombre de mois ci-contre sans nouvelle visite ou sans nouveau message.',
	'UCP_PSB_NB_VISIT'		=> 'Nombre des sujets sans nouvelle visite',
	'UCP_PSB_NB_VIS_EXPLAIN'	=> 'Nombre total des sujets que vous surveillez qui n’ont pas reçu de nouvelle visite au cours de la période définie ci-dessus.',
	'UCP_PSB_NB_POST'		=> 'Nombre des sujets sans nouveau message',
	'UCP_PSB_NB_POST_EXPLAIN'	=> 'Nombre total des sujets que vous surveillez qui n’ont pas reçu de nouveau message au cours de la période définie ci-dessus.',
	'UCP_PURGE_SUB'		=> 'Délestage des sujets surveillés',
	'UCP_PURGE_VISIT'		=> 'Délestage des sujets non visités',
	'UCP_PURGE_POSTS'		=> 'Délestage des sujets sans messages',
	'UCP_RESULT_PURGE'		=> 'Nombre de sujets supprimés : ',
	'UCP_WATCHEDF_EXPLAIN'			=> 'Vous trouverez ci-dessous la liste des forums que vous surveillez, afin d’être informé de nouveaux messages qui y sont publiés. Pour arrêter de surveiller, cochez le forum et cliquez sur le bouton <em>Ne plus surveiller</em>.',
	'UCP_WATCHEDT_EXPLAIN'			=> 'Vous trouverez ci-dessous la liste des sujets que vous surveillezafin d’être informé de nouveaux messages qui y sont publiés. Pour arrêter de surveiller, cochez le sujet et cliquez sur le bouton <em>Ne plus surveiller</em>.',


// Common
	'MONTHS'				=> 'mois',
	'YES'				=> 'Oui',
	'NO'					=> 'Non',

));
