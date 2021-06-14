
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://developer.api.autodesk.com/modelderivative/v2/viewers/7.*/style.css">
    
</head>

<body>
<form action="uploadfile" method="post" enctype="multipart/form-data">
@csrf <!-- {{ csrf_field() }} -->
</br>
<input type="file" name="file" size="5000" />

<br />

<input type="submit" value="Upload" />

</form>
</br>
<form action="/">
    <input type="submit" value="Powrót" />
</form>

</body>
</html>