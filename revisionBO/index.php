<?php include 'conexiones.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revision BO</title>
    
    <script src="assets/js/masterin.js" async defer></script>
</head>

<body>
 <?php 
    while ( mysql_fetch($queryCuestionarios)) {
        # code...
    }
 ?>
    

</body>

</html>