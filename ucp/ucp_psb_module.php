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

/**
* Class name must be the same as the file name.
* @package ucp
*/

class ucp_psb_module
{
	/** @var \phpbb\db\driver\driver_interface */
	protected $db;
	/** @var \phpbb\user */
	protected $user;
	public $u_action;
	public $tpl_name;
	public $page_title;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx, $table_prefix;
		global $helper, $root_path, $php_ext, $content_visibility;

		$this->user = $user;
		$this->db = $db;

		$this->tpl_name = 'ucp_psb';
		$this->page_title = $user->lang('UCP_PSB_MANAGE');
		$uid = $this->user->data['user_id'];

		$nbp = 0;
		$nbv = 0;
		$nba = 0;
		$nbma = 0;
		$nbmp = 0;

		// Submission
		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('ucp_psb'))
			{
				trigger_error('FORM_INVALID');
			}
			// Display number of older topics
			$nbma = $request->variable('nbma', 0);
			if ($nbma)
			{
				// Older topics without posts
				$sql  = "SELECT COUNT(*) as nb ";
				$sql .= " FROM " . TOPICS_WATCH_TABLE;
				$sql .= " INNER JOIN " . TOPICS_TABLE;
				$sql .= " WHERE " . TOPICS_WATCH_TABLE . ".topic_id = ";
				$sql .= TOPICS_TABLE . ".topic_id AND ";
				$sql .= TOPICS_WATCH_TABLE . ".user_id = $uid AND ";
				$sql .= "(FROM_UNIXTIME(". TOPICS_TABLE . ".topic_last_post_time)) < ";
				$sql .= "date_sub(now(), interval $nbma month)";
				// var_dump ($sql);
				$res = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($res);
				$nbp  = $row['nb'];
				$this->db->sql_freeresult($res);
				// Idem, without visits
				$sql  = "SELECT COUNT(*) as nb ";
				$sql .= " FROM " . TOPICS_WATCH_TABLE;
				$sql .= " INNER JOIN " . TOPICS_TABLE;
				$sql .= " WHERE " . TOPICS_WATCH_TABLE . ".topic_id = ";
				$sql .= TOPICS_TABLE . ".topic_id AND ";
				$sql .= TOPICS_WATCH_TABLE . ".user_id = $uid AND ";
				$sql .= "(FROM_UNIXTIME(". TOPICS_TABLE . ".topic_last_view_time)) < ";
				$sql .= "date_sub(now(), interval $nbma month)";
				// var_dump ($sql);
				$res = $this->db->sql_query($sql);
				$row = $this->db->sql_fetchrow($res);
				$nbv  = $row['nb'];
				$this->db->sql_freeresult($res);
			}

			// Topics to be purged
			$nbmp = $request->variable('nbmp', 0);
			$purgep = $request->variable('purgep', 0);
			$purgev = $request->variable('purgev', 0);
			if ($nbmp) 
			{
				if ($purgep)
				{
					$sql  = "DELETE " . TOPICS_WATCH_TABLE;
					$sql .= " FROM " . TOPICS_WATCH_TABLE;
					$sql .= " INNER JOIN " . TOPICS_TABLE;
					$sql .= " WHERE " . TOPICS_WATCH_TABLE . ".topic_id = ";
					$sql .= TOPICS_TABLE . ".topic_id AND ";
					$sql .= TOPICS_WATCH_TABLE . ".user_id = $uid AND ";
					$sql .= "(FROM_UNIXTIME(". TOPICS_TABLE . ".topic_last_post_time)) < ";
					$sql .= "date_sub(now(), interval $nbmp month)";
					// var_dump ($sql);
					$this->db->sql_query($sql);
					$delp = $this->db->sql_affectedrows();
				}
				if ($purgev)
				{
					$sql  = "DELETE " . TOPICS_WATCH_TABLE;
					$sql .= " FROM " . TOPICS_WATCH_TABLE;
					$sql .= " INNER JOIN " . TOPICS_TABLE;
					$sql .= " WHERE " . TOPICS_WATCH_TABLE . ".topic_id = ";
					$sql .= TOPICS_TABLE . ".topic_id AND ";
					$sql .= TOPICS_WATCH_TABLE . ".user_id = $uid AND ";
					$sql .= "(FROM_UNIXTIME(". TOPICS_TABLE . ".topic_last_view_time)) < ";
					$sql .= "date_sub(now(), interval $nbmp month)";
					// var_dump ($sql);
					$this->db->sql_query($sql);
					$delv = $this->db->sql_affectedrows();
				}
				$del = $delp + $delv;
				if ($del)
				{
					// Information message
					$message = 'UCP_RESULT_PURGE' . $del;
					$params = "i=-lmdi-purgesub-ucp-ucp_psb_module&mode=purgesub";
					meta_refresh (3, append_sid("{$phpbb_root_path}ucp.$phpEx", $params));
					trigger_error($message);
				}
			}
		}

		// Total number of subscribed topics at this point of time (after or before)
		$sql = "select count(*) as nb from " . TOPICS_WATCH_TABLE;
		$sql .= " WHERE user_id = $uid";
		$this->db->sql_query($sql);
		// var_dump ($sql);
		$res = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($res);
		$nbt  = $row['nb'];
		$this->db->sql_freeresult($res);

		// Form and page display
		$form_key = 'ucp_psb';
		add_form_key($form_key);
		if (!$nbv)
		{
			$nbv = $nbt;
		}
		if (!$nbp)
		{
			$nbp = $nbt;
		}
		$template->assign_vars(array(
			'L_TITLE'  		=> $user->lang['UCP_PSB_TITLE'],
			'S_UCP_ACTION' 	=> $this->u_action,
			'UCP_PSB_NBT'		=> $nbt,
			'UCP_PSB_NBP'		=> $nbp,
			'UCP_PSB_NBV'		=> $nbv,
			'PSB_NBA'			=> $nbma,
			'PSB_NBP'			=> $nbmp,
		));
	}
}
