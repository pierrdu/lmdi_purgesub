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

		// Data submitted
		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('lmdi/purgesub'))
			{
				trigger_error('FORM_INVALID');
			}
			// Register the setting for the UCP
			$config->set('lmdi_purge_ucp', $request->variable('psb_validation', 0));
			$message = 1;
			// Purge older topics in topics_watch table
			$nb = $request->variable('nb_mois', 0);
			if ($nb != 0) 
			{
				$sql  = "DELETE " . TOPICS_WATCH_TABLE;
				$sql .= " FROM " . TOPICS_WATCH_TABLE;
				$sql .= " INNER JOIN " . TOPICS_TABLE;
				$sql .= "	WHERE " . TOPICS_WATCH_TABLE . ".topic_id = ";
				$sql .= TOPICS_TABLE . ".topic_id AND ";
				$sql .= "(FROM_UNIXTIME(". TOPICS_TABLE . ".topic_last_post_time)) < ";
				$sql .= "date_sub(now(), interval $nb month)";
				$this->db->sql_query($sql);
				$message = $user->lang('PSB_PURGE_DONE')
			}
			else
			{
				$message = $user->lang('PSB_SETTING_SAVED');
			}
			// Information message
			trigger_error($message . adm_back_link($this->u_action));
		}
		
		// Back to the form
		
		// Number of subscribed topics
		$sql = "select count(*) as nb from " . TOPICS_WATCH_TABLE;
		$res = $this->db->sql_query($sql);
		$row = $this->db->sql_fetchrow($res);
		$nb  = $row['nb'];
		$this->db->sql_freeresult($res);
			
		// Display variables
		$template->assign_vars(array(
			'U_ACTION'			=> $this->u_action,
			'ACP_PSB_NB'			=> $nb,			
			'S_PURGE_UCP'			=> $config['lmdi_purge_ucp'],
		));
		
	}
}
