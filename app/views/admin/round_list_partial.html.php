<p><?= $this->html->link('Add Round', '/admin/round/add/'); ?></p>

<table class="table-votes">
	<thead>
		<tr>
			<th>Round Id</th>
			<th>Round Date</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<?php foreach ($rounds as $round) { ?>
	<tr>
		<td><?= $round->round_id ?></td>
		<td><?= date('d-m-Y', strtotime($round->round_date))?></td>
		<td><?= $this->html->link('Edit', '/admin/round/edit/'.$round->round_id.'/') ?></td>
		<td><?= $this->html->link('Results', '/admin/round/results/'.$round->round_id.'/') ?></td>
		<td><?= $this->html->link('Clear Votes', '/admin/round/clear/'.$round->round_id.'/') ?></td>
		<td><?= $this->html->link('Delete', '/admin/round/delete/'.$round->round_id.'/') ?></td>
	</tr>
	<?php } ?>
</table>
