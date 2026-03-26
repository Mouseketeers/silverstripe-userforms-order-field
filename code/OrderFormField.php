<?php
class OrderFormField extends FormField {

	protected $autoCompleteSource;
	protected $query;

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
