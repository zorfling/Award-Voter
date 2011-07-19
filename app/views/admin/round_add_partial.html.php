<h4>Round add</h4>

<?=$this->form->create(); ?>
	<?=$this->partial->round_form(compact('users')); ?>
	<?=$this->form->submit('Add Round'); ?>
<?=$this->form->end(); ?>