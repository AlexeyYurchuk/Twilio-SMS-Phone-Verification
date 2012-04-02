<?php

// configuration 
/*** mysql hostname ***/
$hostname = 'localhost';

// database name
$dbname = '';

/*** mysql username ***/
$username = 'username';

/*** mysql password ***/
$password = 'password';

// enter SID here
$twilioSid = '';

// enter twilio token here
$twilioToken = '';


if(isset($_POST['phone_no']))
{
    try 
    {
        $verifyCode = rand(1000, 9999);
        
        $phone = $_POST['phone_no'];
        
        $dbh = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        
        /*** add verification code and phone number to db **/
        $sth = "INSERT INTO user (phone, code) VALUES(:phone, :code)";
        $command = $dbh->prepare($sth);
        $command->bindParam(':phone', $phone, PDO::PARAM_STR);
        $command->bindParam(':code', $verifyCode, PDO::PARAM_INT);
        $command->execute();
        
        // twilio library
        require ('Services/Twilio.php');
        
        $client = new Services_Twilio($twilioSid, $twilioToken);
        
        // send sms with verifcation code 
        $response = $client->account->sms_messages->create('555-555-555', $phone, 'Verification code ' . $verifyCode);
        
        echo '<p>A verification code was sent to your phone number. Please enter it below.</p>';
        
        /*** close the database connection ***/
        $dbh = null;
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
?>