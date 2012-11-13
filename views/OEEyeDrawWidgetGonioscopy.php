<!-- Uncomment following line to re-enable doodle hover tooltips once layer bug is fixed (OE-1583) -->
<!-- <span id="canvasTooltip"></span> -->
<div data-side="<?php echo $side?>">
	<input type="hidden" id="<?php echo $inputId?>"
		name="<?php echo $inputName?>"
		value='<?php echo $this->model[$this->attribute]?>' />
	<?php if ($isEditable && $toolbar) {?>
	<div style="float: left">
		<div class="ed_toolbar">
			<button class="ed_img_button" disabled='disabled'
				id="moveToFront<?php echo $idSuffix?>" title="Move to front"
				onclick="<?php echo $drawingName?>.moveToFront(); return false;">
				<img src="<?php echo $imgPath?>moveToFront.gif" />
			</button>
			<button class="ed_img_button" disabled='disabled'
				id="moveToBack<?php echo $idSuffix?>" title="Move to back"
				onclick="<?php echo $drawingName?>.moveToBack(); return false;">
				<img src="<?php echo $imgPath?>moveToBack.gif" />
			</button>
			<button class="ed_img_button" disabled='disabled'
				id="deleteDoodle<?php echo $idSuffix?>" title="Delete"
				onclick="<?php echo $drawingName?>.deleteDoodle(); return false;">
				<img src="<?php echo $imgPath?>deleteDoodle.gif" />
			</button>
			<button class="ed_img_button" disabled='disabled'
				id="lock<?php echo $idSuffix?>" title="Lock"
				onclick="<?php echo $drawingName?>.lock(); return false;">
				<img src="<?php echo $imgPath?>lock.gif" />
			</button>
			<button class="ed_img_button" id="unlock<?php echo $idSuffix?>"
				title="Unlock"
				onclick="<?php echo $drawingName?>.unlock(); return false;">
				<img src="<?php echo $imgPath?>unlock.gif" />
			</button>
		</div>
		<div class="ed_toolbar">
			<?php foreach ($doodleToolBarArray as $i => $item) {?>
			<button class="ed_img_button"
				id="<?php echo $item['classname'].$idSuffix?>"
				title="<?php echo $item['title']?>"
				onclick="<?php echo $drawingName?>.addDoodle('<?php echo $item['classname']?>'); return false;">
				<img src="<?php echo $imgPath.$item['classname']?>.gif" />
			</button>
			<?php }?>
		</div>
	</div>
	<?php }?>
	<canvas id="<?php echo $canvasId?>" class="<?php if ($isEditable) { echo 'edit'; } else { echo 'display'; }?>" width="<?php echo $size?>" height="<?php echo $size?>" tabindex="1"<?php if ($canvasStyle) {?> style="<?php echo $canvasStyle?>"<?php }?>></canvas>
	<?php if ($isEditable) {?>
	<div class="eyedrawFields">
		<div<?php if(!$model->getSetting('expert')) { ?> style="display: none;"<?php } ?>>
			<div class="data">
				<?php echo CHtml::activeDropDownList($model, $side.'_gonio_sup_id', $model->getGonioscopyOptions(), array('class' => 'gonioGrade gonioExpert', 'data-position' => 'sup'))?>
			</div>
			<div class="data">
				<?php echo CHtml::activeDropDownList($model, $side.'_gonio_tem_id', $model->getGonioscopyOptions(), array('class' => 'gonioGrade gonioExpert', 'data-position' => 'tem'))?>
			</div>
			<div class="data">
				<?php echo CHtml::activeDropDownList($model, $side.'_gonio_nas_id', $model->getGonioscopyOptions(), array('class' => 'gonioGrade gonioExpert', 'data-position' => 'nas'))?>
			</div>
			<div class="data">
				<?php echo CHtml::activeDropDownList($model, $side.'_gonio_inf_id', $model->getGonioscopyOptions(), array('class' => 'gonioGrade gonioExpert', 'data-position' => 'inf'))?>
			</div>
		</div>
		<?php if($model->getSetting('expert')) { ?>
		<div>
			<div class="label">
				<?php echo $model->getAttributeLabel($side.'_van_herick_id'); ?>
				:
			</div>
			<div class="data">
				<?php echo CHtml::activeDropDownList($model, $side.'_van_herick_id', $model->getVanHerickOptions())?>
			</div>
		</div>
		<?php } else { ?>
		<div>
			<?php $basic_options = array('0' => 'No', '1' => 'Yes'); ?>
			<div class="data">
				<?php echo CHtml::dropDownList($side.'_gonio_sup_basic', null, $basic_options, array('class' => 'gonioGrade gonioBasic', 'data-position' => 'sup'))?>
			</div>
			<div class="data">
				<?php echo CHtml::dropDownList($side.'_gonio_tem_basic', null, $basic_options, array('class' => 'gonioGrade gonioBasic', 'data-position' => 'tem'))?>
			</div>
			<div class="data">
				<?php echo CHtml::dropDownList($side.'_gonio_nas_basic', null, $basic_options, array('class' => 'gonioGrade gonioBasic', 'data-position' => 'nas'))?>
			</div>
			<div class="data">
				<?php echo CHtml::dropDownList($side.'_gonio_inf_basic', null, $basic_options, array('class' => 'gonioGrade gonioBasic', 'data-position' => 'inf'))?>
			</div>
		</div>
		<?php } ?>
		<div>
			<div class="label">
				<?php echo $model->getAttributeLabel($side.'_description'); ?>
				:
			</div>
			<div class="data">
				<?php echo CHtml::activeTextArea($model, $side.'_description', array('rows' => "2", 'cols' => "20", 'class' => 'autosize')) ?>
			</div>
		</div>
		<div>TODO: Foster images</div>
		<button class="ed_report">Report</button>
		<button class="ed_clear">Clear</button>
	</div>
	<?php } else { ?>
	<div class="eyedrawFields view">
		<div>
			<div class="data">
				<?php echo $model->{$side.'_description'} ?>
			</div>
		</div>
		<div>
			<div class="data">
				<?php if($gonio = $model->{$side.'_gonio_sup'}) { 
					echo $gonio->name;
				} ?>
				<?php if($gonio = $model->{$side.'_gonio_tem'}) { 
					echo $gonio->name;
				} ?>
				<?php if($gonio = $model->{$side.'_gonio_nas'}) { 
					echo $gonio->name;
				} ?>
				<?php if($gonio = $model->{$side.'_gonio_inf'}) { 
					echo $gonio->name;
				} ?>
			</div>
		</div>
		<?php if($model->{$side.'_van_herick_id'} || $model->getSetting('expert')) { ?>
		<div>
			<div class="data">
				<?php echo $model->getAttributeLabel($side.'_van_herick_id') ?>
				:
				<?php if($van_herick = $model->{$side.'_van_herick'}) { 
					echo $van_herick->name;
				} else {
					echo 'NR';
				} ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>