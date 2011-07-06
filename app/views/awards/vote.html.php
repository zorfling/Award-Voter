Hello Awards!
<?= $this->form->create(); ?>
<?php foreach ($awards as $award) { ?>
	<h4><?= $award->name ?></h4>
	<?php foreach ($users as $user) { ?>
		<?= $this->form->field('award_'.$award->award_id, array(
				'label' => $user->getFullName(),
				'type'	=> 'radio',
				'id'	=> 'award_'.$award->award_id.'_user_'.$user->id,
				'value'	=> $user->id)); ?>
	<?php } ?>
<?php } ?>
<?= $this->form->submit('Vote'); ?>
<?= $this->form->end(); ?>