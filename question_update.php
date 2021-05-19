<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!isset($_SESSION['username'])){
	
		header("location: ../index.php");
    }

	require_once '../hs/dbh.inc.php';

    if (isset($_POST['adatbazis_neve'])){
        $valasztott_adatbazis = test_input($_POST['adatbazis_neve']);
        $_SESSION['valasztott_adatbazis'] = test_input($_POST['adatbazis_neve']);    
    } 

    if (!isset($_POST['adatbazis_neve'])) {
        $valasztott_adatbazis = test_input($_SESSION['valasztott_adatbazis']);
    }
    
?>

<script> 
    
	$(document).ready(function(){
        
        var $adatbazis_neve = "<?php echo $_SESSION['valasztott_adatbazis']; ?>"     
        
        $(".question_modify").click(function(){
            var kerdes_id = ($(this).val()); 
            var uzenet = "Sikeres frissítés!";
            $("#update_button").show();
            $('.alert-success').remove();
            $.ajax({
                url: 'include/getSelectMember.php',
                type: 'post',
                data: {
                    quest_id: kerdes_id,
                    database_name: $adatbazis_neve
                },
                dataType: 'json',
                success: function(response) {
                    $('#edit_id').val(response.kerdes_id);
                    $('#edit_kerdes').val(response.kerdes);
                    $('#edit_valasz1').val(response.valasz1);
                    $('#edit_valasz2').val(response.valasz2);
                    $('#edit_valasz3').val(response.valasz3);
                    $('#helyes_valasz').val(response.helyes);
                    $('#database_name').val($adatbazis_neve);
                        
                    $('#updateMemberForm').off('submit').on('submit', function(e) {
                        e.preventDefault();
                        var form = $(this);
                        var edit_id = $('#edit_id').val();
                        var edit_kerdes = $('#edit_kerdes').val();
                        var edit_valasz1 = $('#edit_valasz1').val();
                        var edit_valasz2 = $('#edit_valasz2').val();
                        var edit_valasz3 = $('#edit_valasz3').val();
                        var helyes_valasz = $('#helyes_valasz').val();
                        var database_name = $adatbazis_neve;

                        if (edit_kerdes && edit_valasz1 && edit_valasz2 && edit_valasz3 && helyes_valasz) 
                        {
                                
                            $.post("include/update.php",{edit_id:edit_id,edit_kerdes:edit_kerdes,edit_valasz1:edit_valasz1,edit_valasz2:edit_valasz2,edit_valasz3:edit_valasz3, helyes_valasz:helyes_valasz, database_name:database_name},function(data){
                                $('.messages').html('<div class="alert alert-success" role="alert"><strong>' + uzenet + '</strong> Bezár gombbal folytathatja a szerkesztést.<button type="button" class="close" data-dismiss="alert" aria-label="Close">  <span aria - hidden = "true" > & times; < /span></button > </div>');
                                $("#update_button").hide();
                                
                                $(".sajat").load('include/question_update.php');  
                            })  
                        } 
                             
                    });   
                     
                }  
                  
            });   
 		});    
 
	}); 

</script>

<h3 id="tabla_neve">Kiválasztott adatbázis: <?php echo $_SESSION['valasztott_adatbazis']; ?></h3>	
<br>
<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Kérdés id</th>
				<th>Kérdés</th>
				<th>Válasz1</th>
				<th>Válasz2</th>
				<th>Válasz3</th>
				<th>Szerkeszt</th>
			</tr>
		</thead>
	<tbody>

<?php
    
$query = "SELECT * FROM $valasztott_adatbazis";
$stmt = $conn->prepare($query);
$stmt->execute();
$select = $stmt->get_result();
if ($select->num_rows < 1) return;

$x=0;

while ($row = $select->fetch_assoc()) {  
    $x++;
   
?>
	<tr>
        <td><?= $x; ?></td>                            
        <td><?= $row['kerdes'] ?></td>					  	
        <td><?php echo $row['valasz1'] ?></td>         
        <td><?php echo $row['valasz2'] ?></td>                
        <td><?php echo $row['valasz3'] ?></td>                 
        <td>&nbsp; &nbsp; <button name="subject" class="question_modify" type="button" data-toggle="modal" data-target="#editMemberModal" value="<?php echo $row['kerdes_id']; ?>"> Módosít </button></td>	
	</tr>
	
<?php 
}; 
      
    $stmt->close();
    $conn -> close();
?>
 </tbody>
</table>

