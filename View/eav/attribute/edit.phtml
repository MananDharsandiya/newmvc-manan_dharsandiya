<?php 
$eavAttribute = $this->getEavAttribute()['eavAttribute'];
$entityTypes = $this->getEntityTypes();
$optionsData = $this->getEavAttributeOption();
?>
<div class="container mt-5">
	<form action="<?php echo $this->getUrl('save'); ?>" method="post">
		<div class="row mb-3">
			<div class="col-md-6">
				<h2>Eav Attribute Information</h2>
			</div>
			<div class="col-md-6 d-flex justify-content-end align-items-center">
				<a href="<?php echo $this->getUrl('grid', null, [], true); ?>" class="btn btn-secondary me-2">Cancel</a>
				<button type="submit" class="btn btn-success">Submit</button>
			</div>
		</div>
		<div class="form-floating mb-3">
			<select name="eavAttribute[entity_type_id]" class="form-select">
				<?php foreach ($entityTypes as $entityType) : ?>
					<option value="<?php echo $entityType->entity_type_id; ?>"><?php echo $entityType->name; ?></option>
				<?php endforeach; ?>
			</select>
			<label>Status</label>
		</div>
		<div class="form-floating mb-3">
			<input type="text" name="eavAttribute[code]" class="form-control" placeholder=" " value="<?php echo $eavAttribute->code;?>">
			<label>Code</label>
		</div>
		<div class="form-floating mb-3">
			<select name="eavAttribute[backend_type]" class="form-select">
				<option value="int">Integer</option>
				<option value="float">Decimal</option>
				<option value="varchar">Varchar</option>
				<option value="datetime">Date & Time</option>
				<option value="text">Text</option>
			</select>
			<label>Backend Type</label>
		</div>
		<div class="form-floating mb-3">
			<select name="eavAttribute[input_type]" class="form-select" id="inputTypeSelect" onchange="changeInputType(this)">
				<option value="textbox">Text Box</option>
				<option value="textarea">Text Area</option>
				<option value="select">Select</option>
				<option value="multiselect">Multi Select</option>
				<option value="radio">Radio</option>
				<option value="checkbox">Checkbox</option>
			</select>
			<label>Input Type</label>
		</div>
		<div class="form-floating mb-3">
			<input type="text" name="eavAttribute[name]" class="form-control" placeholder=" " value="<?php echo $eavAttribute->name;?>">
			<label>Name</label>
		</div>
		<div class="form-floating mb-3">
			<select name="eavAttribute[status]" class="form-select">
				<?php foreach ($eavAttribute->getStatusOptions() as $key => $value) : ?>
					<?php $selected = ($key == $eavAttribute->getStatus()) ? "selected" : ''; ?>
					<option value="<?php echo $key; ?>" <?php echo $selected;?>><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
			<label>Status</label>
		</div>
		<div class="form-floating mb-3">
			<input type="text" name="eavAttributeOptions[backend_model]" class="form-control" placeholder=" " value="<?php echo $eavAttribute->backend_model;?>">
			<label>Backend Model</label>
		</div>
		<div style="border: 1px solid black; display: none;" id = "inputTypeOptionDiv">
			<table>
				<thead>
					<tr>
						<th>
							&nbsp;
						</th>
						<th>
							<input type="button" name="add" value="Add" id="addOption">
						</th>
					</tr>
				</thead>
				<tbody id="inputTypeOptionTable">
					<?php if ($optionsData) : ?>
					<?php foreach ($optionsData->getData() as $optionData): ?>
						<tr>
							<td><input type="text" name="options[exist][<?php echo $optionData->option_id; ?>]" value="<?php echo $optionData->name ?>"></td>
							<td><input type="button" name="remove" value="REMOVE" class="removeOption" ></td>
						</tr>
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</form>
	<table style="display: none;">
		<tbody id="inputTypeOptionDefault">
			<tr>
				<td>
					<input type="text" name="options[new][name][]">
				</td>
				<td>
					<input type="button" name="remove" value="Remove" class="removeOption">
				</td>
			</tr>
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(".removeOption").click(function(){
		console.log($(this).parent().parent().remove());
	});

	$("#addOption").click(function(){
		$('#inputTypeOptionTable').prepend($("#inputTypeOptionDefault").html());
	});

	$("#inputTypeSelect").change(function (){
		var inputType = $(this);
		if (inputType.val() == 'select' || inputType.val() == 'multiselect' || inputType.val() == 'radio' || inputType.val() == 'checkbox') {
			$('#inputTypeOptionDiv').show();
		}	
		else {
			$('#inputTypeOptionDiv').hide();
		}
	});

	$(document).ready(function (){
		$("#inputTypeSelect").trigger('change');
	});
</script>