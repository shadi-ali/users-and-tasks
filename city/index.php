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
    <!--***************        the table           ****************-->
    <div class="container">
        
    </div>
    <table class="w-50 text-center mx-auto mt-4">
        <?php
        require '../connect.php';
        $sql="SELECT * FROM city;";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            ?>
            <tr class="row">
               <th class="col-4 border text-primary">num</th>
               <th class="col-8 border text-primary">name</th>
            </tr>
            <?php
            $result=$conn->query($sql);
            while($row=$result->fetch_assoc())
            {
                ?>
                <tr class="row">
                    <th class="col-4 border"><?php echo $row['id'];?></th>
                    <th class="col-8 border"><?php echo $row['CityName'];?></th>
                </tr>
                <?php
            }
            ?>
            <div class="add d-flex justify-content-center p-4">
            <a href="./create.php" class="text-decoration-none text-info">add city</a>
            </div>
            <?php
        }
        else
        {
             ?>
             <p><a href="./create.php" class="text-center d-block w-25 text-decoration-none mt-5 mx-auto border">add city</a></p>
             <?php
        }
        ?>
    </table>
     <!--**********************************************************-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" 
    crossorigin="anonymous"></script>
</body>
</html>