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
 
Configure::write ('CF.directory', 'files/custom_fields');

/**
 * To specify custom fields for models, add a line like the one below,
 * either to this file, or in APP/Config/bootstrap.php
 *
Configure::write('CustomFields', array(
        "Blog" => "author, publish_on"
));
 */
?>

