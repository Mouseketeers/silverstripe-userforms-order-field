<?php

class EditableOrderFormField extends EditableFormField {

	private static $singular_name = 'Order Form';
	
	private static $plural_name = 'Order Forms';	


	public function getFieldConfiguration() {
		$options = parent::getFieldConfiguration();

		$sourceField = new TextField(
			$this->getSettingName('AutoCompleteSource'),
			'Auto Complete Source', 
			$this->getSetting('AutoCompleteSource')
		);
		$options->push($sourceField);
		
		$queryField = new TextField(
			$this->getSettingName('Query'),
			'Query', 
			$this->getSetting('Query')
		);
		$options->push($queryField);

			
		return $options;
	}
	public function getFormField() {
		return OrderFormField::create($this->Name, $this->Title)
			->setAutoCompleteSource($this->getSetting('AutoCompleteSource'))
			->setQuery($this->getSetting('Query'));
	}
	
	public function getValueFromData($data) {

		$result = '';

		$orderItems = array();

		$orderData = (isset($data[$this->Name])) ? $data[$this->Name] : false;
		
		if($orderData) {

			$qty = $orderData['qty'];
			$item = $orderData['item'];
			$rowsCount = count($qty);

			for($i = 0; $i < $rowsCount; $i++) {
				if($qty[$i] && $item[$i]) {			
					$result .= $qty[$i] . ' x ' . $item[$i] . "\n";
					// for($q = 0; $q < $qty[$i]; $q++) {
					// 	$submission = new OrderFormSubmission();
					// 	$submission->Item = $item[$i];
					// 	$submission->Type = $this->Title;
					// 	$submission->FormFieldID = $this->ID;
					// 	$submission->write();
					// }
				}
			}
		}
		return $result;
	}
	public function getIcon() {
		return  USERFORMS_DIR . '/images/editabletextfield.png';
	}
}
