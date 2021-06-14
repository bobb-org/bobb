
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://developer.api.autodesk.com/modelderivative/v2/viewers/7.*/style.css">
    
</head>

<body>

Poniżej lista plików DWG znajdująca się na serwerze do odczytu/importu przez Forge:

<br>
<?php
  $dir    = 'C:/xampp/htdocs/Bobb/storage/app/dwgfiles/';
  $files1 = preg_grep('~\.(dwg)$~', scandir($dir,1));
  $num = 0;
  foreach ($files1 as $key => $value) {

    
   echo "<p>- ".$value ."</p>";

}

?>
</br> </br>
<p>Wybierz z listy plik który ma zostać wyświetlony/zaimportowany do Forge:</p>
</br>
<form action="ForgeConnect" method="get">

<select name="choosefile">
<option value="" disabled selected>Choose option</option>

<?php

  foreach ($files1 as $key => $value) {

    
     echo "<option value=$value>$value</option>";

  }
  echo $files1[2];
  echo "</select></br>";
   ?> 
    </br>
   <input type="submit" name="submit" value="Wyślij do Forge"/>
 
   </form>     
   </br>
   <form action="/">
    <input type="submit" value="Powrót" />
</form>
</body>
</html>