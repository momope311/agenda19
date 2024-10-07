<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $upload_dir = '/content/img/';
        $upload_file = $upload_dir . basename($file['name']);
        
        // Check file type and size
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowed_types)) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid file type.']);
            exit;
        }
        
        if (move_uploaded_file($file['tmp_name'], $upload_file)) {
            echo json_encode(['location' => '/' . $upload_file]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to move uploaded file.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'No file uploaded or upload error.']);
    }
}
?>