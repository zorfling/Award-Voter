<h4>Comments for Round <?= $roundId; ?> for <?= $user->getFullName(); ?></h4>
<?php foreach ($votes as $vote) { ?>

<p><?= $vote->comments; ?></p>

<?php } ?>


<?= $this->html->link('Back to results', '/admin/round/results/'.$roundId.'/'); ?>