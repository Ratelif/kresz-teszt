<?php
    if(!isset($_SESSION)) {
        session_start(); 
    }
    
    if (!isset($_SESSION['username'])){
	
		header("location: index.php");
    }

    $_SESSION['valasztott_adatbazis'] ="";
?>

<!--<!doctype html>-->
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test-Page v1.1</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles_admin.css" rel="stylesheet">
    
    <script>
	$(document).ready(function(){
        
        //  kérdések aktiválása  // 
		$(".inaktiv a").click(function(){
			var kerdes_csoport = $(this).attr('rel');
			$.post("include/question_actival.php",{adatbazis_neve:kerdes_csoport},function(data){
				$(".sajat").html(data);  
			});
            //	event.preventDefault();
		});
        
        //  kérdések módosít //
		$(".modosit a").click(function(){
			var kerdes_csoport = $(this).attr('rel');
			$.post("include/question_update.php",{adatbazis_neve:kerdes_csoport},function(data){
				$(".sajat").html(data);  
			});
		});
        
        // új kérdések felvitele //
        $(".new_question a").click(function(){
            var kerdes_csoport = $(this).attr('rel');
            $.post("include/uj_kerdes.php",{adatbazis_neve:kerdes_csoport},function(data){
				$(".sajat").html(data);
			});
			event.preventDefault();
		});
        
         //  jelszó módosítása //
        $(".pass_change").click(function(){
            var kerdes_csoport = $(this).attr('rel');
            
            if (kerdes_csoport == 'password_change')
            {
                $.post("include/pass_change.php",{adatbazis_neve:kerdes_csoport},function(data){
				    $(".sajat").html(data);
                });
                event.preventDefault();        
            }
            else if (kerdes_csoport == 'timer_status')
            {
                $.post("include/timer_status.php",{adatbazis_neve:kerdes_csoport},function(data){
				    $(".sajat").html(data);
                });
                event.preventDefault();        
            } 
		});
	});
</script>
    
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <div class="menu-icons">
                    <i class="icon ion-md-menu"></i>
                    <i class="icon ion-md-close"></i>
                </div> 
                <a href="" class="logo1">
                    <i class="icon ion-md-bus"></i> 
                </a> 
                <ul class="nav-list">
            <!--  kérdés aktivál -->
                    <li>
                        <a href="#">Kérdések aktiválása 
                            <i class="icon ion-md-arrow-dropdown"></i>
                        </a>
                        <ul class="sub-menu inaktiv">
                            <li>
                                <a href="#" rel="autobusz_biztonsagi">Autóbusz Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_eloirasok">Autóbusz Előírások</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_egeszsegugy">Autóbusz Egészségügy</a>
                            </li>
                             <li>
                                <a href="#" rel="teherauto_biztonsagi">Teherautó Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="teherauto_eloirasok">Teherautó Előírások</a>  
                            </li>
                            <li>
                                <a href="#" rel="teherauto_egeszsegugy">Teherautó Egészségügy</a>
                            </li>
                        </ul>
                    </li>
            <!--    kérdés módosít   -->
                     <li>
                        <a href="#">Kérdések módosítása 
                            <i class="icon ion-md-arrow-dropdown"></i>
                        </a>
                        <ul class="sub-menu modosit">
                            <li>
                                <a href="#" rel="autobusz_biztonsagi">Autóbusz Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_eloirasok">Autóbusz Előírások</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_egeszsegugy">Autóbusz Egészségügy</a>
                            </li>
                             <li>
                                <a href="#" rel="teherauto_biztonsagi">Teherautó Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="teherauto_eloirasok">Teherautó Előírások</a>  
                            </li>
                            <li>
                                <a href="#" rel="teherauto_egeszsegugy">Teherautó Egészségügy</a>
                            </li>
                        </ul>
                    </li>
            <!--    új kérdés   -->
                    <li>
                        <a href="#">Új kérdés felvitele 
                            <i class="icon ion-md-arrow-dropdown"></i>    
                        </a>
                        <ul class="sub-menu new_question">
                            <li>
                                <a href="#" rel="autobusz_biztonsagi">Autóbusz Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_eloirasok">Autóbusz Előírások</a>
                            </li>
                            <li>
                                <a href="#" rel="autobusz_egeszsegugy">Autóbusz Egészségügy</a>
                            </li>
                             <li>
                                <a href="#" rel="teherauto_biztonsagi">Teherautó Biztonsági</a>
                            </li>
                            <li>
                                <a href="#" rel="teherauto_eloirasok">Teherautó Előírások</a>  
                            </li>
                            <li>
                                <a href="#" rel="teherauto_egeszsegugy">Teherautó Egészségügy</a>
                            </li>
                        </ul>
                    </li>
                   
            <!--       jelszó       -->
                    <li>
                         <a href="#">Jelszó és idő
                            <i class="icon ion-md-arrow-dropdown"></i>    
                        </a>
                        <ul class="sub-menu ">
                            <li>
                                <a href="#" class="pass_change" rel="password_change">Jelszó módosítás</a>
                            </li>
                            <li>
                               <a href="#" class="pass_change" rel="timer_status">Időzítő kikapcsolás</a>
                            </li>
                        </ul> 
                    </li>
            <!--    kilépés   -->
                    <li class="move-right btn">
                        <a href="include/logout.inc.php" id="btn-color">Kilépés</a>   
                    </li>
                </ul>
            </nav>
        </div>
    </header>    

    <section>
        <div class="text2">
            <h1 class="admin">Admin oldal</h1>
            <div class="sajat"></div>
        </div>
    </section>
    <script src="js/scripts.js"></script>
    
    <!--    kérdés módosítás modal-->
    <div class="modal" tabindex="-1" role="dialog" id="editMemberModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kérdés szerkesztése</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form action="include/update.php" method="POST" id="updateMemberForm"> -->
                <form action="" method="POST" id="updateMemberForm">
                    <div class="modal-body">
                        <div class="messages"></div>
                        <div class="form-group row">
                            <label for="edit_id" class="col-sm-2 col-form-label">Kérdés ID</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit_id" class="form-control" id="edit_id" readonly>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="database_name" class="col-sm-2 col-form-label">Adatbázis</label>
                            <div class="col-sm-10">
                                <input type="text" name="database_name" class="form-control" id="database_name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_kerdes" class="col-sm-2 col-form-label">Kérdés</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit_kerdes" class="form-control" id="edit_kerdes" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_valasz1" class="col-sm-2 col-form-label">Válasz1</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit_valasz1" class="form-control" id="edit_valasz1" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_valasz2" class="col-sm-2 col-form-label">Válasz2</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit_valasz2" class="form-control" id="edit_valasz2" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="edit_valasz3" class="col-sm-2 col-form-label">Válasz3</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit_valasz3" class="form-control" id="edit_valasz3" required>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="helyes_valasz" class="col-sm-2 col-form-label">Helyes válasz</label>
                            <div class="col-sm-10">
                                <input type="number" name="helyes_valasz" class="form-control" id="helyes_valasz" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezár</button>
                        <button type="submit" name="kuld2" id="update_button" class="btn btn-primary">Mentés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
