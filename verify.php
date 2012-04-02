<?php

if(isset($_POST['code']))
{
    $verifyCode = $_POST['code'];
    
    /*** mysql hostname ***/
    $hostname = 'localhost';
    
    /*** database name ***/
    $dbname = '';
    /*** mysql username ***/
    $username = 'username';
    /*** mysql password ***/
    $password = 'password';
    
    try {
        
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        
        // USER_ID is the login ID of the user
        $sql = "SELECT code FROM user WHERE id = {$user_id}";
        $sth = $dbh->query($sql);
        
        $code = $sth->fetchColumn();
        
        if($code == $verifyCode)
        {
            echo "Your account has been validated.";
            
            // verify user in db
            $todo = "UPDATE user SET status = 1 WHERE user_id = {$user_id}";
            $dbh->execute($todo);
       
        }
        else
        {
            echo "Your account has not been validated.";
        }
        
        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
?>