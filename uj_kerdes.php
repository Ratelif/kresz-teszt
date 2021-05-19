<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!isset($_SESSION['username'])){
	
		header("location: index.php");
    }    

	require_once '../hs/dbh.inc.php';

    if (isset($_POST['adatbazis_neve'])){
        $_SESSION['valasztott_adatbazis'] = test_input($_POST['adatbazis_neve']);    
    }
?>

<div>
	<div class="container-login100">
		<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
			<form enctype="multipart/form-data" action="uj_kerdes_feldolgoz.php" id="fupForm" method="POST" class="login100-form validate-form flex-sb flex-w">
				<span class="login100-form-title p-b-30">
					Kiválasztott adatbázis: <?php echo $_SESSION['valasztott_adatbazis']; ?>
				</span>

				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Kérdés
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" id="kerdes_id" name="kerdes" required>
					<span class="focus-input100"></span>
				</div>
				
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Válasz 1
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" id="valasz1_id" name="valasz_1" required>
					<span class="focus-input100"></span>
				</div>
				
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Válasz 2
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" id="valasz2_id" name="valasz_2" required>
					<span class="focus-input100"></span>
				</div>
				
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Válasz 3
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="text" id="valasz3_id" name="valasz_3" required>
					<span class="focus-input100"></span>
				</div>
				
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Helyes Válasz(1,2,3)
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="number" name="jo_valasz" id="jovalasz_id" required>
					<span class="focus-input100"></span>
				</div>
				
				<div class="p-t-31 p-b-9">
					<span class="txt1">
						Kép feltöltése
					</span>
				</div>
				<div class="wrap-input100 validate-input" data-validate = "Username is required">
					<input class="input100" type="file" name="file_feltolt" id="file_id" accept=".jpg, .jpeg, .png">
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
		var $adatbazis_neve = "<?php echo $_SESSION['valasztott_adatbazis']; ?>" 
        $("#fupForm").submit(function(event){
            event.preventDefault(); 
            var that = this;
            var kerdes = $('#kerdes_id').val();  
            var valasz1 = $('#valasz1_id').val();  
            var valasz2 = $('#valasz2_id').val();  
            var valasz3 = $('#valasz3_id').val();  
            var jo_valasz = $('#jovalasz_id').val();  
           
            if (($.trim(kerdes) != '') && ($.trim(valasz1) != '') && ($.trim(valasz2) != '') && ($.trim(valasz3) != '') && ($.trim(jo_valasz) != '')) {
                
                $.ajax({
                    type: 'POST', 
                    url:"include/uj_kerdes_feldolgoz.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
					// $('.submitBtn').attr("disabled","disabled");
                    $('#fupForm').css("opacity",".5");
                    },
                    success: function(msg){
                    $('.statusMsg').html('');
                    if(msg == 'ok'){
                        $('#fupForm')[0].reset();
                        $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Az adatok sikeresen tárolódtak!</span>');
                    }else{
                        $('.statusMsg').html('<span style="font-size:18px;color:#EA4335">Hiba történt próbálja újra!</span>');
                    }
                    $('#fupForm').css("opacity","");
					//  $(".submitBtn").removeAttr("disabled");
                    }
                })   
				//  that.reset();     
            }
            else 
            {
                alert("Minden mező kitöltése kötelező!");                               
            }
            
        });
    });    
</script>    

<?php
    $conn -> close();
?>

 


