<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $("#phone").submit(function() 
      {
          var phone_no = $('#phone_no').val();
          
          if(phone_no != '')
          {
              
              $.post("sendcode.php", { phone_no: phone_no },
          		    function(data) 
          		    {
          	           $("#result").html(data);
            	    }, 
            	    "html"
              );
      		 
          }
          
          return false;
      });
   });
</script>

<div class = "result"></div>
<p>Enter your phone number below, and we will send you a verification code to that phone number.</p>
<form id = "phone" method  = "POST" action = "form.php">
<label for = "phone">Phone number</label>
<input name = "phone" type = "text" id = "phone_no" />
<input name = "submit" type = "submit" value = "Send Verification Code" />
</form>

<p>Enter Verification Code received to the phone number specified above in the form below.</p>

<form id = "verification" method  = "POST" action = "verify.php">
<label for = "code">Verification Code</label>
<input name = "code" type = "text" id = "code" />
<input name = "submit" type = "submit" value = "Verify" />
</form>