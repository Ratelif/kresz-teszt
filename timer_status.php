<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!isset($_SESSION['username'])){
	
		header("location: ../index.php");
    }    

	require_once '../hs/dbh.inc.php';

    $query = "SELECT * FROM timer";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows < 1) return;
    $timer_status = $result->fetch_assoc();

    if ($timer_status['status'] == 1)
    {
       $allapot = "Aktív" ;
    }
    else if ($timer_status['status'] == 0)
    {
        $allapot = "Inaktív" ;
    }
   
?>

<div>
    <div class="container-login101">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form action="#" id="fupForm" method="POST" class="login100-form validate-form flex-sb flex-w">
                <span class="login100-form-title p-b-30">
                    Időzitő kikapcsolás: 
                </span>

                <div class="p-t-31 p-b-9">
                <span style="font-size:1.8rem;">Jelenlegi állapot:<?php echo " ".$allapot; ?></span>
                </div>
                <div class="container-login100-form-btn m-t-17">
                    <input type="submit" name="reg_button" class="login100-form-btn" id="kuld" value="Módosít">
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
            var status = "<?php echo $timer_status['status']?>" ;
            $.post("include/timer_actival.php",{allapot:status},function(data){

                alert(data);       
                $(".sajat").load('include/timer_status.php'); 
            })
            
        });
    });    
</script>    

<?php
    
	mysqli_close($conn);

?>

 


