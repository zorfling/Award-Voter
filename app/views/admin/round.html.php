<?php foreach ($votes as $awardId => $award) { ?>
	<h4><?= $award['title']; ?></h4>
	<table>
		<thead>
			<tr>
				<th>User</th>
				<th>Votes</th>
			</tr>
		</thead>
		<?php foreach ($award['data'] as $vote) { ?>
		<tr>
			<td><?= $users[$vote->votee_user_id]; ?></td>
			<td><?= $vote->count; ?></td>
		</tr>
		<?php } ?>
	</table>
<?php } ?>
