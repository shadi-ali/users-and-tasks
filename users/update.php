<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_GET['box']))
    {
        $i=intval($_GET['id']);
        if($_GET['box']=='update')
        {
            /****   fetch DB old information to view it befor update  *********/
            require '../connect.php';
            $sql_read="SELECT * FROM users WHERE id='$i';";
            $result_read=$conn->query($sql_read);
            $oldUserName="";
            if($result_read->num_rows>0)
            {
                $row_read=$result_read->fetch_assoc();
                $oldUserName=$row_read['UserName'];
                ?>
                <form action="" method="post" class="w-50 mx-auto my-3 ttext-center">
                <div class="namediv row m-2">
                    <label for="n" class="col-4 ">User Name:</label>
                    <input type="text" id="n" name="UserName" class="col-6" placeholder="<?php echo $row_read['UserName'];?>">
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
                        <option value="<?php echo $row_city['id'];?>"><?php echo $row_city['CityName'] ?></option>
                      <?php
                    }
                }
                ?>
                   </select>
                </div>
                <div class="btndiv d-flex justify-content-evenly m-3">
                    <button name="update_btn" class="rounded-pill px-3">confirm</button>
                    <a href="./index.php" class="text-decoration-none text-primary">show result</a>
                </div>
                </form>
                <?php
                    if(isset($_POST['update_btn']))
                    {
                         if(empty($_POST['UserName']))
                         {
                            $UserName=$oldUserName;
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
                         if(!empty($_POST['UserName']||!empty($_POST['city'])))
                         {
                            $sql_update="UPDATE users SET UserName='$UserName',city='$city' WHERE id='$i';";
                            if($conn->query($sql_update)===TRUE)
                            {
                                echo $oldUserName." "."is updated";
                            }
                            else
                            {
                                echo "faild";
                            }
                         }
                    }
            }
            
        }
        elseif($_GET['box']=='delete')
        {
            require '../connect.php';
            $sql_read="SELECT UserName FROM users WHERE id='$i';";
            $result_read=$conn->query($sql_read);
            $row_read=$result_read->fetch_assoc();
            $delUserName=$row_read['UserName'];
            ?>
            <form action="" method="post" class="w-50 mt-3 mx-auto">
                <p class="m-3">do you want to delete <?php echo $row_read['UserName'];?> !!!</p>
                <div class="btndiv d-flex justify-content-evenly align-items-center">
                    <button name="del_btn" class="m-3 px-3 rounded-pill">confirm</button>
                    <a href="./index.php" class="text-decoration-none text-primary">show result</a>
                </div>
            </form>
            <?php
            if(isset($_POST['del_btn']))
            {
                $sql_del_foreign="DELETE FROM task_user WHERE user_id='$i';";
                if($conn->query($sql_del_foreign)===TRUE)
                {
                    $sql_del="DELETE FROM users WHERE id='$i';";
                    if($conn->query($sql_del)==TRUE)
                    {
                        echo $delUserName." "."had been deleted";
                    }
                }
                
            }
        }
    }
    ?>
    <?php
        function validation($x)
        {
            $x=stripslashes($x);
            $x=trim($x);
            $x=htmlspecialchars($x);
            return $x;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" 
    integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" 
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>