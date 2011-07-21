<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Awards Voter</title>
	<?php echo $this->html->style(array('debug', 'lithium')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1>Awards Voter</h1>
			<h2>
				Powered by <?php echo $this->html->link('Lithium', 'http://lithify.me/'); ?>.
			</h2>
			<div id="menu-bar">


				<?php if (\lithium\security\Auth::check('customer')) { ?>
				<ul id="menu">
					<li><?= $this->html->link('Vote', 'awards::vote'); ?></li>
					<li><?= $this->html->link('Update Password', 'users::password'); ?></li>
				</ul>
				<?php } ?>

				<?php if (\lithium\security\Auth::check('customer')) { ?>
					Logged in - <a href="/users/logout/">Logout</a>
				<?php } else { ?>
					Logged out - <a href="/users/login/">Login</a>
				<?php } ?>
			</div>
		</div>
		<div id="content">

			<?=$this->flashMessage->output(); ?>

			<?php echo $this->content(); ?>
		</div>
	</div>
</body>
</html>