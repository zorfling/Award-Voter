<?=$this->form->hidden('round_id');?>
<?=$this->form->field('round_date', array('label' => 'Round Date (YYYY-MM-DD)'));?>
<?=$this->form->field('round_status', array('type' => 'select', 'list' => array('-1' => 'Pending', '1' => 'Active', '2' => 'Closed'), 'label' => 'Round Status'));?>

<?php foreach ($users as $user) { ?>
	<div class="form-row">
		<?=$this->form->field('round_users[]', array(	'type' => 'checkbox',
														'value' => $user->id,
														'label' => $user->getFullName(),
														'checked' => (isset($roundUsers[$user->id]) || empty($roundUsers)),
														'id' => 'round_users_'.$user->id
													));?>
		<?=$this->form->field('round_user_weight_'.$user->id, array('label' => 'Weight', 'value' => (isset($roundUsers[$user->id]) ? $roundUsers[$user->id] : (empty($roundUsers)?'1':'') )));?>
	</div>
<?php } ?>