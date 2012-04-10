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
	$dir = Configure::read('CF.directory');
	if (strlen($dir) < 2)
		$dir = "files/custom_fields";
	$id = $data[$model]['id'];
	$customFields = Configure::read("CustomFields");
	if (!isset($customFields[$model]))
		return;
	$tmpFields = explode (",", $customFields[$model]);
	foreach ($tmpFields as $field) {
		$fields[] = trim($field);
	}
	$arr = array();
	foreach ($fields as $key) {
		$value = "";
		if (array_key_exists($key, $data[$model]))
			$value = $data[$model][$key];
		$arr[$key] = $value;
	}
	$file = ROOT . DS . APP_DIR . "/webroot/$dir/$model/$id.json";
	file_put_contents ($file, json_encode ($arr));
    }
}
