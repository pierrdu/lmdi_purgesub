<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015 Pierre Duhem - LMDI
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

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/**
	* Constructor
	*
	* @param \phpbb\controller\helper	$helper		Controller helper object
	* @param \phpbb\template			$template		Template object
	*/
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template)
	{
		$this->helper = $helper;
		$this->template = $template;
	}

	public function load_language_on_setup($event)
	{
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
				var_dump ($id);
				var_dump ($mode);
				$module = $module_ary[$i];
				$langname = $module['langname'];
				if ($langname == "UCP_PSB")
				{
					var_dump ($module);
					$module['display'] = 0;
					$module_ary[$i] = $module;
					var_dump ($module);
					break;
				}
			}
			$array['module_ary'] = $module_ary;
			$modules = $array;
			$event['module'] = $modules;
		}
	}
}
