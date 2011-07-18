<?php $this->scripts('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>'); ?>
<?php $this->scripts('<script src="/js/jquery.tablesorter.js"></script>'); ?>
<script>
$(document).ready(function()
	{
		$(".table-votes").tablesorter({ sortList: [[2,1]] });
	}
);
</script>
<p>
	Round <?= $round->round_id; ?><br />
	Ending <?= date('d-m-Y', strtotime($round->round_date)); ?>
</p>
<?php foreach ($votes as $awardId => $award) { ?>
	<h4><?= $award['title']; ?></h4>
	<table class="table-votes">
		<thead>
			<tr>
				<th>User</th>
				<th>Votes</th>
				<th>Weighted Votes</th>
			</tr>
		</thead>
		<?php foreach ($award['data'] as $votee_user_id => $vote) { ?>
		<tr>
			<td><?= $users[$votee_user_id]->getFullName(); ?></td>
			<td><?= $vote['votes']; ?></td>
			<td><?= $vote['weightedVotes']; ?></td>
		</tr>
		<?php } ?>
	</table>
<?php } ?>
