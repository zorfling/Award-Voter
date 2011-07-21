<h4>Delete Round</h4>
<p>Are you sure?</p>
<?=$this->form->create(); ?>

<?=$this->form->field('round_id', array('type' => 'checkbox', 'label' => 'Yes, delete it.', 'value' => $roundId)); ?>
<?=$this->form->submit('Delete Round'); ?>

<?=$this->form->end(); ?>
