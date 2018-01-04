<?php
/**
*
* Purge subscriptions extension for the phpBB Forum Software package.
*
* @copyright (c) 2015-2018 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\purgesub\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{

	public function effectively_installed()
	{
		return isset($this->config['lmdi_purge_topics']);
	}


	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}


	public function update_data()
	{
		return array(
			// Config lines
			array('config.add', array('lmdi_purge_topics', 1)),
			array('config.add', array('lmdi_purge_ucp', 0)),

			// ACP modules
			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PSB_TITLE'
			)),
			array('module.add', array(
				'acp',
				'ACP_PSB_TITLE',
				array(
					'module_basename'	=> '\lmdi\purgesub\acp\main_module',
					'modes'			=> array('settings'),
					'auth'			=> 'ext_lmdi/purgesub && acl_a_board',
				),
			)),

			// UCP modules
			array('module.add', array(
				'ucp',
				'0',
				'UCP_PSB_TITLE',
			)),
			array('module.add', array(
				'ucp',
				'UCP_PSB_TITLE',
				array(
					'module_basename'	=> '\lmdi\purgesub\ucp\ucp_psb_module',
					'module_mode'		=> array('purgesub', 'purgesub2', 'purgesub3'),
					'module_auth'		=> 'ext_lmdi/purgesub',
					'module_display'	=> 0,
					'module_enabled'	=> 1,
					'module_class'		=> 'ucp',
				),
			)),
		);
	}


	public function revert_data()
	{
		return array(
			array('config.remove', array('lmdi_purge_topics')),
			array('config.remove', array('lmdi_purge_ucp')),
			array('module.remove', array(
				'acp',
				'ACP_PSB_TITLE',
				array(
					'module_basename'	=> '\lmdi\purgesub\acp\main_module',
					'modes'			=> array('settings'),
				),
			)),
			array('module.remove', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PSB_TITLE'
			)),
			array('module.remove', array(
				'ucp',
				'UCP_PSB_TITLE',
				array(
					'module_basename'	=> '\lmdi\purgesub\ucp\ucp_psb_module',
					'module_mode'		=> array ('purgesub', 'purgesub1', 'purgesub2'),
					'module_auth'		=> 'ext_lmdi/purgesub',
					'module_display'	=> 0,
					'module_enabled'	=> 1,
					'module_class'		=> 'ucp',
				),
			)),
			array('module.remove', array(
				'ucp',
				'0',
				'UCP_PSB_TITLE',
			)),
		);
	}
}
