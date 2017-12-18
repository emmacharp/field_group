<?php

	Class fieldField_Group_Start extends Field {


	/*-------------------------------------------------------------------------
		Definition:
	-------------------------------------------------------------------------*/

		public function __construct(){
			parent::__construct();

			$this->_name = 'Group Start';
			$this->set('show_column', 'no');
			$this->set('required', 'no');
		}

	/*-------------------------------------------------------------------------
		Setup:
	-------------------------------------------------------------------------*/

		public function createTable(){
			return Symphony::Database()->query(
				"CREATE TABLE IF NOT EXISTS `tbl_entries_data_" . $this->get('id') . "` (
				  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
				  `entry_id` INT(11) UNSIGNED NOT NULL,
				  `value` DOUBLE DEFAULT NULL,
				  PRIMARY KEY  (`id`),
				  KEY `entry_id` (`entry_id`),
				  KEY `value` (`value`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
			);
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

		public function displayPublishPanel(XMLElement &$wrapper, $data = null, $flagWithError = null, $fieldnamePrefix = null, $fieldnamePostfix = null, $entry_id = null){
			$wrapper->setValue($this->get('label'));
		}

		public function processRawFieldData($data, &$status, &$message = null, $simulate = false, $entry_id = null) {
			$status = self::__OK__;

			return array(
				'value' => ''
			);
		}

	/*-------------------------------------------------------------------------
		Output:
	-------------------------------------------------------------------------*/

		public function fetchIncludableElements() {
 			return null;
 		}

	}
