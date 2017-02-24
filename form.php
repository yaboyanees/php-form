<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PhpFiddle Initial Code</title>
</head>

<body>
<div style="margin: 30px 10%;">
    <form action='' method='post'>
        <p><label>Name</label><br><input type='text' name='name' value=''></p> 
        <p><label>Email</label><br><input type='text' name='email' value=''></p> 
        <p><input type='submit' name='submit' value='Submit'></p> 
    </form>
</div>
</body>
</html>

<?php
if(isset($_POST['submit'])){

    //collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];

    //check name is set
    if($name ==''){
        $error[] = 'Name is required';
    }

    //check for a valid email address
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         $error[] = 'Please enter a valid email address';
    }

    //if no errors carry on
    if(!isset($error)){

        # columns of the CSV
        $Content = "Name, Email\n";

        //set the data of the CSV
        $Content .= "$name, $email\n";

        # set the file name and create CSV file
        $FileName = "myData-".date("d-m-y-h").".csv";
        header('Content-Type: application/csv'); 
        header('Content-Disposition: attachment; filename="' . $FileName . '"'); 
        echo $Content;
        exit();
    }
}

//display errors
if(isset($error)){
    foreach($error as $error){
        echo "<p style='color:#ff0000'>$error</p>";
    }
}
?>