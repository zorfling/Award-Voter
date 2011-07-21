<h4>Clear Round Votes</h4>
<p>Are you sure?</p>
<?=$this->form->create(); ?>

<?=$this->form->field('round_id', array('type' => 'checkbox', 'label' => 'Yes, clear it.', 'value' => $roundId)); ?>
<?=$this->form->submit('Clear Round Votes'); ?>

<?=$this->form->end(); ?>
