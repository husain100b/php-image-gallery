<?php 

require 'directoryReader.php';

$images = directoryReader('images');

if (!$images) {
    die('no folder found!');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>

        <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> -->

    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-200 p-4">
    <div class="max-w-6xl mx-auto">
        <div class="flex item-center justify-between">
            <div class="flex">
                <h1 class="text-2xl mb-8">
                    <strong>PHP Basic Course</strong><br>
                    Simple Image Gallery
                </h1>
            </div>

            <!-- Image Upload Form Start -->
            <form action="upload.php" method="POST" enctype="multipart/form-data" class="mb-4">
                <label for="imageUpload" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" id="imageUpload" name="image" class="mt-1 p-2 border rounded-md">
                <button type="submit" class="rounded bg-blue-500 p-4 py-2 text-white hover:bg-blue">Upload</button>
            </form> 
            <!-- Image Upload Form End -->

        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 border-t border-gray-300 pt-3">
            <?php foreach($images as $image) : ?>
                <img class="w-full h-[250px] object-cover rounded-lg" src="<?php echo $image; ?>" alt="">    
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>