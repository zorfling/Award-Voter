<?php
switch (strtolower($function)) {
	case 'list':
		echo $this->partial->round_list(compact('rounds'));
		break;
	case 'results':
		echo $this->partial->round_results(compact('votes', 'users', 'round', 'stillToVote'));
		break;
	case 'add':
		echo $this->partial->round_add(compact('round', 'success', 'users'));
		break;
	case 'edit':
		echo $this->partial->round_edit(compact('round', 'success', 'users', 'roundUsers'));
		break;
	case 'delete':
		echo $this->partial->round_delete(compact('roundId'));
		break;
	case 'clear':
		echo $this->partial->round_clear(compact('roundId'));
		break;
	case 'comments':
		echo $this->partial->round_comments(compact('roundId', 'user', 'votes'));
		break;
}

