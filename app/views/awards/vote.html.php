<?php if ($round == null) { ?>

<p>There are currently no rounds available to vote on.</p>

<?php } else { ?>

<p>
	Voting for Round <?= $round->round_id; ?><br />
	Ending <?= date('d-m-Y', strtotime($round->round_date)); ?>
</p>
<?= $this->form->create(); ?>
<div class="award-row">
<?php foreach ($awards as $award) { ?>
	<div class="award-container">
		<h4><?= $award->name ?></h4>
		<?php foreach ($users as $user) { ?>
			<?= $this->form->field('award_'.$award->award_id, array(
					'label' => $user->getFullName(),
					'type'	=> 'radio',
					'id'	=> 'award_'.$award->award_id.'_user_'.$user->id,
					'value'	=> $user->id)); ?>
		<?php } ?>
	</div>
<?php } ?>
</div>
<?= $this->form->submit('Vote'); ?>
<?= $this->form->end(); ?>

<?php } ?>