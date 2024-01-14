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
     <!--******  this page to view the tasks so: 1- we have to fetch data from DB    ***********-->
     <!--******            2- we have to fill task form by DB information            ***********-->
     <!--***************************************************************************************-->
     <?php
     require '../connect.php';
     $sql_read="SELECT * FROM tasks;";
     $result_read=$conn->query($sql_read);
     if($result_read->num_rows > 0)
     {
        ?>
        <a href="../users/index.php" class="position-fixed top-0 start-0 m-4 border border-info rounded-circle p-2"><i class="fa-solid fa-user"></i></a>
        <a href="create.php" class="position-fixed top-0 end-0 m-4 border border-info rounded-circle p-2"><i class="fa-solid fa-plus"></i></a>
        <div class="container d-flex flex-wrap gap-1 my-2">
            <?php
                      while($row_read=$result_read->fetch_assoc())
                      {
                        $taskId=$row_read['id'];
                        $TaskName=$row_read['TaskName'];
                        $description=$row_read['discription'];
                        ?>
                        <div class="card d-flex flex-column gap-2 w-25 mx-auto mt-4 p-2 shadow-lg">
                            <h6 class="text-info text-decoration-underline d-block text-center" name="TaskName"><?php echo $TaskName;?></h6>
                            <div class="dis">
                                <label for="d" class="d-block">Description :</label>
                                <textarea name="description" id="d" cols="20" rows="5" class="w-100"><?php echo $description;?></textarea>
                            </div>
                            <div class="userdiv">
                                <?php 
                                /******   here we hqve to bring (users_ids)array witch include the ids of users    *********/
                                /******   after bringing the array we have to connect to DB agin to bring users names ******/
                                /******   but (task table)(user table) aren't connected together so we use (user_task table) **/
                                require '../connect.php';
                                $sql_read_tu="SELECT UserName FROM users INNER JOIN task_user ON
                                task_id='$taskId' AND users.id=task_user.user_id ;";
                                if($conn->query($sql_read_tu)==true)
                                {
                                    $result_read_tu=$conn->query($sql_read_tu);
                                    if($result_read_tu->num_rows > 0)
                                    {
                                        while($row_read_tu=$result_read_tu->fetch_assoc())
                                        {
                                            echo $row_read_tu['UserName']."<br>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="btndiv d-flex justify-content-evenly">
                                <a href="./update.php?box=update&id=<?php echo $row_read['id'];?>" 
                                class="text-decoration-none text-light border-0 px-2 bg-success"><i class="fa-solid fa-pen"></i></a>
                                <a href="./update.php?box=delete&id=<?php echo $row_read['id'];?>" 
                                class="text-decoration-none text-light border-0 px-2 bg-danger"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                        <?php
                      }
            ?>
        </div>
        <?php
     }
     else
     {
        ?>
        <div class="emptydiv w-50 mx-auto mt-3 d-flex flex-column gap-3 justify-content-evenly align-items-center border">
            <h5 class="text-center m-2">there is no tasks yet</h5>
            <a href="./create.php" class="bg-info text-light text-decoration-none m-2 py-1 px-2 rounded">Add Task</a>
        </div>
        <?php
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