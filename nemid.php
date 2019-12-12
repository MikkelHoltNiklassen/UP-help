<?php
$page = ('nemID');
require_once("includes/header.php");
if (!isset($_SESSION)) {session_start();}
if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("Du er ikke logget ind på MUTUUM - log ind her, eller opret en bruger og få gratis adgang til platformen!");';
        echo 'window.location.href="login.php";';
        echo '</script>' ;
        die();
  }
$user_id = $_SESSION['user_id'];
$kontrakt_id = $_GET['kontrakt_id2'];
echo $kontrakt_id;

if (isset($_POST["submit"])){
    $query = "SELECT * FROM kontrakt WHERE kontrakt_id = '$kontrakt_id'";
    $result = mysqli_query($con, $query);
             if(!$result) die(mysqli_error($con));
             else {
                 if($row > 0){
                    while($row = mysqli_fetch_assoc($result1)) {
                        $laangiver_user_id_hent = $row['laangiver_user_id'];
                        $laantager_user_id_hent = $row['laangiver_user_id'];
                        
                        if ($laangiver_user_id_hent = $user_id){
                            $query1 = "UPDATE kontrakt SET laangiver_underskrift_id = '2' WHERE kontrakt_id = '$kontrakt_id2'";
                            $result1 = mysqli_query($con, $query1);
                            if(!$result1) {die(mysqli_error($con)); } else {                           
                            echo '<script>("Kontrakten er nu underskrevet.") window.location.href="index.php";</script>';}
                        } else if ($laantager_user_id_hent = $user_id){
                            $query2 = "UPDATE kontrakt SET laantager_underskrift_id = '2' WHERE kontrakt_id = '$kontrakt_id2'";
                            $result2 = mysqli_query($con, $query2);
                            if(!$result2) { die(mysqli_error($con)); } else {                           
                            echo '<script>("Kontrakten er nu underskrevet.") window.location.href="index.php";</script>';}
                        } else die(mysqli_error($con));}
                    }
    
}  
} else { 
                     echo '<script>("Hvis du forlader denne side, så vil din kontrakt ikke blive underskrevet.")</script>';}               
?>
<style>
#nemIDfake {
    background-image: url(images/nemID1.PNG);
    background-color: whitesmoke;
    background-repeat: no-repeat;
    background-size:inherit; 
    }

@media(max-width: 375px) {
    #nemIDfake {
    background-image:url(images/nemID_iphone.PNG);
    background-color: whitesmoke;
    background-repeat: no-repeat;
    background-size:inherit;
    }
    }

</style>
<body id="nemIDfake"> 
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <a href="minside.php"><button onclick="changeElement()" class="btn btn-warning mutuumknap" type="submit">Underskriv kontrakt</button></a>
<br><br>
        <p id='underskrevet'>Kontrakten er endnu ikke underskrevet, klik på "Underskriv kontrakt"</p>
<br>

    <script>
        function changeElement() {
        document.getElementById('underskrevet').innerHTML = alert("Du har nu underskrevet kontrakten");
        }
    </script>

<!--footeren skal HENTES IND HERINDE I STEDET FOR REQUIRE, DA DET LIGE NU KUN ER BAGGRUND OG IKKE NOGET "FYLD"-->
<?php
require_once("includes/footer.php");
?>
