<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\purgesub\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\purgesub\acp\main_module',
			'title'		=> 'ACP_PSB_TITLE',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_PSB', 'auth' => 'ext_lmdi/purgesub && acl_a_board', 'cat' => array('ACP_PSB_TITLE')),
			),
		);
	}
}
