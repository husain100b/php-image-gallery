<?php 

function directoryReader($directory, array $exclude = array('.', '..')) {
    $files = [];

    if (!is_dir($directory)) {
        return null;
    }

    if (!($fileDirectory = opendir($directory))) {
        return null;
    }

    while (($file = readdir($fileDirectory)) !== false) {
        if (in_array($file, $exclude)) {
            continue;
        }

        $filePath = $directory . '/' . $file;

        // **শুধু ইমেজ ফাইল লোড করবে (JPG, JPEG, PNG, GIF)**
        if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
            $files[] = $filePath;
        }
    }

    closedir($fileDirectory);

    return $files;
}
