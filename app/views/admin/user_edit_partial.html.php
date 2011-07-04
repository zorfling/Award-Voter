<h4>User edit</h4>

<?=$this->flashMessage->output(); ?>

<?=$this->form->create($user); ?>
	<?=$this->form->field('id', array('type' => 'hidden'));?>
	<?=$this->form->field('username');?>
	<?=$this->form->field('password');?>
	<?=$this->form->field('first_name');?>
	<?=$this->form->field('surname');?>
	<?=$this->form->field('email');?>
	<?=$this->form->submit('Edit User'); ?>
<?=$this->form->end(); ?>