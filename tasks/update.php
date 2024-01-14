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
    /***************        1-bring old data to fill place holder in the form     *********/
    /***************               2-set the form(post) to insert new data         ********/
    /***************                 3- code php to insert data into DB            ********/
    if(isset($_GET['box']))
    {
        $i=intval($_GET['id']);
        if($_GET['box']=='update')
        {
            require '../connect.php';
            $sql_read="SELECT * FROM tasks WHERE id='$i';";
            if($conn->query($sql_read)==TRUE)
            {
                 $result_read=$conn->query($sql_read);
                $row_read=$result_read->fetch_assoc();
                $old_TaskName=$row_read['TaskName'];
                $old_description=$row_read['discription']; 
                $old_array=[];
            }
            else
            {
                echo"jjjjjjj";
            }
        ?>
        <form action="" method="post" class="w-50 mx-auto my-3 d-flex flex-column gap-3">
            <div class="namediv w-100 row">
                <label for="n" class="col-4">enter new name:</label>
                <input type="text" id="n" class="col-6" name="TaskName" placeholder="<?php echo $old_TaskName;?>">
            </div>
            <div class="desdiv w-100">
                <label for="d" class="d-block">enter new description :</label>
                <textarea name="description" id="d" cols="20" rows="5" class="w-100">
                    <?php echo $old_description?>
                </textarea>
            </div>
            <div class="usersdiv w-100 row m-2">
                <div class="olddiv col-4 d-inline">
                    <p class="text-danger text-decoration-underline w-75">the old list :</p>
                    <?php
                    $sql_read_tu="SELECT UserName FROM users INNER JOIN task_user ON
                    task_id='$i' AND users.id=task_user.user_id;";
                    if($conn->query($sql_read_tu)==TRUE)
                    {
                        $result_read_tu=$conn->query($sql_read_tu);
                        while($row_read_tu=$result_read_tu->fetch_assoc())
                        {
                            $assignuser=$row_read_tu['UserName'];
                            array_push($old_array,$assignuser);
                            echo $assignuser."<br>";
                        }
                    }
?>
                </div>
                <div class="newdiv col-7 d-inline text-center">
                <p class="text-success text-decoration-underline w-75">select new list :</p>
                    <select name="users_ids[]" class="w-75 text-center" multiple>
                        <?php
                        $sql_read_user="SELECT * FROM users";
                        if($conn->query($sql_read_user)==TRUE)
                        {
                            $result_read_user=$conn->query($sql_read_user);
                            while($row_read_user=$result_read_user->fetch_assoc())
                            {
                                ?>
                                <option value="<?php echo $row_read_user['id'];?>"><?php echo $row_read_user['UserName'];?></option>
                                <?php
                            }
                        }                  
                        ?>
                    </select>
                </div>
            </div>
            <div class="btndiv w-100 d-flex justify-content-evenly align-items-center m-2 border">
                    <button name="update_btn" class="px-2 text-light bg-info border-0 rounded">update</button>
                    <a href="./index.php" class="text-decoration-none text-info">show result</a>
            </div>
        </form>
        <?php
        function validation($x)
        {
        $x=stripslashes($x);
        $x=trim($x);
        $x=htmlspecialchars($x);
        return $x;
        }
        $TaskName=$description="";
        $users_ids=[];
        if(isset($_POST['update_btn']))
        {
             if(empty($_POST['TaskName']))
             {
                  $TaskName=$old_TaskName;
             }
             else
             {
                $TaskName=validation($_POST['TaskName']);
             }
             if(empty($_POST['description']))
             {
                $description=$old_description;
             }
             else
             {
                $description=validation($_POST['description']);
             }
             if(empty($_POST['users_ids']))
             {
                $users_ids=$old_array;
             }
             else
             {
                $users_ids=($_POST['users_ids']);
             }
             /*******    my condition dosn't make the change is Mandatory for all elements   *****/
             if(!empty($_POST['TaskName'])||!empty($_POST['description']))
             {
                /***********         now we update (task table)           ***********/
                $sql_update_task="UPDATE tasks SET TaskName='$TaskName', discription='$description' WHERE id='$i';";
                if($conn->query($sql_update_task)===true)
                {
                /***********      now we delete old users array and insert the new agin   **********/
                    if(!empty($_POST['users_ids']))
                    {
                        $sql_del_oldlist="DELETE FROM task_user WHERE task_id='$i';";
                        if($conn->query($sql_del_oldlist)===true)
                        {
                        foreach($users_ids as $e)
                            {
                                $sql_creat_tu="INSERT INTO task_user VALUES(null,'$e','$i')";
                                if($conn->query($sql_creat_tu)==TRUE)
                                {
                                    $sql_read="SELECT UserName FROM users WHERE id='$e';";
                                    $result_read=$conn->query($sql_read);
                                    $row_read=$result_read->fetch_assoc();
                                    $new_user=$row_read['UserName'];
                                    echo $TaskName."is assigned to"." ".$new_user."<br>";
                                }
                            }
                        }
                    }
                    echo "finally the"." ".$TaskName." "."is updated";
                }
             }
        }
        }
        elseif($_GET['box']=='delete')
        {
            /*****    we have to delete (task table) && (task_user table)   ******/
            require "../connect.php";
            $sql_read="SELECT TaskName FROM tasks WHERE id='$i';";
            $result_read=$conn->query($sql_read);
            $row_read=$result_read->fetch_assoc();
            $del_task=$row_read['TaskName'];
            ?>
            <form class="deldiv w-50 border mx-auto mt-5 p-3" method="post">
                <p>do you want to delete this task !!!??? if you , press delete</p>
                <div class="btndiv d-flex justify-content-evenly align-items-center">
                    <button class="text-light bg-info border-0 px-2" name="del_btn">Delete</button>
                    <a href="./index.php" class="text-decoration-none text-info">show results</a>
                </div>
        </form>
            <?php
            if(isset($_POST['del_btn']))
            {
                $sql_del_tu="DELETE FROM task_user WHERE task_id='$i';";
                if($conn->query($sql_del_tu)===true)
                {
                $sql_del="DELETE FROM tasks WHERE id='$i';";
                if($conn->query($sql_del)==TRUE)
                    {echo $del_task." "."is deleted";}
                }
            }
            
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