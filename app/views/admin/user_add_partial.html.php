<h4>User add</h4>

<?=$this->form->create(); ?>
	<?=$this->partial->user_form(); ?>
	<?=$this->form->submit('Add User'); ?>
<?=$this->form->end(); ?>