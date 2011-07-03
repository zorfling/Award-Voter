<?php
switch ($function) {
	case 'list':
		echo $this->partial->user_list();
		break;
	case 'add':
		echo $this->partial->user_add();
		break;
	case 'edit':
		echo $this->partial->user_edit();
		break;
	case 'delete':
		echo $this->partial->user_delete();
		break;
}

