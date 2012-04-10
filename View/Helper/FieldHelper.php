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


	public function view ($model, $id, $edit=false) {
	        $dir = Configure::read('CF.directory');
        	if (strlen($dir) < 2)
	                $dir = "files/custom_fields";
		$file = ROOT . DS . APP_DIR . "/webroot/$dir/$model/$id.json";
		if (!file_exists($file)) 
			return ""; 
		$files = file_get_contents ("$file");
		$values = json_decode ($files, true);
		$str = "";
		foreach ($values as $key=>$value) {
			$key = Inflector::humanize($key);
			$str .= "<dt>$key</dt>\n<dd>$value</dd>\n"; 
		}
		return $str;
	}

	public function edit ($model, $id) {
		$customFields = Configure::read("CustomFields");
		if (!isset($customFields[$model])) 
			return;
		$tmpFields = explode (",", $customFields[$model]);
		foreach ($tmpFields as $field) {
			$fields[] = trim($field);
		}
	        $dir = Configure::read('CF.directory');
        	if (strlen($dir) < 2)
	                $dir = "files/custom_fields";
		$directory = ROOT . DS . APP_DIR . "/webroot/$dir/$model";
		if (!file_exists($directory)) {
			mkdir($directory, 0777, true);
		}
		$file = "$directory/$id.json";
		$values = array();
		if (file_exists("$file")) { 
			$files = file_get_contents ("$file");
			$values = json_decode ($files);
		}
		$str = "";
		foreach ($fields as $key) {
			$value = "";
			if (array_key_exists($key, $values)) 
				$value = $values[$key];
			$humanKey = Inflector::humanize($key);
			$str .= "<div class='input text'>
				<label for='$model$key'>$humanKey</label>
				<input name='data[$model][$key]' id='$model$key' type='text' value='$value'/>
				</div>\n";
		}
		return $str;
	}

}
