<?= $this->form->create(); ?>

<?= $this->form->field('password', array('type' => 'password')); ?>
<?= $this->form->field('password_confirm', array('type' => 'password')); ?>
<?= $this->form->submit('Update Password'); ?>

<?= $this->form->end(); ?>
