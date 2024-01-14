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
     <!--******  this page to view the users so: 1- we have to fetch data from DB    ***********-->
     <!--******            2- we have to fill user form by DB information            ***********-->
     <!--***************************************************************************************-->
     <?php
     require '../connect.php';
     $sql="SELECT * FROM users;";
     $result= $conn->query($sql);
     if($result->num_rows>0)
     {
        ?>
        <a href="../tasks/index.php" class="position-fixed top-0 start-0 m-4 border border-info rounded-circle p-2"><i class="fa-solid fa-list-check"></i></a>
        <a href="create.php" class="position-fixed top-0 end-0 m-4 border border-info rounded-circle p-2"><i class="fa-solid fa-plus"></i></a>
        <table class="text-center w-50 mx-auto mt-3">
            <tr class="row text-info">
                <th class="col border p-1">Name</th>
                <th class="col border p-1">City</th>
                <th class="col border p-1">update</th>
                <th class="col border p-1">delete</th>
            </tr>
            <?php
            while($row=$result->fetch_assoc())
            {
                ?>
                <tr class="row p-1">
                    <th class="col border p-1"><?php echo $row['UserName'];?></th>
                    <th class="col border p-1"><?php echo $row['city']; ?></th>
                    <th class="col border p-1"><a class="text-decoration-none text-succes" href="./update.php?box=update&id=<?php echo $row['id']; ?>"><i class="fa-solid fa-pen"></i></a></th>
                    <th class="col border p-1"><a class="text-decoration-none text-danger" href="./update.php?box=delete&id=<?php echo $row['id']; ?>"><i class="fa-solid fa-trash"></i></a></th>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
     }
     else
     {
        ?>
        <div class="empty w-75 mx-auto mt-5 border text-center">
            <h5 class="text-danger">ther isn't any user here</h5>
            <a href="./create.php" class="text-info text-decoration-none">add user</a>
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