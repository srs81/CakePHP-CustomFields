<?php
App::uses('CustomField', 'CustomFields.Model');

/**
 * CustomField Test Case
 */
class CustomFieldTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.custom_fields.custom_field'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CustomField = ClassRegistry::init('CustomFields.CustomField');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CustomField);

		parent::tearDown();
	}

}
