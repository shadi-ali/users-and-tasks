<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*******************************************************/
    $servername="localhost";
    $username="root";
    $password="";
    /*******************************************************/
/*     $conn=new mysqli($servername,$username,$password);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    } */
    /******************************************************/
/*     $sql="CREATE DATABASE task_delevery";
    if($conn->query($sql))
    {
        echo "task_delevery DB is created successfully";
    }
    else
    {
        echo "faild".$conn->error;
    } */
    /*******************************************************/
    $dbname="task_delevery";
    $conn= new mysqli($servername,$username,$password,$dbname);
    /*********************************************************/
    /****                    users                       *****/
    /*********************************************************/
/*     $sql="CREATE TABLE users(id INT(6) PRIMARY KEY AUTO_INCREMENT,
                             UserName VARCHAR(30) NOT NULL,
                             city VARCHAR(10));";
    if($conn->query($sql)===true)
    {
        echo "users is created successfully";
    }
    else
    {
        echo "error".$conn->error;
    } */
    /**********************************************************/
    /****                       tasks                     *****/
    /**********************************************************/
    /* $sql="CREATE TABLE tasks(id INT(6) PRIMARY KEY AUTO_INCREMENT,
                             TaskName VARCHAR(30) NOT NULL,
                             discription TEXT NOT NULL );";
    if($conn->query($sql)===TRUE)
    {
        echo "tasks created succesfully";
    }
    else
    {
        echo "faild".$conn->error;
    } */
    /************************************************************/
    /*****                 task_user                        *****/
    /************************************************************/
    /* $sql="CREATE TABLE task_user(id INT(6) PRIMARY KEY AUTO_INCREMENT,
                                 user_id INT(6),
                                 task_id INT(6),
                                 FOREIGN KEY (user_id) REFERENCES users(id),
                                 FOREIGN KEY (task_id) REFERENCES tasks(id));";
    if($conn->query($sql)===TRUE)
    {
        echo "task_user created successfully";
    }
    else
    {
        echo "faild".$conn->error;
    } */
    /***************************************************************/
    /*****                   cityفزلكة                              *****/
    /***************************************************************/
    /* $sql="CREATE TABLE city(id INT(3) PRIMARY KEY AUTO_INCREMENT,
                            CityName VARCHAR(10) NOT NULL);";
    if($conn->query($sql)===TRUE)
    {
        echo "city is created successfully"; 
    }
    else
    {
        echo $conn->error;
    } */
    /***************************************************************/
    /*****                  drop/delete                        *****/
    /***************************************************************/
/*      $sql="DROP TABLE users;";
    if($conn->query($sql)===TRUE)
    {
        echo "deleting is done";
    }
    else
    {
        echo $conn->error;
    }  */
    ?>
</body>
</html>