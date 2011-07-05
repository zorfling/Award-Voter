<h4>User edit</h4>

<?=$this->flashMessage->output(); ?>

<?=$this->form->create($user); ?>
	<?=$this->partial->user_form(); ?>
	<?=$this->form->submit('Edit User'); ?>
<?=$this->form->end(); ?>