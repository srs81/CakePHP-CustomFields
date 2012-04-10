<?php
class FieldComponent extends Component {
    public function save($model, $data) {
	$dir = Configure::read('CF.directory');
	if (strlen($dir) < 2)
		$dir = "files/custom_fields";
	$id = $data[$model]['id'];
	$file = ROOT . DS . APP_DIR . "/webroot/$dir/$model/$id.json";
	file_put_contents ($file, json_encode ($data));
    }
}
