<h4>User List</h4>
<table class="table-votes">
	<thead>
		<tr>
			<th>User Id</th>
			<th>Username</th>
			<th></th>

		</tr>
	</thead>
	<?php foreach ($data as $user) { ?>
	<tr>
		<td class="id"><?= $user->id; ?></td>
		<td class="username"><?= $this->html->link($user->username, '/admin/user/edit/'.$user->id); ?></td>
		<td class="link"><?= $this->html->link('Edit', '/admin/user/edit/'.$user->id); ?></td>
	</tr>
	<?php } ?>
</table>