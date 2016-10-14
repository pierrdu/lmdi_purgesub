<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015-2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\purgesub\acp;

class main_module
{
	var $table;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \vse\similartopics\core\fulltext_support */
	protected $fulltext;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $php_ext;

	/** @var string */
	public $page_title;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $u_action;


	function main ($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;
		global $table_prefix;

		$this->db = $db;

		$user->add_lang('acp/common');
		$this->tpl_name = 'acp_body';
		$this->page_title = $user->lang('ACP_PSB_TITLE');
		add_form_key('lmdi/purgesub');
		$nbma = 0;
		$nbmp = 0;

		// Data submitted
		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('lmdi/purgesub'))
			{
				trigger_error('FORM_INVALID');
			}
			$nbma = $request->variable('nbma', 0);
			// Register the setting for the UCP in the config table if changed.
			$cod1 = $config['lmdi_purge_ucp'];
			$cod2 = $request->variable('psb_validation', 0);
			$mess = 0;
			if ($cod1 != $cod2)
			{
				$config->set('lmdi_purge_ucp', $cod2);
				$sql  = "UPDATE " . MODULES_TABLE;
				$sql .= " SET module_display = $cod2 ";
				$sql .= "WHERE module_langname = 'UCP_PSB'";
				$this->db->sql_query($sql);
				$cache->purge ();
				$mess += 1;
				trigger_error($user->lang('PSB_SETTING_SAVED') . adm_back_link($this->u_action));
			}
			// Purge older topics in topics_watch table
			$nbmp = $request->variable('nbmp', 0);
			$purgep = $request->variable('purgep', 0);
			$purgev = $request->variable('purgev', 0);
			if ($nbmp != 0)
			{
				$delp = 0;
				$delv = 0;
				if ($purgep)
				{
					$sql = "DELETE ".TOPICS_WATCH_TABLE . "
						FROM ".TOPICS_WATCH_TABLE . "
						INNER JOIN ".TOPICS_TABLE . "
						WHERE ".TOPICS_WATCH_TABLE.".topic_id =".TOPICS_TABLE.".topic_id AND 
						(FROM_UNIXTIME(".TOPICS_TABLE.".topic_last_post_time)) < date_sub(now(), interval $nbmp month)";
					// var_dump ($sql);
					$this->db->sql_query($sql);
					$delp = $this->db->sql_affectedrows();
				}
				if ($purgev)
				{
					$sql = "DELETE ".TOPICS_WATCH_TABLE . "
						FROM ".TOPICS_WATCH_TABLE . "
						INNER JOIN ".TOPICS_TABLE . "
						WHERE ".TOPICS_WATCH_TABLE.".topic_id =".TOPICS_TABLE.".topic_id AND 
						(FROM_UNIXTIME(".TOPICS_TABLE.".topic_last_view_time)) < date_sub(now(), interval $nbmp month)";
					// var_dump ($sql);
					$this->db->sql_query($sql);
					$delv = $this->db->sql_affectedrows();
				}
				$del = $delp + $delv;
				if ($del)
				{
					// Information message
					$message = $user->lang('UCP_RESULT_PURGE') . $del;
					trigger_error($message. adm_back_link($this->u_action));
				}
			}
		}

		// Back to the form

		// Total number of subscribed topics
		$sql = "SELECT count(*) as nb from " . TOPICS_WATCH_TABLE;
		$res = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($res);
		$nbt = $row['nb'];
		$this->db->sql_freeresult($res);

		// Topics without new posts
		$sql = "SELECT COUNT(*) as nb 
			FROM ".TOPICS_WATCH_TABLE."
			INNER JOIN ".TOPICS_TABLE."
			WHERE ".TOPICS_WATCH_TABLE.".topic_id =".TOPICS_TABLE.".topic_id AND 
			(FROM_UNIXTIME(".TOPICS_TABLE.".topic_last_post_time)) < date_sub(now(), interval $nbma month)";
		// var_dump ($sql);
		$res = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($res);
		$nbp  = $row['nb'];
		$this->db->sql_freeresult($res);

		// Topics without new views
		$sql = "SELECT COUNT(*) as nb 
			FROM ".TOPICS_WATCH_TABLE."
			INNER JOIN ".TOPICS_TABLE."
			WHERE ".TOPICS_WATCH_TABLE.".topic_id = ".TOPICS_TABLE.".topic_id AND 
			(FROM_UNIXTIME(".TOPICS_TABLE.".topic_last_view_time)) < date_sub(now(), interval $nbma month)";
		// var_dump ($sql);
		$res = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($res);
		$nbv  = $row['nb'];
		$this->db->sql_freeresult($res);

		// Display variables
		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'ACP_PSB_NBT'			=> $nbt,
			'ACP_PSB_NBP'			=> $nbp,
			'ACP_PSB_NBV'			=> $nbv,
			'ACP_PSB_NBMA'			=> $nbma,
			'ACP_PSB_NBMP'			=> $nbmp,
			'S_PURGE_UCP'			=> $config['lmdi_purge_ucp'],
		));

	}
}
