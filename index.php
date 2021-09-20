<?php

$host="localhost";
$user ="root";
$password ="";
$dbName="training_company";
$conn=mysqli_connect($host,$user,$password,$dbName);

// insert data

if( isset($_POST['send'])){

    $course=$_POST['course'];
    $cost=$_POST['cost'];
    $insert="INSERT into `courses` values(null,'$course', $cost)";
    $i=mysqli_query($conn,$insert);
  
}

// --------------------

// read data
$select="SELECT * from `courses` ";
$s=mysqli_query($conn,$select);

// --------------


// delete data
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $delete="DELETE from `courses` where id=$id ";
    $d=mysqli_query($conn,$delete);
}

// -------------

// update data 
$name='';
$cost='';
$update=false;
if(isset($_GET['edit'])){
    $update=true;
    $id=$_GET['edit'];
    $select ="SELECT * from `courses` WHERE  id=$id  ";
    $ss=mysqli_query($conn,$select);
    $row= mysqli_fetch_assoc($ss);
    $name=$row['name'];
    $cost=$row['cost'];
    if( isset($_POST['update'])){
        $course=$_POST['course'];
        $cost=$_POST['cost'];
        $update="UPDATE `courses` set name= '$course' ,  cost = $cost WHERE id =$id ";
        $u=mysqli_query($conn,$update);
      
    }


}


?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    

<div class="container col-6">
    <div class="card">
        <div class="card-body">
            <h1 class="text-center text-info">crud operation</h1>
    <form method="POST">

    <div class="form-group">
        <label>Course Name</label>
            <input name="course" type="text" placeholder="course name" value="<?php echo $name ?>"
             class="form-control" >
        <label> Course Cost</label>
            <input name="cost" type="text" placeholder="course cost"  value="<?php echo $cost ?>"
            class="form-control" >
        <div class ="mx-auto w-25">
            <?php if($update) : ?>
                <button name="update" class="btn btn-primary mx-auto my-3 w " >update data</button>
            <?php else : ?>
                <button name="send" class="btn btn-info mx-auto my-3 w " >send data</button>
            <?php endif; ?>
        </div>
    </div>
    </form>
    
        </div>
    </div>
</div>

<div class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
    <table class="table table-dark">
        <tr>
            <th>ID</th>
            <th>COURSE</th>
            <th>COST</th>
            <th>action</th>
        </tr>
        <?php foreach($s as $data){ ?>
            <tr>
                <th> <?php echo $data['id'] ?> </th>
                <th> <?php echo $data['name'] ?> </th>
                <th> <?php echo $data['cost'] ?> </th>
                <th> <a href= " index.php?delete=<?php echo $data['id'] ?>" class="btn btn-danger mx-3"> DELETE</a> 
                <a href= " index.php?edit=<?php echo $data['id'] ?>" class="btn btn-info"> EDIT</a> 
            </th>
            </tr>
            <?php } ?>

    </table>

        </div>
    </div>
</div>





</body>
</html>