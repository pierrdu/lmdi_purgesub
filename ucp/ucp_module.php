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

use lmdi\purgesub;

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Note to potential users of this code ...
*
* Remember this is released under the _GPL_ and is subject
* to that licence. Do not incorporate this within software
* released or distributed in any way under a licence other
* than the GPL. We will be watching ... ;)
*
* @package ucp
*/
class portal_module
{
	var $u_action;

	private $dataleft, $datacenter, $dataright;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;
		global $helper, $root_path, $php_ext, $content_visibility;

		$this->tpl_name = 'ucp_purgesub';

		$form_key = 'ucp_purgesub';
		add_form_key($form_key);

		$user_id = $user->data['user_id'];

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('ucp_purgesub'))
				{
					trigger_error('FORM_INVALID');
				}
		}


		$template->assign_vars(array(
			'SWITCH'           => $mode,
			'MESSAGE'          => $message,
			'CHECKBOX'         => ($mode == 'delete') ? 1 : 0,
			'DATA_LEFT'        => $dataleft,
			'DATA_CENTER'      => $datacenter,
			'DATA_RIGHT'       => $dataright,
			'L_TITLE'          => $user->lang['UCP_K_BLOCKS_' . strtoupper($mode)],
			'S_HIDDEN_FIELDS'  => $s_hidden_fields,
			'S_UCP_ACTION'     => $this->u_action,
		));
	}
}

}
