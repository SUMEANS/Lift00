<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title> SAD2 SMS SERVICE LOGIN </title>
</head>


<body>
<center>
    <h1>Input your Phone NUMBER!</h1><br>

     <p><h2>저장된 번호 목록</h2></p>
       <?php include("testing.php"); ?>
     

    <form method='get' action='member.php'>
        <p>PHONE: <input name="pn" type="text"></p>
        <input type=submit value="승인">
    </form>
</center>
</body>

</html>
