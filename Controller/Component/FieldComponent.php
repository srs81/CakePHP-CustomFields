<?php
/**
 *
 * Dual-licensed under the GNU GPL v3 and the MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, Suman (srs81 @ GitHub)
 * @package       plugin
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 *                and/or GNU GPL v3 (http://www.gnu.org/copyleft/gpl.html)
 */

class FieldComponent extends Component {
	public function save($model, $data) {
		// Load the models
		$cfModel = ClassRegistry::init('CustomField');
		$cfvModel = ClassRegistry::init('CustomFieldValue');

		// Custom fields for this model
		$customFields = $cfModel->find('all', array(
			'conditions' => array('model_name' => $model)
		));

		// Model name and ID
		$modelName = $model;
		$modelId = $data['CustomField']['ModelId'];

		// For each custom field for this model
		foreach ($customFields as $customField) {
			$fieldName = $customField['CustomField']['field_name'];
			$fieldValue = $data[$model][$fieldName];

			// Get existing values for this model and field
			$existing = $cfvModel->find('all', array(
				'conditions' => array('model_name' => $model, 'model_id' => $modelId, 'field_name' => $fieldName)
			));

			if (sizeof($existing) > 0) {
				// If there are existing values for this, update
				$cfvModel->updateAll(
					array('field_value' => "$fieldValue"),
					array(
						'model_name' => $modelName,
						'model_id' => $modelId,
						'field_name' => $fieldName
					)
				);
			} else {
				// If not, save a new set of values
				$cfvModel->create();
				$cfvModel->save(array('CustomFieldValue' => array(
					'field_value' => "$fieldValue",
					'model_name' => $modelName,
					'model_id' => $modelId,
					'field_name' => $fieldName
				)));
			}
		}
	}
}
