<?php
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
$csvPath = __DIR__ . '/65HTTT_Danh_sach_diem_danh.csv';
?>
<!doctype html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Danh sách tài khoản (CSV)</title>
	<link rel="stylesheet" href="Bai3.css">
</head>
<body>
	<h1>Danh sách tài khoản</h1>
	<p>File: <code><?php echo basename($csvPath); ?></code></p>
	<?php if (!file_exists($csvPath)): ?>
		<p class="error">Không tìm thấy tệp CSV tại <code><?php echo htmlspecialchars($csvPath, ENT_QUOTES, 'UTF-8'); ?></code></p>
	<?php else: ?>
		<p><a href="<?php echo htmlspecialchars(basename($csvPath), ENT_QUOTES, 'UTF-8'); ?>" download>Download CSV</a></p>
		<table>
			<caption>Những dòng đầu tiên từ tệp CSV</caption>
			<thead>
			<?php
			$handle = fopen($csvPath, 'r');
			if ($handle === false) {
					echo '<tr><th>Lỗi</th></tr></thead><tbody><tr><td>Không thể mở tệp để đọc.</td></tr></tbody></table>';
			} else {
					// Read header row
					$header = fgetcsv($handle);
					if ($header === false) {
							echo '<tr><th>Trống</th></tr></thead><tbody><tr><td>Tệp CSV rỗng.</td></tr></tbody></table>';
					} else {
							echo "<tr>";
							foreach ($header as $col) {
									echo '<th>' . htmlspecialchars($col, ENT_QUOTES, 'UTF-8') . '</th>';
							}
							echo "</tr>\n";
							echo "</thead>\n<tbody>\n";

							// Output remaining rows
							$rowCount = 0;
							while (($row = fgetcsv($handle)) !== false) {
									echo '<tr>';
									// ensure we print same number of columns as header
									$cols = count($header);
									for ($i = 0; $i < $cols; $i++) {
											$val = isset($row[$i]) ? $row[$i] : '';
											echo '<td>' . nl2br(htmlspecialchars($val, ENT_QUOTES, 'UTF-8')) . '</td>';
									}
									echo '</tr>\n';
									$rowCount++;
							}
							if ($rowCount === 0) {
									echo '<tr><td colspan="' . count($header) . '">Không có bản ghi nào.</td></tr>';
							}
							echo "</tbody>\n</table>\n";
					}
					fclose($handle);
			}
			?>
	<?php endif; ?>

	
</body>
</html>


