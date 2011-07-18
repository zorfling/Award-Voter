<h4>Round edit</h4>

<?=$this->flashMessage->output(); ?>

<?=$this->form->create($round); ?>
	<?=$this->partial->round_form(); ?>
	<?=$this->form->submit('Edit Round'); ?>
<?=$this->form->end(); ?>