<?php

if (isset($_POST['submit']) && !empty($_FILES['file']))
{
    $handle = fopen($_FILES['file']['tmp_name'], "r");
    $headers = fgetcsv($handle, 1000, ",");

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
    {
        $data[0];
        urlToStore($data[1]);
    }
    fclose($handle);

    echo "Saved successfully";
}

function urlToStore($url) {

    // Initialize the cURL session
    $ch = curl_init($url);

    // Initialize directory name where
    // file will be save
    $dir = 'files/';

    // Use basename() function to return
    // the base name of file
    $file_name = basename($url);

    // Save file into file location
    $save_file_loc = $dir . $file_name;

    // Open file
    $fp = fopen($save_file_loc, 'wb');

    // It set an option for a cURL transfer
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // Perform a cURL session
    curl_exec($ch);

    // Closes a cURL session and frees all resources
    curl_close($ch);

    // Close file
    fclose($fp);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>CSV To File Store</title>
</head>
<body>
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-md-6">
            <h4>CSV To File Store</h4>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Select file</label>
                    <input class="form-control" type="file" id="formFile" name="file" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
-->
</body>
</html>