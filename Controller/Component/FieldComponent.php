<?php
class FieldComponent extends Component {
    public function save($data) {
	$dir = "files";
	$file = ROOT . DS . APP_DIR . "/webroot/$dir/$model/$id.json";
	file_put_contents ($file, json_encode ($data));
    }
}
