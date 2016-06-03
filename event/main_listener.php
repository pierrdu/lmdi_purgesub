<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015-2016 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\purgesub\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'					=> 'load_language_on_setup',
			// 'core.ucp_display_module_before'		=> 'ucp_modules_handler',
		);
	}

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/* @var \phpbb\config\config */
	protected $config;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper		Controller helper object
	* @param \phpbb\template			$template		Template object
	*/
	public function __construct(
		\phpbb\db\driver\driver_interface $db,
		\phpbb\config\config $config
		)
	{
		$this->db = $db;
		$this->config = $config;
	}

	public function load_language_on_setup($event)
	{
		// Initial reset of the module_display row in the module table
		if (!$this->config['lmdi_purge_ucp'])
		{
			$sql  = "UPDATE " . MODULES_TABLE;
			$sql .= " SET module_display = 0 ";
			$sql .= "WHERE module_langname = 'UCP_PSB'";
			// var_dump ($sql);
			$this->db->sql_query($sql);
		}
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/purgesub',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function ucp_modules_handler ($event)
	{
		global $config;
		$modules = $event['module'];
		$id      = $event['id'];
		$mode    = $event['mode'];
		/*
		var_dump ($modules);
		var_dump ($id);
		var_dump ($mode);
		*/

		$ucp_config = (int) $config['lmdi_purge_ucp'];
		if ($ucp_config)
		{
			echo ("Branche positive.<br>\n");
		}
		else
		{
			echo ("Branche négative.<br>\n");
			$array = (array) $modules;
			$module_ary = $array['module_ary'];
			$nb = count ($module_ary);
			for ($i = 0; $i < $nb; $i++)
			{
				// var_dump ($id);
				// var_dump ($mode);
				$module = $module_ary[$i];
				$langname = $module['langname'];
				if ($langname == "UCP_PSB")
				{
					// var_dump ($module);
					$module['display'] = 0;
					$module_ary[$i] = $module;
					// var_dump ($module);
					break;
				}
			}
			$array['module_ary'] = $module_ary;
			$modules = $array;
			$event['module'] = $modules;
		}
	}
}
