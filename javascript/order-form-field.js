$(document).ready(function() {

	var orderFormTables = $('.order-form-table');

	orderFormTables.on('focus.autocomplete', '.autocomplete', function () {

		var data = $(this).data();

		if(data.source) {

			var url = '/api/v1/' + data.source + '.json';
			if(data.query) {
				url += '?' + data.query;
			}

			$(this).devbridgeAutocomplete({
				serviceUrl: url,
				paramName: 'LookUpText',
				params: { 'limit': 20 },
				dataType: 'json',
				autoSelectFirst: true,
				showNoSuggestionNotice: true,
				noSuggestionNotice: 'No matching items found',
				transformResult: function(response) {
					return {
						suggestions: $.map(response.items, function(dataItem) {
							return { value: dataItem.Number + ' ' + dataItem.Name, data: dataItem.Name };
						})
					};
				},
				onInvalidateSelection: function() {
					// $(this).val("");
					// console.log('onInvalidateSelection');
				},
				onSearchError: function(query, jqXHR, textStatus, errorThrown) {
					// todo
					console.log(textStatus);
				}
			});
			$(this).on('focusout', function() {
				
				var value = this.value;
				
				if(value) {
					var hasMatch = false;
					suggestions = $(this).devbridgeAutocomplete().suggestions;
					if(suggestions.length) {
						// need to wait for value to be set when selecting from the list
						setTimeout(function() {
							$.each(suggestions, function(index, value) {
								if(value.value == value) {
									hasMatch = true;
									return false;
								}
							});
						},800);

					}					
					if(!hasMatch) {
						$(this).val("");
					}
				}
			});
		}
	});	

	$(document).on('click', '.add-row', function() {
		var table = $(this).closest('.order-form-field');
		var tbody = table.find('tbody');
		var rowClone = tbody.children('.table-row').first().clone();
		clearTabularDataRow(rowClone);
		tbody.append(rowClone);
	});

	$(document).on('click', '.delete-row', function() {
		// todo: destroy autocomplate
		// var autocompleteField = $(this).find('input.autocomplete');
		// console.log(autocompleteField.devbridgeAutocomplete());
		// autocompleteField.devbridgeAutocomplete().dispose();
		if(confirm('Are you sure you want to delete this row?')) {
			var rowCount = $(this).closest('tbody').children('tr').length;
			var row = $(this).closest('tr');
			if(rowCount > 1) {
				row.remove();	
			}
			else {
				clearTabularDataRow(row);
			}
		}
	});
	function clearTabularDataRow(row) {
		row.find('input').val('');
		row.find('.qty input').val('1')
	}
});