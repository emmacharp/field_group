<?php

	Class fieldField_Group_End extends Field {


	/*-------------------------------------------------------------------------
		Definition:
	-------------------------------------------------------------------------*/

		public function __construct(){
			parent::__construct();

			$this->_name = 'Group End';
			$this->set('show_column', 'no');
			$this->set('required', 'no');
		}


		public function requiresTable() {
			return false;
		}

	/*-------------------------------------------------------------------------
		Setup:
	-------------------------------------------------------------------------*/

		public function createTable(){
			return Symphony::Database()
				->create('tbl_entries_data_' . $this->get('id'))
				->ifNotExists()
				->fields([
					'id' => [
						'type' => 'int(11)',
						'auto' => true,
					],
					'entry_id' => 'int(11)',
					'value' => [
						'type' => 'double',
						'null' => true,
					],
				])
				->keys([
					'id' => 'primary',
					'entry_id' => 'key',
					'value' => 'key',
				])
				->execute()
				->success();
		}

	/*-------------------------------------------------------------------------
		Settings:
	-------------------------------------------------------------------------*/

		public function commit() {
			if(!parent::commit()) return false;

			$id = $this->get('id');
			$handle = $this->handle();

			if($id === false) return false;

			$fields = array();
			$fields['field_id'] = $id;
			return FieldManager::saveSettings($id, $fields);
		}

	/*-------------------------------------------------------------------------
		Publish:
	-------------------------------------------------------------------------*/

		public function processRawFieldData($data, &$status, &$message = null, $simulate = false, $entry_id = null) {
			$status = self::__OK__;

			return array(
				'value' => 0
			);
		}

	/*-------------------------------------------------------------------------
		Output:
	-------------------------------------------------------------------------*/

		public function fetchIncludableElements() {
 			return null;
 		}

	}
