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
		
		require_once (ROOT . DS . APP_DIR . "/Plugin/CustomFields/Config/bootstrap.php");
		$dir = "files";

		$lastDir = $this->last_dir ($model, $id);
		$file = ROOT . DS . APP_DIR . DS . "webroot/$dir/$lastDir.json";
		if (!file_exists("$file")) 
			return ""; 
		$files = file_get_contents ("$file");
		$values = json_decode ($files);
		$str = "";
		foreach ($values as $key=>$value) {
			$key = Inflector::humanize($key);
			$str .= "<dt>$key</dt>\n<dd>$value</dd>\n"; 
		}
		return $str;
	}

	public function edit ($model, $id) {
		require_once (ROOT . DS . APP_DIR . "/Plugin/CustomFields/Config/bootstrap.php");
		$dir = "files";
		if (!isset($cfgModelFields[$model])) 
			return;
		$tmpFields = explode (",", $cfgModelFields[$model]);
		foreach ($tmpFields as $field) {
			$fields[] = trim($field);
		}
		$lastDir = $this->last_dir ($model, $id);
		$file = ROOT . DS . APP_DIR . DS . "webroot/$dir/$lastDir.json";
		if (file_exists("$file")) { 
			$files = file_get_contents ("$file");
			$values = json_decode ($files);
		}
		$str = "";
		foreach ($values as $key=>$value) {
			if (!in_array($key, $fields)) 
				continue;
			$humanKey = Inflector::humanize($key);
			$str .= "<div class='input text'>
				<label for='$model$key'>$humanKey</label>
				<input name='data[$model][$key]' id='$model$key' type='text' value='$value'/>
				</div>\n";
		}
		return $str;
	}

	// The "last mile" of the directory path for where the files get uploaded
	function last_dir ($model, $id) {
		return $model . "/" . $id;
	}

	// From http://php.net/manual/en/function.filesize.php
	function format_bytes($size) {
		$units = array(' B', ' KB', ' MB', ' GB', ' TB');
		for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
		return round($size, 2).$units[$i];
	}
}
