<?php 
$page = ('Vis Kontrakt');
require_once("includes/header.php");
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("Du er ikke logget ind på MUTUUM - log ind her, eller opret en bruger og få gratis adgang til platformen!");';
        echo 'window.location.href="login.php";';
        echo '</script>' ;
        die();
  }
$user_id = $_SESSION['user_id'];
$kontrakt_id2 = $_GET['kontrakt_id2'];
?>
<div class="container-fluid">
<h1>Er du sikker på du vil slette kontrakten?</h1>

    <form novalidate method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <?php        
        
         if(isset($_POST['submit'])){   
            $query = "DELETE * FROM kontrakt WHERE kontrakt_id = '$kontrakt_id2'";
            $result = mysqli_query($con, $query);
            $row3 = mysqli_fetch_assoc($result3);
            if(!$result) {
                die(mysqli_error($con));
            }
            else {
		echo '<script>alert("Kontrakten er nu slettet");';
        echo '</script>' ;
        die();
            }} ?>
    
        <a  href="minside.php?kontrakt_id2=<?php echo $kontrakt_id2 ?>"><button type="submit" class="btn btn-warning btn-lg">Slet</button></a>
    </form>
</div>
<?php

require_once("includes/footer.php");
?>