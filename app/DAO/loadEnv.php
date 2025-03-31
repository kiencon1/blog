<?php
function loadEnv($filePath) {
  // Kiểm tra xem file .env tồn tại hay không
  if (!file_exists($filePath)) {
    die("File .env not found!");
  }

  // Đọc từng dòng trong file .env
  $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    // Bỏ qua các dòng comment (bắt đầu bằng #)
    if (strpos(trim($line), '#') === 0) {
      continue;
    }

    // Phân tích dòng thành key và value
    if (strpos($line, '=') !== false) {
      list($key, $value) = explode('=', $line, 2);

      // Loại bỏ khoảng trắng thừa
      $key = trim($key);
      $value = trim($value);

      // Lưu vào $_ENV và $_SERVER
      $_ENV[$key] = $value;
    }
  }
}
