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
 
class FieldHelper extends AppHelper {

	public function view ($model, $id) {
		// Get field names for this model
		$cfvModel = ClassRegistry::init('CustomFieldValue');
		$customValues = $cfvModel->find('all', array(
			'conditions' => array('model_name' => $model, 'model_id' => $id)
		));

		// Build a string of key value pairs
		$str = "";
		foreach ($customValues as $customValue) {
			$cv = $customValue['CustomFieldValue'];
			$key = $cv['field_name'];
			$value = $cv['field_value'];
			$str .= "<dt>$key</dt>\n<dd>$value</dd>\n"; 
		}
		return $str;
	}

	public function edit ($model, $id) {
		// Models
		$cfModel = ClassRegistry::init('CustomField');
		$cfvModel = ClassRegistry::init('CustomFieldValue');

		// Field names
		$customFields = $cfModel->find('all', array(
			'conditions' => array('model_name' => $model)
		));

		// Field values
		$customValues = $cfvModel->find('all', array(
			'conditions' => array('model_name' => $model, 'model_id' => $id)
		));

		$str = "";
		if (sizeof($customValues) > 0) {
			// If there exist values for this model and id
			foreach ($customValues as $customValue) {
				$cv = $customValue['CustomFieldValue'];
				$key = $cv['field_name'];
				$value = $cv['field_value'];
				$str .= "<div class='input text'>
					<label for='$model$key'>$key</label>
					<input name='data[$model][$key]' id='$model$key' type='text' value='$value'/>
					</div>\n";
			}
		} else {
			// If there are no existing values
			foreach ($customFields as $customField) {
				$cv = $customField['CustomField'];
				$key = $cv['field_name'];
				$str .= "<div class='input text'>
					<label for='$model$key'>$key</label>
					<input name='data[$model][$key]' id='$model$key' type='text'/>
					</div>\n";
			}
		}

		return $str;
	}

}
