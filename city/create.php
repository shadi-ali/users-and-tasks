<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" class=" d-block w-50 mx-auto mt-5">
        <label for="c">enter city name :</label>
        <input type="text" name ="cityname" id="c">
        <button name="city_add">add</button>
    </form>
    <a href="./index.php" class="d-block w-25 mx-auto my-3 text-decoration-none">show result</a>
    <?php
    function validation($x)
    {
        $x=stripslashes($x);
        $x=trim($x);
        $x=htmlspecialchars($x);
        return $x;
    }
    $cityname="";
    if(isset($_POST['city_add']))
    {
        if(empty($_POST['cityname']))
        {
            echo "please enter name";
        }
        else
        {
            require '../connect.php';
             $cityname=validation($_POST['cityname']);
             $sql="INSERT INTO city VALUES(null,'$cityname');";
             if($conn->query($sql)===TRUE)
             {
                echo $cityname."is added";
             }
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
    crossorigin="anonymous"></script>
</body>
</html>