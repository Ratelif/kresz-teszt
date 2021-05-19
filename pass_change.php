<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!isset($_SESSION['username'])){
	
		header("location: ../index.php");
    }    

	require_once '../hs/dbh.inc.php';

?>

<div>
    <div class="container-login101">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form action="#" id="fupForm" method="POST" class="login100-form validate-form flex-sb flex-w">
                <span class="login100-form-title p-b-30">
                    Jelszó módosítás: 
                </span>

                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Új jelszó megadása
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" id="password" name="pass" >
                    <span class="focus-input100"></span>
                </div>
                
                <div class="container-login100-form-btn m-t-17">
                    <input type="submit" name="reg_button" class="login100-form-btn" id="kuld" value="Elküldés">
                </div>
                <p class="statusMsg"></p>    
            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>

<script>
    $(document).ready(function(){
        $("#fupForm").submit(function(event){
            
            event.preventDefault(); 
            var that = this;
            var pass = $('#password').val();  
           
            if (($.trim(password) != '') ){
                
                $.ajax({
                    type: 'POST', 
                    url:"include/pass.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                    $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                    $('.statusMsg').html('');
                    if(msg == 'ok'){
                        $('#fupForm')[0].reset();
                        $('.statusMsg').html('<p style="font-size:18px;color:#EA4335">Az adatok sikeresen tárolódtak!</p>');
                    }else{
                        $('.statusMsg').html('<p style="font-size:18px;color:#EA4335">Hiba történt próbálja újra!</p>');
                    }
                    $('#fupForm').css("opacity","");
                    }
                })   
               that.reset();     
            }
            else 
            {
                alert("A mező kitöltése kötelező!");                               
            }
            
        });
    });    
</script>    


<?php
    
	mysqli_close($conn);

?>

 


