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

/**
* Class name must be the same as the file name.
* @package ucp
*/

class ucp_psb_module
{
	protected $db;
	protected $user;
	public $u_action;
	public $tpl_name;
	public $page_title;

	// $id = 'upc_psb_module.php'
	function main($id, $mode)
	{
		global $user;

		$this->user = $user;
		$this->user->add_lang_ext('lmdi/purgesub', 'common');

		switch ($mode)
		{
			case 'purgesub' :	// General subscription management
				$this->tpl_name = 'ucp_psb';
				$this->page_title = $this->user->lang('UCP_PSB_MANAGE');
				$this->general_management ($id, $this->u_action);
				break;
			case 'purgesub1' :	// Forum subscriptions
				$this->tpl_name = 'ucp_psb_forums';
				$this->page_title = $this->user->lang('UCP_PSB_MANAGEF');
				$this->forum_management ($id, $this->u_action);
				break;
			case 'purgesub2' :	// Topic subscriptions
				$this->tpl_name = 'ucp_psb_topics';
				$this->page_title = $this->user->lang('UCP_PSB_MANAGET');
				$this->topic_management ($id, $this->u_action);
				break;
		}
	}	// main


	function general_management ($id, $u_action)
	{
		global $db, $user, $template, $request;
		global $phpbb_root_path, $phpEx;

		$this->user = $user;
		$this->db = $db;

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
				$delp = 0;
				$delv = 0;
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

		// Total number of subscribed topics at this point of time
		$sql = "select count(*) as nb from " . TOPICS_WATCH_TABLE;
		$sql .= " WHERE user_id = $uid";
		$this->db->sql_query($sql);
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
			'L_TITLE'			=> $this->user->lang['UCP_PSB_TITLE'],
			'S_UCP_ACTION' 	=> $this->u_action,
			'UCP_PSB_NBT'		=> $nbt,
			'UCP_PSB_NBP'		=> $nbp,
			'UCP_PSB_NBV'		=> $nbv,
			'PSB_NBA'			=> $nbma,
			'PSB_NBP'			=> $nbmp,
		));
	}	// General management


	function forum_management ($id, $u_action)
	{
		global $phpbb_root_path, $phpEx, $config, $auth, $db, $template, $request;
		include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

		$this->user->add_lang('viewforum');
		$this->db = $db;

		add_form_key('ucp_front_subscribed');

		$unwatch = (isset($_POST['unwatch'])) ? true : false;
		if ($unwatch)
		{
			if (check_form_key('ucp_front_subscribed'))
			{
				$forums = array_keys($request->variable('f', array(0 => 0)));
				if (sizeof($forums))
				{
					$l_unwatch = '';
					if (sizeof($forums))
					{
						$sql = 'DELETE FROM ' . FORUMS_WATCH_TABLE . '
							WHERE ' . $db->sql_in_set('forum_id', $forums) . '
								AND user_id = ' . $this->user->data['user_id'];
						$db->sql_query($sql);

						$l_unwatch .= '_FORUMS';
					}
					$msg = $this->user->lang['UNWATCHED' . $l_unwatch];
				}
				else
				{
					$msg = $this->user->lang['NO_WATCHED_SELECTED'];
				}
			}
			else
			{
				$msg = $this->user->lang['FORM_INVALID'];
			}
			$message = $msg . '<br /><br />' . sprintf($this->user->lang['RETURN_UCP'], '<a href="' . append_sid("{$phpbb_root_path}ucp.$phpEx", "i=$id&amp;mode=purgesub1") . '">', '</a>');
			meta_refresh(3, append_sid("{$phpbb_root_path}ucp.$phpEx", "i=$id&amp;mode=purgesub1"));
			trigger_error($message);
		}

		$sql_array = array(
			'SELECT'	=> 'f.*',
			'FROM'	=> array(
				FORUMS_WATCH_TABLE	=> 'fw',
				FORUMS_TABLE		=> 'f'
			),
			'WHERE'	=> 'fw.user_id = ' . $this->user->data['user_id'] . '
				AND f.forum_id = fw.forum_id ',
			'ORDER_BY'	=> 'left_id',
			);
		$sql_array['LEFT_JOIN'] = array(
			array(
				'FROM' => array(FORUMS_TRACK_TABLE => 'ft',),
				'ON'	=> 'ft.user_id = ' . $this->user->data['user_id'] . ' AND ft.forum_id = f.forum_id'
				)
			);
		$sql_array['SELECT'] .= ', ft.mark_time ';
		$sql = $this->db->sql_build_query('SELECT', $sql_array);
		$result = $this->db->sql_query($sql);

		while ($row = $this->db->sql_fetchrow($result))
		{
			$forum_id = $row['forum_id'];

			if ($config['load_db_lastread'])
			{
				$forum_check = (!empty($row['mark_time'])) ? $row['mark_time'] : $this->user->data['user_lastmark'];
			}
			else
			{
				$forum_check = (isset($tracking_topics['f'][$forum_id])) ? (int) (base_convert($tracking_topics['f'][$forum_id], 36, 10) + $config['board_startdate']) : $this->user->data['user_lastmark'];
			}

			$unread_forum = ($row['forum_last_post_time'] > $forum_check) ? true : false;

			// Which folder should we display?
			if ($row['forum_status'] == ITEM_LOCKED)
			{
				$folder_image = ($unread_forum) ? 'forum_unread_locked' : 'forum_read_locked';
				$folder_alt = 'FORUM_LOCKED';
			}
			else
			{
				$folder_image = ($unread_forum) ? 'forum_unread' : 'forum_read';
				$folder_alt = ($unread_forum) ? 'UNREAD_POSTS' : 'NO_UNREAD_POSTS';
			}

			// Create last post link information, if appropriate
			if ($row['forum_last_post_id'])
			{
				$last_post_time = $this->user->format_date($row['forum_last_post_time']);
				$last_post_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", "f=$forum_id&amp;p=" . $row['forum_last_post_id']) . '#p' . $row['forum_last_post_id'];
			}
			else
			{
				$last_post_time = $last_post_url = '';
			}

			$template_vars = array(
				'FORUM_ID'		=> $forum_id,
				'FORUM_IMG_STYLE'	=> $folder_image,
				'FORUM_FOLDER_IMG'	=> $this->user->img($folder_image, $folder_alt),
				'FORUM_IMAGE'		=> ($row['forum_image']) ? '<img src="' . $phpbb_root_path . $row['forum_image'] . '" alt="' . $this->user->lang[$folder_alt] . '" />' : '',
				'FORUM_IMAGE_SRC'	=> ($row['forum_image']) ? $phpbb_root_path . $row['forum_image'] : '',
				'FORUM_NAME'		=> $row['forum_name'],
				'FORUM_DESC'		=> generate_text_for_display($row['forum_desc'], $row['forum_desc_uid'], $row['forum_desc_bitfield'], $row['forum_desc_options']),
				'LAST_POST_SUBJECT'	=> $row['forum_last_post_subject'],
				'LAST_POST_TIME'	=> $last_post_time,
				'LAST_POST_AUTHOR'	=> get_username_string('username', $row['forum_last_poster_id'], $row['forum_last_poster_name'], $row['forum_last_poster_colour']),
				'LAST_POST_AUTHOR_COLOUR'	=> get_username_string('colour', $row['forum_last_poster_id'], $row['forum_last_poster_name'], $row['forum_last_poster_colour']),
				'LAST_POST_AUTHOR_FULL'		=> get_username_string('full', $row['forum_last_poster_id'], $row['forum_last_poster_name'], $row['forum_last_poster_colour']),
				'U_LAST_POST_AUTHOR'	=> get_username_string('profile', $row['forum_last_poster_id'], $row['forum_last_poster_name'], $row['forum_last_poster_colour']),
				'S_UNREAD_FORUM'	=> $unread_forum,
				'U_LAST_POST'		=> $last_post_url,
				'U_VIEWFORUM'		=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $row['forum_id'])
				);
			$template->assign_block_vars('forumrow', $template_vars);
		}
		$db->sql_freeresult($result);
	}	// forum_management


	/**
	* Build and assign topiclist for subscribed topics
	*/
	function assign_topiclist()
	{
		global $user, $db, $template, $config, $cache, $auth, $phpbb_root_path, $phpEx, $phpbb_container, $request, $phpbb_dispatcher;

		/* @var $pagination \phpbb\pagination */
		$pagination = $phpbb_container->get('pagination');
		$start = $request->variable('start', 0);

		// Grab icons
		$icons = $cache->obtain_icons();

		$sql_array = array(
			'SELECT'	=> 'COUNT(t.topic_id) as topics_count',
			'FROM'		=> array(
				TOPICS_WATCH_TABLE	=> 'i',
				TOPICS_TABLE		=> 't'
			),
			'WHERE'	=>	'i.topic_id = t.topic_id
				AND i.user_id = ' . $this->user->data['user_id'],
		);

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query($sql);
		$topics_count = (int) $db->sql_fetchfield('topics_count');
		$db->sql_freeresult($result);

		if ($topics_count)
		{
			$start = $pagination->validate_start($start, $config['topics_per_page'], $topics_count);
			$pagination->generate_template_pagination($this->u_action, 'pagination', 'start', $topics_count, $config['topics_per_page'], $start);

			$template->assign_vars(array(
				'TOTAL_TOPICS'	=> $this->user->lang('VIEW_FORUM_TOPICS', (int) $topics_count),
			));
		}

		$sql_array = array(
			'SELECT'	=> 't.*, f.forum_name',

			'FROM'		=> array(
				TOPICS_WATCH_TABLE	=> 'tw',
				TOPICS_TABLE		=> 't'
			),

			'WHERE'		=> 'tw.user_id = ' . $this->user->data['user_id'] . '
				AND t.topic_id = tw.topic_id ',

			'ORDER_BY'	=> 't.topic_last_post_time DESC, t.topic_last_post_id DESC',
		);

		$sql_array['LEFT_JOIN'] = array();

		$sql_array['LEFT_JOIN'][] = array('FROM' => array(FORUMS_TABLE => 'f'), 'ON' => 't.forum_id = f.forum_id');

		if ($config['load_db_lastread'])
		{
			$sql_array['LEFT_JOIN'][] = array('FROM' => array(FORUMS_TRACK_TABLE => 'ft'), 'ON' => 'ft.forum_id = t.forum_id AND ft.user_id = ' . $this->user->data['user_id']);
			$sql_array['LEFT_JOIN'][] = array('FROM' => array(TOPICS_TRACK_TABLE => 'tt'), 'ON' => 'tt.topic_id = t.topic_id AND tt.user_id = ' . $this->user->data['user_id']);
			$sql_array['SELECT'] .= ', tt.mark_time, ft.mark_time AS forum_mark_time';
		}

		if ($config['load_db_track'])
		{
			$sql_array['LEFT_JOIN'][] = array('FROM' => array(TOPICS_POSTED_TABLE => 'tp'), 'ON' => 'tp.topic_id = t.topic_id AND tp.user_id = ' . $this->user->data['user_id']);
			$sql_array['SELECT'] .= ', tp.topic_posted';
		}

		$sql = $db->sql_build_query('SELECT', $sql_array);
		$result = $db->sql_query_limit($sql, $config['topics_per_page'], $start);

		$topic_list = $topic_forum_list = $global_announce_list = $rowset = array();
		while ($row = $db->sql_fetchrow($result))
		{
			$topic_id = (isset($row['b_topic_id'])) ? $row['b_topic_id'] : $row['topic_id'];

			$topic_list[] = $topic_id;
			$rowset[$topic_id] = $row;

			$topic_forum_list[$row['forum_id']]['forum_mark_time'] = ($config['load_db_lastread']) ? $row['forum_mark_time'] : 0;
			$topic_forum_list[$row['forum_id']]['topics'][] = $topic_id;

			if ($row['topic_type'] == POST_GLOBAL)
			{
				$global_announce_list[] = $topic_id;
			}
		}
		$db->sql_freeresult($result);

		$topic_tracking_info = array();
		if ($config['load_db_lastread'])
		{
			foreach ($topic_forum_list as $f_id => $topic_row)
			{
				$topic_tracking_info += get_topic_tracking($f_id, $topic_row['topics'], $rowset, array($f_id => $topic_row['forum_mark_time']));
			}
		}
		else
		{
			foreach ($topic_forum_list as $f_id => $topic_row)
			{
				$topic_tracking_info += get_complete_topic_tracking($f_id, $topic_row['topics']);
			}
		}

		/* @var $phpbb_content_visibility \phpbb\content_visibility */
		$phpbb_content_visibility = $phpbb_container->get('content.visibility');

		foreach ($topic_list as $topic_id)
		{
			$row = &$rowset[$topic_id];

			$forum_id = $row['forum_id'];
			$topic_id = (isset($row['b_topic_id'])) ? $row['b_topic_id'] : $row['topic_id'];

			$unread_topic = (isset($topic_tracking_info[$topic_id]) && $row['topic_last_post_time'] > $topic_tracking_info[$topic_id]) ? true : false;

			// Replies
			$replies = $phpbb_content_visibility->get_count('topic_posts', $row, $forum_id) - 1;

			if ($row['topic_status'] == ITEM_MOVED && !empty($row['topic_moved_id']))
			{
				$topic_id = $row['topic_moved_id'];
			}

			// Get folder img, topic status/type related information
			$folder_img = $folder_alt = $topic_type = '';
			topic_status($row, $replies, $unread_topic, $folder_img, $folder_alt, $topic_type);

			$view_topic_url_params = "f=$forum_id&amp;t=$topic_id";
			$view_topic_url = append_sid("{$phpbb_root_path}viewtopic.$phpEx", $view_topic_url_params);

			// Send vars to template
			$template_vars = array(
				'FORUM_ID'					=> $forum_id,
				'TOPIC_ID'					=> $topic_id,
				'FIRST_POST_TIME'			=> $this->user->format_date($row['topic_time']),
				'LAST_POST_SUBJECT'			=> $row['topic_last_post_subject'],
				'LAST_POST_TIME'			=> $this->user->format_date($row['topic_last_post_time']),
				'LAST_VIEW_TIME'			=> $this->user->format_date($row['topic_last_view_time']),

				'TOPIC_AUTHOR'				=> get_username_string('username', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),
				'TOPIC_AUTHOR_COLOUR'		=> get_username_string('colour', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),
				'TOPIC_AUTHOR_FULL'			=> get_username_string('full', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),
				'U_TOPIC_AUTHOR'			=> get_username_string('profile', $row['topic_poster'], $row['topic_first_poster_name'], $row['topic_first_poster_colour']),

				'LAST_POST_AUTHOR'			=> get_username_string('username', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour']),
				'LAST_POST_AUTHOR_COLOUR'	=> get_username_string('colour', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour']),
				'LAST_POST_AUTHOR_FULL'		=> get_username_string('full', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour']),
				'U_LAST_POST_AUTHOR'		=> get_username_string('profile', $row['topic_last_poster_id'], $row['topic_last_poster_name'], $row['topic_last_poster_colour']),

				'S_DELETED_TOPIC'	=> (!$row['topic_id']) ? true : false,

				'REPLIES'			=> $replies,
				'VIEWS'				=> $row['topic_views'],
				'TOPIC_TITLE'		=> censor_text($row['topic_title']),
				'TOPIC_TYPE'		=> $topic_type,
				'FORUM_NAME'		=> $row['forum_name'],

				'TOPIC_IMG_STYLE'		=> $folder_img,
				'TOPIC_FOLDER_IMG'		=> $this->user->img($folder_img, $folder_alt),
				'TOPIC_FOLDER_IMG_ALT'	=> $this->user->lang[$folder_alt],
				'TOPIC_ICON_IMG'		=> (!empty($icons[$row['icon_id']])) ? $icons[$row['icon_id']]['img'] : '',
				'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$row['icon_id']])) ? $icons[$row['icon_id']]['width'] : '',
				'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$row['icon_id']])) ? $icons[$row['icon_id']]['height'] : '',
				'ATTACH_ICON_IMG'		=> ($auth->acl_get('u_download') && $auth->acl_get('f_download', $forum_id) && $row['topic_attachment']) ? $this->user->img('icon_topic_attach', $this->user->lang['TOTAL_ATTACHMENTS']) : '',

				'S_TOPIC_TYPE'			=> $row['topic_type'],
				'S_USER_POSTED'			=> (!empty($row['topic_posted'])) ? true : false,
				'S_UNREAD_TOPIC'		=> $unread_topic,

				'U_NEWEST_POST'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", $view_topic_url_params . '&amp;view=unread') . '#unread',
				'U_LAST_POST'			=> append_sid("{$phpbb_root_path}viewtopic.$phpEx", $view_topic_url_params . '&amp;p=' . $row['topic_last_post_id']) . '#p' . $row['topic_last_post_id'],
				'U_VIEW_TOPIC'			=> $view_topic_url,
				'U_VIEW_FORUM'			=> append_sid("{$phpbb_root_path}viewforum.$phpEx", 'f=' . $forum_id),
			);

			$template->assign_block_vars('topicrow', $template_vars);

			$pagination->generate_template_pagination(append_sid("{$phpbb_root_path}viewtopic.$phpEx", 'f=' . $row['forum_id'] . "&amp;t=$topic_id"), 'topicrow.pagination', 'start', $replies + 1, $config['posts_per_page'], 1, true, true);
		}
	}	// assign_topiclist


	function topic_management ($id, $u_action)
	{
		global $phpbb_root_path, $phpEx, $config, $auth, $db, $template, $request;
		include($phpbb_root_path . 'includes/functions_display.' . $phpEx);

		$this->user->add_lang('viewforum');
		$this->db = $db;

		add_form_key('ucp_front_subscribed');

		$unwatch = (isset($_POST['unwatch'])) ? true : false;
		if ($unwatch)
		{
			if (check_form_key('ucp_front_subscribed'))
			{
				$topics = array_keys($request->variable('t', array(0 => 0)));
				$l_unwatch = '';
				if (sizeof($topics))
				{
					$sql = 'DELETE FROM ' . TOPICS_WATCH_TABLE . '
						WHERE ' . $db->sql_in_set('topic_id', $topics) . '
						AND user_id = ' . $this->user->data['user_id'];
					$db->sql_query($sql);
					$l_unwatch .= '_TOPICS';
					$msg = $this->user->lang['UNWATCHED' . $l_unwatch];
				}
				else
				{
					$msg = $this->user->lang['NO_WATCHED_SELECTED'];
				}
			}
			else
			{
				$msg = $this->user->lang['FORM_INVALID'];
			}
			$message = $msg . '<br /><br />' . sprintf($this->user->lang['RETURN_UCP'], '<a href="' . append_sid("{$phpbb_root_path}ucp.$phpEx", "i=$id&amp;mode=purgesub2") . '">', '</a>');
			meta_refresh(3, append_sid("{$phpbb_root_path}ucp.$phpEx", "i=$id&amp;mode=pourgesub2"));
			trigger_error($message);
		}
		$this->assign_topiclist ();
	}	// topic_management


}
