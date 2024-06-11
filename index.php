<?php include('init.php'); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Spaced Out</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>
  <body>
		<div class="container mt-5 mb-5">
			<h2 class="mt-5 mb-3">Projects</h2>
			<ul class="list-group">
				<?php foreach ($projects as $project): ?>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<?php echo $project['name']; ?>
						<span class="badge badge-secondary badge-pill"><?php echo $project['size']; ?></span>
					</li>
				<?php endforeach; ?>
			</ul>

			<h2 class="mt-5 mb-3">Databases</h2>
			<ul class="list-group">
				<?php foreach ($databases as $database): ?>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<?php echo $database['name']; ?>
						<span class="badge badge-secondary badge-pill"><?php echo $database['size']; ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</body>
</html>

