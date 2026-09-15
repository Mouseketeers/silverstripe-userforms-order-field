<?php

namespace Mouseketeers\UserForms\OrderField;

use SilverStripe\Forms\FormField;
use SilverStripe\View\Requirements;

class OrderFormField extends FormField {

	private static $table_name = 'OrderFormField';

	protected $autoCompleteSource;
	protected $query;

	public function __construct($name, $title = null, $value = null) {
		parent::__construct($name, $title, $value);
		
		// Add jQuery requirement first (using UserForms jQuery)
		Requirements::javascript('silverstripe/userforms:client/dist/js/jquery.min.js');
		
		// Add required JavaScript and CSS
		Requirements::javascript('mouseketeers/silverstripe-userforms-order-field:vendor/devbridge-autocomplete/dist/jquery.autocomplete.min.js');
		Requirements::javascript('mouseketeers/silverstripe-userforms-order-field:javascript/order-form-field.js');
	}

	public function AutoCompleteSource() {
		return $this->autoCompleteSource;
	}
	public function Query() {
		return $this->query;
	}	
	public function setAutoCompleteSource($autoCompleteSource) {
		$this->autoCompleteSource = $autoCompleteSource;
		return $this;
	}
	public function setQuery($query) {
		$this->query = $query;
		return $this;
	}	
	public function getAttributes() {
		return array_merge(
			parent::getAttributes(),
			array(
				'type' => null,
				'value' => null
			)
		);
	}
	public function Type() {
		return 'order-form-field';
	}
	public function validate($validator) {
		// $values = $this->value;
		// if (!$values) {
		// 	return true;
		// }
		// $sourceArray = $this->getSourceAsArray();
		// $validValues = array_keys($sourceArray);
		// if (is_array($values)) {
		// 	if (!array_intersect($validValues, $values)) {
		// 		$validator->validationError(
		// 			$this->name,
		// 			_t(
		// 				'CheckboxSetField.SOURCE_VALIDATION',
		// 				"Please select a value within the list provided. '{value}' is not a valid option",
		// 				array('value' => implode(' and ', $values))
		// 			),
		// 			"validation"
		// 		);
		// 		return false;
		// 	}
		// } else {
		// 	if (!in_array($this->value, $validValues)) {
		// 		$validator->validationError(
		// 			$this->name,
		// 			_t(
		// 				'CheckboxSetField.SOURCE_VALIDATION',
		// 				"Please select a value within the list provided. '{value}' is not a valid option",
		// 				array('value' => $this->value)
		// 			),
		// 			"validation"
		// 		);
		// 		return false;
		// 	}
		// }
		return true;
	}

}
