<?php
// Load .env variables
extract(parse_ini_file(__DIR__ . '/.env'));

$projects_file_path = __DIR__ . '/output/' . $OUTPUT_PROJECTS_FILE;
$databases_file_path = __DIR__ . '/output/' . $OUTPUT_DB_FILE;

// Read generated file and format array
$projects = [];
if (($handle = fopen($projects_file_path, 'r')) !== false) {
	while (($row = fgetcsv($handle, 1000, ',')) !== false) {
		if ($row[0]) {
			$projects[$row[1]] = [
				'name' => $row[0],
				'size' => $row[2],
			];
		}
	}

	fclose($handle);
}

$databases = [];
if (($handle = fopen($databases_file_path, 'r')) !== false) {
	while (($row = fgets($handle)) !== false) {
    $row = preg_split('/\s+/', trim($row));

    if (count($row) === 2) {
 			$databases[(int) $row[1]] = [
				'name' => $row[0],
				'size' => (int) $row[1] . 'M',
			];
		}
	}

	fclose($handle);
}

// Sort by size
krsort($projects);
krsort($databases);