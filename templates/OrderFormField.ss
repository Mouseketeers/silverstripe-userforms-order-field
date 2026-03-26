<% require javascript(userforms-order-field/vendor/devbridge-autocomplete/dist/jquery.autocomplete.min.js) %>
<% require javascript(userforms-order-field/javascript/order-form-field.js) %>
<div $AttributesHTML>
	<table id="$Name" class="order-form-table">
		<thead>
			<tr>
				<th style="min-width:5rem">Qty</th>
				<th width="100%">Item</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr class="table-row">
				<td class="qty"><input type="number" name="$Name[qty][]" value="1" min="1"></td>
				<td class="item"><input type="text" class="autocomplete" name="$Name[item][]" <% if $AutoCompleteSource %> data-source="$AutoCompleteSource" autocomplete="off" placeholder="Start typing for suggestions..."<% end_if %><% if $Query %> data-query="$Query"<% end_if %>></td>
				<td><button type="button" class="delete-row button">-</button></td>
			</tr>
		</tbody>
	</table>
	<p><button type="button" class="add-row button">Add Row</button></p>
</div>
