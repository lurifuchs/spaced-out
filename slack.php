<?php
include('init.php');

$intro = "Here are the top 10 largest sites and databases on *$SERVER_URL*\n\n";

// Projects
$project_message = "*Projects*\n";
$index = 1;
foreach (array_slice($projects, 0, $SLACK_LIMIT) as $project) {
	$project_message .= $index . ". " . $project['name'] . " " . $project['size'] . "\n";
	$index++;
}

if (count($projects) > $SLACK_LIMIT) {
	$project_message .= "\nView " . (count($projects) - $SLACK_LIMIT) . " more projects on *$SITE_URL*.\n\n";
}

// Database
$database_message = "*Databases*\n";
$index = 1;
foreach (array_slice($databases, 0, $SLACK_LIMIT) as $database) {
	$database_message .= $index . ". " . $database['name'] . " " . $database['size'] . "\n";
	$index++;
}

if (count($databases) > $SLACK_LIMIT) {
	$database_message .= "\nView " . (count($databases) - $SLACK_LIMIT) . " more databases on *$SITE_URL*.";
}

// Format payload
$data = "payload=" . json_encode(array(
	"username" => "Spaced Out",
	"text" => $intro . $project_message . "\n\n" . $database_message,
));

// Send to slack
$ch = curl_init($SLACK_WEBHOOK);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);
