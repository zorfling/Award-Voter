<h4>User List</h4>
<?php foreach ($data as $user) { ?>
<div class="row">
	<div class="id"><?= $user->id; ?></div>
	<div class="username"><?= $user->username; ?></div>
	<div class="link"><a href="/Admin/User/Edit/<?= $user->id; ?>/">Edit User</a></div>
</div>
<?php } ?>