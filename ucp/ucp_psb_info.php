<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
* General subscription management module
*
* @copyright (c) 2015-2018 Pierre Duhem - LMDI
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
			'title'		=> 'UCP_PSB_TITLE',
			'version'		=> '1.0.0',
			'modes'		=> array(
				'purgesub' => array('title' => 'UCP_PSB_MANAGE',
							'auth' => 'ext_lmdi/purgesub',
							'cat' => array('UCP_PSB_TITLE')),
				'purgesub1' => array('title' => 'UCP_PSB_MANAGEF',
							'auth' => 'ext_lmdi/purgesub',
							'cat' => array('UCP_PSB_TITLE')),
				'purgesub2' => array('title' => 'UCP_PSB_MANAGET',
							'auth' => 'ext_lmdi/purgesub',
							'cat' => array('UCP_PSB_TITLE')),
			),
		);
	}

}
