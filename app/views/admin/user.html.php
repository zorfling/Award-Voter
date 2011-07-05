<?php
switch (strtolower($function)) {
	case 'list':
		echo $this->partial->user_list(compact('data'));
		break;
	case 'add':
		echo $this->partial->user_add(compact('user', 'success'));
		break;
	case 'edit':
		echo $this->partial->user_edit(compact('user', 'success'));
		break;
	case 'delete':
		echo $this->partial->user_delete(compact('data'));
		break;
}

