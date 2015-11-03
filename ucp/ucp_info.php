<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace lmdi\purgesub\ucp;

class portal_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\purgesub\ucp\ucp_module',
			'title'     => 'UCP_PSB_TITLE',
			'version'   => '1.0.0',
			'modes'		=> array(
				'settings'	=> array('title' => 'UCP_PSB', 'auth' => 'ext_lmdi/purgesub && acl_a_board', 'cat' => array('UCP_PSB_TITLE')),
			),
		);
	}

}
