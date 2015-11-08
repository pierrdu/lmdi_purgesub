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

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* Class name must be the same as the file name.
* @package ucp
*/

class ucp_psb_module
{
	public $u_action;
	public $tpl_name;
	public $page_title;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;
		global $helper, $root_path, $php_ext, $content_visibility;

		$this->tpl_name = 'ucp_psb';
		$this->page_title = $user->lang('UCP_PSB_MANAGE');

		$form_key = 'ucp_psb';
		add_form_key($form_key);

		$user_id = $user->data['user_id'];

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('ucp_psb'))
				{
					trigger_error('FORM_INVALID');
				}
		}


		$template->assign_vars(array(
			'SWITCH'           => $mode,
			'CHECKBOX'         => ($mode == 'delete') ? 1 : 0,
			'L_TITLE'          => $user->lang['UCP_PSB_TITLE'],
			'S_UCP_ACTION'     => $this->u_action,
		));
	}
}

