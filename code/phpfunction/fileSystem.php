<?php
    function upload($file, $filePath) {
        $error = $file['error'];
        switch ($error) {
            case 0:
                $fileName = $file['name'];
                $fileTemp = $file['tmp_name'];
                $destination = $filePath . "/" . $fileName;
                move_uploaded_file($fileTemp, $destination);
                return "Uploaded successfully";
            case 1:
                return "Exceed upload_max_filesize";
            case 2:
                return "Exeed form MAX_FILE_SIZE";
            case 3:
                return "Attachment uploaded";
            case 4:
                return "No upload";
        }
    }
?>