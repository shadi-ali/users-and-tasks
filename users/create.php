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
    <!--********        first we connect to DB to fill (placeholder)       ***************-->
    <!--******     that's mean we **{((((view)))}** old data to update it      ***********-->
    <?php
    require '../connect.php';
    $sql="SELECT * FROM users ;";
    $result=$conn->query($sql);
    ?>
    <form action="" method="post" class="w-50 mt-5 p-3 mx-auto text-center shadow-lg">
        <div class="namediv row m-2">
        <label for="n" class="col-4 ">User Name:</label>
        <input type="text" id="n" name="UserName" class="col-6">
        </div>
        <div class="citydiv row m-2">
        <label for="c" class="col-4">The City :</label>
        <select name="city" id="c"class="col-6">
            <?php
             $sql_city="SELECT * FROM city;";
             $result_city=$conn->query($sql_city);
             if($result_city->num_rows>0)
             {
                while($row_city=$result_city->fetch_assoc())
                {
                     ?>
                     <option value="<?php echo $row_city['id'];?>" selected><?php echo $row_city['CityName'] ?></option>
                     <?php
                }
             }
            ?>
        </select>
        </div>
        <div class="btndiv d-flex justify-content-evenly m-3">
            <button name="add_btn" class="rounded-pill px-3">Add</button>
            <a href="./index.php" class="text-decoration-none text-primary">show result</a>
        </div>
    </form>
    <!--*********       now insert information from (form $POST array) into DB     ***********-->
    <?php
        function validation($x)
        {
            $x=stripslashes($x);
            $x=trim($x);
            $x=htmlspecialchars($x);
            return $x;
        }
    if(isset($_POST['add_btn']))
    {
         if(empty($_POST['UserName']))
         {
            echo "please fill the user fild";
         }
         else
         {
            $UserName=validation($_POST['UserName']);
         }
         if(empty($_POST['city']))
         {
            echo "please fill the city fild";
         }
         else
         {
            $city_id=$_POST['city'];//this is the (id)
            $sql_n="SELECT CityName FROM city WHERE id='$city_id';";
            $result_n=$conn->query($sql_n);
            while($row_n=$result_n->fetch_assoc())
            {
                $city=$row_n['CityName'];
            }
         }
         if(!empty($_POST['UserName']&&!empty($_POST['city'])))
         {
            $sql_in="INSERT INTO users VALUES(null,'$UserName','$city');";
            if($conn->query($sql_in)===TRUE)
            {
                echo $UserName." "."is added";
            }
            else
            {
                echo "faild";
            }
         }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
    crossorigin="anonymous"></script>
</body>
</html>