<?php
App::uses('CustomFieldValue', 'CustomFields.Model');

/**
 * CustomFieldValue Test Case
 */
class CustomFieldValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.custom_fields.custom_field_value',
		'plugin.custom_fields.model'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomFieldValue = ClassRegistry::init('CustomFields.CustomFieldValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomFieldValue);

		parent::tearDown();
	}

}
