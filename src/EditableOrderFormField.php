<?php

namespace Mouseketeers\UserForms\OrderField;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\UserForms\Model\EditableFormField;

class EditableOrderFormField extends EditableFormField {

	private static $singular_name = 'Order Form';
	
	private static $plural_name = 'Order Forms';

	private static $table_name = 'EditableOrderFormField';

	private static $db = [
		'AutoCompleteSource' => 'Varchar(255)',
		'Query' => 'Varchar(255)'
	];	


	public function getFieldConfiguration() {
		$options = parent::getFieldConfiguration();

		$sourceField = new TextField(
			'AutoCompleteSource',
			'Auto Complete Source', 
			$this->AutoCompleteSource
		);
		$sourceField->setName('AutoCompleteSource');
		$options->push($sourceField);
		
		$queryField = new TextField(
			'Query',
			'Query', 
			$this->Query
		);
		$queryField->setName('Query');
		$options->push($queryField);

			
		return $options;
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab('Root.Main', TextField::create(
			'AutoCompleteSource',
			'Auto Complete Source'
		));
		
		$fields->addFieldToTab('Root.Main', TextField::create(
			'Query', 
			'Query'
		));
		
		return $fields;
	}
	public function getFormField() {
		return OrderFormField::create($this->Name, $this->Title)
			->setAutoCompleteSource($this->AutoCompleteSource)
			->setQuery($this->Query);
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
		return 'mouseketeers/userforms-order-field:images/editabletextfield.png';
	}
}
