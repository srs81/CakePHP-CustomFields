<?php
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
