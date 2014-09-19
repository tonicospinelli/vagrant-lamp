<?php
// MySQL
try{
	$pdo = new PDO('mysql:host=localhost;port=3306', 'root', 'root');

	$mysql_version = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
	$stmt = $pdo->query('show databases;');
    $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch( Exception $e){
	$mysql_version = false;
	$databases = array();
}



?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Vagrant LAMP stack</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
	<style type="text/css">
	html, body {
		height: 100%;
	}
	#wrap {
		min-height: 100%;
		height: auto !important;
		height: 100%;
		margin: 0 auto -60px;
	}
	#push, #footer {
		height: 60px;
	}
	#footer {
		background-color: #f5f5f5;
	}
	@media (max-width: 767px) {
		#footer {
			margin-left: -20px;
			margin-right: -20px;
			padding-left: 20px;
			padding-right: 20px;
		}
	}
	.container {
		width: auto;
		max-width: 680px;
	}
	.container .credit {
		margin: 20px 0;
	}
	.page-header i {
		float: left;
		margin-right: 12px;
	}
	table td:first-child {
		width: 300px;
	}
    </style>
</head>
<body>
	<div id="wrap">
		<div class="container">
			<div class="page-header">
				<h1>
					<i class="fa fa-coffee"></i>
					It works!
				</h1>
			</div>
			<p class="lead">The Virtual Machine is up and running, yay! Here's some additional information you might need.</p>

			<h3>
				<i class="fa fa-cogs"></i>
				Installed software
			</h3>
			<table class="table table-striped">
				<tr>
					<td>Environment</td>
					<td><?php echo $_SERVER['APP_ENV']; ?></td>
				</tr>

				<tr>
					<td>PHP Version</td>
					<td><?php echo phpversion(); ?></td>
				</tr>

				<tr>
					<td>MySQL version</td>
					<td><?php echo ($mysql_version ? $mysql_version : '<i class="fa fa-times"></i>'); ?></td>
				</tr>

				<tr>
					<td>Apache</td>
					<td><?php echo (function_exists('apache_get_version') ? apache_get_version() : 'N/A'); ?></td>
				</tr>

			</table>

			<h3>
				<i class="fa fa-plug"></i>
				PHP Modules
			</h3>
			<table class="table table-striped">

				<?php $loadedModules = array('xdebug', 'apc', 'pdo', 'pdo_mysql', 'pdo_sqlite', 'intl', 'gd'); ?>

				<?php foreach ($loadedModules as $loadedModule) : ?>
					<?php
					try {
						$version = (new \ReflectionExtension($loadedModule))->getVersion();
						if(empty($version)){
							$version = '<i class="fa fa-check"></i>';
						}
					} catch (Exception $e) {
						$version = null;
					}
					?>
					<tr>
						<td><?php echo $loadedModule ?></td>
						<td>
							<?php echo ($version ? $version : '<i class="fa fa-times"></i>'); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>

			<h3>
				<i class="fa fa-key"></i>
				MySQL credentials
			</h3>
			<table class="table table-striped">
				<tr>
					<td>Hostname</td>
					<td>localhost</td>
				</tr>

				<tr>
					<td>Username</td>
					<td>root</td>
				</tr>

				<tr>
					<td>Password</td>
					<td>root</td>
				</tr>
			</table>
			<h3>
				<i class="fa fa-database"></i>
				MySQL Databases
			</h3>
			<table class="table table-striped">
				<tr>
					<?php if (empty($databases)) : ?>
						<td>No databases found.</td>
					<?php else :?>
						<tr><td><?php echo implode('</td></tr><tr><td>', $databases); ?></td></tr>
					<?php endif; ?>
				</tr>
				<tr>
					<td><em>Note: External access is enabled! Just use <strong><?php echo $_SERVER['SERVER_ADDR'] ?></strong> as host.</em></td>
				</tr>
			</table>
		</div>

		<div id="push"></div>
	</div>

	<div id="footer">
		<div class="container">
			<p class="muted credit"><a href="https://github.com/tonicospinelli/vagrant-lamp.git" target="_blank">Vagrant LAMP</a> by <a href="https://github.com/tonicospinelli" traget="_blank">Antonio Spinelli</a>.</p>
		</div>
	</div>
</body>
</html>
