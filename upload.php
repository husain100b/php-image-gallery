<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ফাইল আপলোড করা হয়েছে কিনা চেক করা
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        die("❌ No file uploaded or an upload error occurred!");
    }

    $uploadDir = "images/";  // যেখানে ফাইল জমা হবে
    $file = $_FILES["image"];

    // ফাইল পাথ চেক করা (খালি হলে স্টপ)
    if (empty($file["tmp_name"])) {
        die("❌ Invalid file! Please try again.");
    }

    // **ইউনিক ফাইল নাম তৈরি**
    $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
    $uniqueFileName = time() . "_" . uniqid() . "." . $fileExtension;
    $filePath = $uploadDir . $uniqueFileName;

    // **ইমেজ টাইপ যাচাই (শুধু JPG, PNG, GIF অনুমোদিত)**
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($file["tmp_name"]);

    if (!in_array($fileType, $allowedTypes)) {
        die("❌ Only JPG, PNG, and GIF files are allowed!");
    }

    // **ফাইল সাইজ যাচাই (2MB এর বেশি হলে বাতিল)**
    $maxSize = 2 * 1024 * 1024; // 2MB
    if ($file["size"] > $maxSize) {
        die("❌ File size must be 2MB or smaller.");
    }

    // **ফাইল আপলোড & সংরক্ষণ**
    if (move_uploaded_file($file["tmp_name"], $filePath)) {
        header("Location: index.php"); // আপলোড সফল হলে গ্যালারিতে দেখাবে
        exit;
    } else {
        die("❌ Upload failed! Please try again.");
    }
}
