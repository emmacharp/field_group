<?php

	class extension_field_group extends Extension {

		public function uninstall() {
			$rt1 = Symphony::Database()
				->drop('tbl_fields_field_group_start')
				->ifExists()
				->execute()
				->success();

			$rt2 = Symphony::Database()
				->drop('tbl_fields_field_group_end')
				->ifExists()
				->execute()
				->success();

			return $rt1 && $rt2;
		}

		public function install() {
			$rt1 = Symphony::Database()
				->create('tbl_fields_field_group_start')
				->ifNotExists()
				->fields([
					'id' => [
						'type' => 'int(11)',
						'auto' => true,
					],
					'field_id' => 'int(11)',
				])
				->keys([
					'id' => 'primary',
				])
				->execute()
				->success();

			$rt2 = Symphony::Database()
				->create('tbl_fields_field_group_end')
				->ifNotExists()
				->fields([
					'id' => [
						'type' => 'int(11)',
						'auto' => true,
					],
					'field_id' => 'int(11)',
				])
				->keys([
					'id' => 'primary',
				])
				->execute()
				->success();

			return $rt1 && $rt2;
		}

		public function getSubscribedDelegates() {
			return array(
				array(
					'page'		=> '/backend/',
					'delegate'	=> 'InitaliseAdminPageHead',
					'callback'	=> 'initializeAdmin'
				),
			);
		}

		public function initializeAdmin($context) {
			$page = Administration::instance()->Page;
			$context = $page->getContext();

			$callback = Administration::instance()->getPageCallback();

			// only proceed on New or Edit publish pages
			if ($page instanceof contentPublish and in_array($context['page'], array('new', 'edit'))) {
				$page->addStylesheetToHead(URL . '/extensions/field_group/assets/field_group.css', 'screen', 9001);
			}
		}
	}
