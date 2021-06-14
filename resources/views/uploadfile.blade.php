
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://developer.api.autodesk.com/modelderivative/v2/viewers/7.*/style.css">
    
</head>

<body>
<?php
$targetfolder = 'C:/xampp/htdocs/Bobb/storage/app/';
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;



if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

{

echo "The file ". basename( $_FILES['file']['name']). " is uploaded";

}
else {

echo "Problem uploading file";

}


?>
<form action="/">
    <input type="submit" value="Powrót" />
</form>
</body>
</html>