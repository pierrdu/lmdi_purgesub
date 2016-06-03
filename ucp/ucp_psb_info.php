<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015-2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace lmdi\purgesub\ucp;

class ucp_psb_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\purgesub\ucp\ucp_psb_module',
			'title'     	=> 'UCP_PSB_TITLE',
			'version'   	=> '1.0.0',
			'modes'		=> array(
				'purgesub' => array('title' => 'UCP_PSB',
							'auth' => 'ext_lmdi/purgesub',
							'cat' => array('UCP_PSB_TITLE')),
			),
		);
	}

}
