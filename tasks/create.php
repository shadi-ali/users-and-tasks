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
    /************        1- form: to insert data        ************/
    /************   2- insert data into (task table)     ***********/
    /************ 3- insert data into (task_user table)   *********/
    ?>
    <form action="" method="post" class="w-50 mx-auto mt-4 p-2 pt-4 border rounded d-flex flex-column gap-3 shadow-lg">
        <div class="namediv row ">
            <label for="n" class="col-4">create task name :</label>
            <input type="text" name="TaskName" id="n" class="col-7">
        </div>
        <div class="desdiv d-flex flex-column">
            <label for="d">create a description :</label>
            <textarea name="description" id="d"></textarea>
        </div>
        <div class="usersdiv d-flex flex-column">
            <label for="u"></label>
            <select name="users_ids[]" id="u" multiple>
                <?php
                /*******     we pring users name to chose from them        ********/
                require '../connect.php';
                $sql_read="SELECT * FROM users ;";
                $result_read=$conn->query($sql_read);
                if($result_read->num_rows > 0)
                {
                     while($row_read=$result_read->fetch_assoc())
                     {
                        ?>
                        <option value="<?php echo $row_read['id'];?>"><?php echo $row_read['UserName'];?></option>
                        <?php
                     }
                }
                else
                {
                    ?>
                    <div class="no_users w-50 mx-auto mt-3 d-flex flex-column gap-3 justify-content-evenly align-items-center border">
                        <h5 class="text-center m-2">there is no users to select , click the button to create some</h5>
                        <a href="./create.php" class="bg-info text-light text-decoration-none m-2 py-1 px-2 rounded">go</a>
                    </div>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="btndiv d-flex justify-content-between px-3">
        <button name="insert" class="bg-info text-light rounded border-0 w-25">insert</button>
        <a href="./index.php" class="text-decoration-none text-info">show result</a>
        </div>
    </form>
    <?php
    /***********************************************************************/
    function validation($x)
    {
    $x=stripslashes($x);
    $x=trim($x);
    $x=htmlspecialchars($x);
    return $x;
    }
    /***********************************************************************/
    $TaskName="";
    $description="";
    $users_ids=[];
    if(isset($_POST['insert']))
    {
        if(empty($_POST['TaskName']))
        {
            echo "please enter task name";
        }        
        else
        {
             $TaskName= $conn->real_escape_string(validation($_POST['TaskName']));
        }
        if(empty($_POST['description']))
        {
            echo "please enter a description";
        }
        else
        {
            $description= $conn->real_escape_string(validation($_POST['description']));
        }if(empty($_POST['users_ids']))
        {
            echo "please chose one user at lest";
        }
        else
        {
             $users_ids=($_POST['users_ids']);
             /*****this array contain just the (id's) of users *************/
        }
        if(!empty($_POST['TaskName']) &&!empty($_POST['description']) && !empty($_POST['users_ids']))
        {
            $sql_creat_task="INSERT INTO tasks VALUES (null,'$TaskName','$description');";
            if($conn->query($sql_creat_task)==TRUE)
            {
               echo $TaskName." "."is added"."<br>";
            }    
            else
            {
               echo "something gone wrong";
            }
            /*****       we insert every item in the array into (task_user table)    ********/
            /*******         that means we have to insert task_id , user_id         *********/
            /*************       we have the user_id from (users_ids array)       ***********/
            /***  but the task that we created soon we don't know what it's id (AUTO_INCREMENT) ***/
            /*******    so we have to bring task_id from task table after saving task   *****/
            /********************************************************************************/
            /********************        1- bring task_id :    ******************************/
            /********************************************************************************/
           
        }
        $sql_read=" SELECT id FROM tasks WHERE TaskName ='$TaskName' AND discription ='$description';";
        if($conn->query($sql_read)==TRUE)
        {
            $result_read=$conn->query($sql_read);
            $row_read=$result_read->fetch_assoc();
            $i=$row_read['id'];
            foreach($users_ids as $e)
            {
             $sql_creat_tu="INSERT INTO task_user VALUES(null,'$e','$i');";
             if($conn->query($sql_creat_tu))
             {
                /********** ********             فزلكة                 **********************/
                $sql_read_user="SELECT UserName FROM users WHERE id='$e';";
                $result_read_user=$conn->query($sql_read_user);
                $row_read_user=$result_read_user->fetch_assoc();
                $user=$row_read_user['UserName'];
                echo "the task is assigned to"." ".$user."<br>";
             }   
            }
        }
        else
        {
            echo "Error:". $conn->error;
        }

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