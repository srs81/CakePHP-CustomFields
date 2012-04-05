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
		$dir = Configure::read('AMU.directory');
		if (strlen($dir) < 1) $dir = "files";

		$lastDir = $this->last_dir ($model, $id);
		$directory = WWW_ROOT . DS . $dir . DS . $lastDir;
		$files = file_get_contents ("$directory/$lastDir.json");
		$values = json_decode ($files);
		foreach ($values as $key=>$value) {
			$str = "<dt>$key</dt>\n<dd>$value</dd>\n"; 
		}
		return $str;
	}

	public function edit ($model, $id) {
		require_once (ROOT . DS . APP_DIR . "/Plugin/CustomFields/Config/bootstrap.php");
		$dir = Configure::read('AMU.directory');
		if (strlen($dir) < 1) $dir = "files";

		$str = $this->view ($model, $id, true);
		$webroot = Router::url("/") . "ajax_multi_upload";
		// Replace / with underscores for Ajax controller
		$lastDir = str_replace ("/", "___", 
			$this->last_dir ($model, $id));
		foreach ($values as $key=>$value) {
			$str = "<div class='input text'>
				<label for='$model$key'></label>
				<input name='data[$model][$key]' id='$model$key' type='text' value='$value'/>
				</div>";
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
