<?=$this->form->hidden('round_id');?>
<?=$this->form->field('round_date', array('label' => 'Round Date (YYYY-MM-DD)'));?>

<?php foreach ($users as $user) { ?>
	<div class="form-row">
		<?=$this->form->field('round_users[]', array(	'type' => 'checkbox',
														'value' => $user->id,
														'label' => $user->getFullName(),
														'checked' => (isset($roundUsers[$user->id])),
														'id' => 'round_users_'.$user->id
													));?>
		<?=$this->form->field('round_user_weight_'.$user->id, array('label' => 'Weight', 'value' => (isset($roundUsers[$user->id]) ? $roundUsers[$user->id] : '' )));?>
	</div>
<?php } ?>