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
    var $adatbazis_neve = "<?php echo test_input($_SESSION['valasztott_adatbazis']); ?>" 
     
    $(document).ready(function(){
		     
        $(".question_actival").click(function(){
            var php_val= ($(this).val()); // értéke az id, mivel a value=echo $row['kerdes_id']
          
            $.post("include/update_kerdes_status.php",{php_val:php_val, adatbazis_neve:$adatbazis_neve},function(data){
                alert(data);       //popup ablak a update_kerdes_status.php válaszával sikeres, nem sikeres
                $(".sajat").load('include/question_actival.php'); 
            })
            
		});

	});
</script>

<h3 id="tabla_neve">Kiválasztott adatbázis: <?php echo test_input($_SESSION['valasztott_adatbazis']); ?></h3>	
<br>
<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Kérdés id</th>
				<th>Kérdés</th>
				<th>Válasz1</th>
				<th>Válasz2</th>
				<th>Válasz3</th>
				<th>Aktiválás</th>
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
    if ($row['status'] == 0){
        $status= "Inaktív";
    }
    elseif ($row['status'] == 1){
        $status= "Aktív";
    }
?>
	<tr>
        <td><?= $x; ?></td>                            
        <td><?= test_input($row['kerdes']) ?></td>					  	
        <td><?php echo test_input($row['valasz1']) ?></td>         
        <td><?php echo test_input($row['valasz2']) ?></td>                
        <td><?php echo test_input($row['valasz3']) ?></td>                 
        <td><?php echo test_input($status) ?> &nbsp; &nbsp; <button name="subject" class="question_actival" type="button" value="<?php echo test_input($row['kerdes_id']); ?>"> Módosít </button></td>	
	</tr>
	
<?php 
}; 
      
$stmt->close();
$conn -> close();
?>
 </tbody>
</table>
