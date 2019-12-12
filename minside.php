<?php
$page = ('Din side');
require_once("includes/header.php");
if (!isset($_SESSION)) {session_start();}
if (!isset($_SESSION['user_id'])) {
        echo '<script>alert("Du er ikke logget ind på MUTUUM - log ind her, eller opret en bruger og få gratis adgang til platformen!");';
        echo 'window.location.href="login.php";';
        echo '</script>' ;
        die();
  }
$user_id = $_SESSION['user_id'];
?>

<!--******************ALT KODE TIL MIN PROFIL*****************-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 minprofilpaaminside">
                <hr>
                <h1>MIN PROFIL</h1>
                <hr>

                <?php
            $udfyld = "SELECT mail, fornavn, efternavn, mobil FROM users WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $udfyld);
                $row = mysqli_num_rows($result);
                    if ($row > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                    echo "&nbsp;<strong>Brugernavn:</strong> " . $row['mail'] . "<br>&nbsp;<strong>Fornavn:</strong> " . $row['fornavn'] . "<br>&nbsp;<strong>Efternavn:</strong> " . $row['efternavn'] . "<br>&nbsp;<strong>Telefon nr.:</strong> " . $row['mobil'] . "<br><br>";
                    } 
                    } else {
                        echo "";
                        }   
        ?>
                <a href="retoplysninger.php" id="vispamobil" ><button class="btn btn-warning mutuumknap">Ret oplysninger</button></a>
                <a href="opretkontrakt.php"><button class="btn btn-warning pull-right">Opret kontrakt</button></a>
                <br>
                <br>
            </div>
        </div>
        <div class="row">
            <!-- Mine aftaler sektionen -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                    <hr>
                    <h1>DINE AFTALER</h1>
                    <hr>
            </div>
            <!-- ________________ ALT KODE TIL MANGLER UNDERSKRIFT -->  
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <h2>Mangler din underskrift</h2>
                <?php
            $query1 = "SELECT * FROM kontrakt WHERE laangiver_underskrift_id = '1' AND laangiver_user_id = '$user_id' AND laantager_underskrift_id = '1'";
                $result1 = mysqli_query($con, $query1);
                $row1 = mysqli_num_rows($result1);
                    if($row1 > 0){
                    while($row1 = mysqli_fetch_assoc($result1)){
                        $modtageruser_id = $row1['laantager_user_id'];
                        $dato_underskrift_laangiver = $row1['reg_underskrift_1']; 
                        $beloebforkontrakt = $row1['beloeb_id'];
                        $renteforkontrakt = $row1['rente_id'];
                        $kontrakt_id2 = $row1['kontrakt_id'];
                $query11 = "SELECT * FROM beloeb WHERE beloeb_id = '$beloebforkontrakt'";
                    $result11 = mysqli_query($con, $query11);
                    $row11 = mysqli_fetch_assoc($result11);
                    $beloebValue = $row11['beloeb'];
                $query111 = "SELECT * FROM rente WHERE rente_id = '$renteforkontrakt'";
                    $result111 = mysqli_query($con, $query111);
                    $row111 = mysqli_fetch_assoc($result111);
                    $renteValue = $row111['rente'];
                 $query1111 = "SELECT fornavn, efternavn FROM users WHERE user_id = '$modtageruser_id'";
                    $result1111 = mysqli_query($con, $query1111);
                    $row1111 = mysqli_fetch_assoc($result1111);
                    $modtagerfornavn = $row1111['fornavn'];
                    $modtagerefternavn = $row1111['efternavn'];    
        ?>
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3>Modtager</h3>
                        <p><?php echo $modtagerfornavn; ?> <?php echo $modtagerefternavn; ?></p>
                    </div>
                    <div class="panel-body">
                        <p><strong>Underskrevet:</strong> Nej</p>
                        <p><strong>Beløb:</strong> <?php echo $beloebValue;?> DKK</p>
                        <p><strong>Rente: </strong> <?php echo $renteValue;?> %</p>
                        <p><strong>Oprettet:</strong> <?php echo $dato_underskrift_laangiver; ?></p>
                    </div>
                    <div class="panel-footer">
                            <a href="viskontrakt.php?kontrakt_id2=<?php echo $kontrakt_id2 ?>">
                            <button class="btn btn-warning btn-lg">Vis kontrakt</button></a>
                    </div>
                </div>
                <?php
                        }} else {echo 'Du har endnu ikke modtaget nogle kontrakter';}
            
        ?>
            </div>
         <!--*************ALT KODE TIL DINE AFTALER, kontraktanmodninger-->  
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                <h2>Kontrakt anmodninger</h2>
                <?php
            $query1 = "SELECT * FROM kontrakt WHERE laangiver_underskrift_id = '2' AND laantager_user_id = '$user_id' AND laantager_underskrift_id = '1'";
                $result1 = mysqli_query($con, $query1);
                $row1 = mysqli_num_rows($result1);
                    if($row1 > 0){
                    while($row1 = mysqli_fetch_assoc($result1)){
                        $afsenderuser_id = $row1['laangiver_user_id'];
                        $dato_underskrift_laangiver = $row1['reg_underskrift_1']; 
                        $beloebforkontrakt = $row1['beloeb_id'];
                        $renteforkontrakt = $row1['rente_id'];
                        $kontrakt_id2 = $row1['kontrakt_id'];
                $query11 = "SELECT * FROM beloeb WHERE beloeb_id = '$beloebforkontrakt'";
                    $result11 = mysqli_query($con, $query11);
                    $row11 = mysqli_fetch_assoc($result11);
                    $beloebValue = $row11['beloeb'];
                $query111 = "SELECT * FROM rente WHERE rente_id = '$renteforkontrakt'";
                    $result111 = mysqli_query($con, $query111);
                    $row111 = mysqli_fetch_assoc($result111);
                    $renteValue = $row111['rente'];
                $query1111 = "SELECT fornavn, efternavn FROM users WHERE user_id = '$afsenderuser_id'";
                    $result1111 = mysqli_query($con, $query1111);
                    $row1111 = mysqli_fetch_assoc($result1111);
                    $afsenderfornavn = $row1111['fornavn'];
                    $afsenderefternavn = $row1111['efternavn'];   
        ?>
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3>Afsender</h3>
                        <h4><?php echo $afsenderfornavn; ?> <?php echo $afsenderefternavn; ?></h4>
                    </div>
                    <div class="panel-body">
                        <p><strong>Underskrevet:</strong> Nej</p>
                        <p><strong>Beløb:</strong> <?php echo $beloebValue;?> DKK</p>
                        <p><strong>Rente: </strong> <?php echo $renteValue;?> %</p>
                        <p><strong>Oprettet:</strong> <?php echo $dato_underskrift_laangiver; ?></p>
                    </div>
                    <div class="panel-footer">
                            <a href="viskontrakt.php?kontrakt_id2=<?php echo $kontrakt_id2 ?>">
                            <button class="btn btn-warning btn-lg">Vis kontrakt</button></a>
                    </div>
                </div>
                <?php
                        }} else {echo 'Du har endnu ikke modtaget nogle kontrakter';}
            
        ?>
            </div>

            <!--****************ALT KODE TIL DINE KONTRAKTER, klar til udlån-->
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <h2>Dine kontrakter klar til udlån</h2>
                    <?php
            $query2 = "SELECT * FROM kontrakt WHERE laangiver_underskrift_id = '2' AND laantager_underskrift_id = '1' AND laangiver_user_id = '$user_id'";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_num_rows($result2);
                    if($row2 > 0){
                    while($row2 = mysqli_fetch_assoc($result2)){
                        $modtageruser_id = $row2['laantager_user_id'];
                        $dato_underskrift_laangiver = $row2['reg_underskrift_1']; 
                        $beloebforkontrakt = $row2['beloeb_id'];
                        $renteforkontrakt = $row2['rente_id'];
                        $kontrakt_id2 = $row2['kontrakt_id'];
                $query22 = "SELECT * FROM beloeb WHERE beloeb_id = '$beloebforkontrakt'";
                    $result22 = mysqli_query($con, $query22);
                    $row22 = mysqli_fetch_assoc($result22);
                    $beloebValue = $row22['beloeb'];
                $query222 = "SELECT * FROM rente WHERE rente_id = '$renteforkontrakt'";
                    $result222 = mysqli_query($con, $query222);
                    $row222 = mysqli_fetch_assoc($result222);
                    $renteValue = $row222['rente'];
                $query2222 = "SELECT fornavn, efternavn FROM users WHERE user_id = '$modtageruser_id'";
                    $result2222 = mysqli_query($con, $query2222);
                    $row2222 = mysqli_fetch_assoc($result2222);
                    $modtagerfornavn = $row2222['fornavn'];
                    $modtagerefternavn = $row2222['efternavn']; 
                    
        ?>
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3>Venter</h3>
                            <p><?php echo $modtagerfornavn;?> <?php echo $modtagerefternavn; ?> har ikke underskrivet kontrakten endnu</p>

                        </div>
                        <div class="panel-body">
                            <p><strong>Underskrevet af dig:</strong> Ja</p>
                            <p><strong>Beløb: </strong><?php echo $beloebValue;?> DKK</p>
                            <p><strong>Rente: </strong><?php echo $renteValue;?> %</p>
                            <p><strong>Oprettet:</strong> <?php echo $dato_underskrift_laangiver; ?></p>
                        </div>
                        <div class="panel-footer">
                            <a href="viskontrakt.php?kontrakt_id2=<?php echo $kontrakt_id2 ?>">
                            <button class="btn btn-warning btn-lg">Vis kontrakt</button></a>
                        </div>
                    </div>
                </div>
        </div>

        <?php
                        }} else {echo 'Du har endnu ikke oprettet nogle kontrakter';}
        ?>
    </div>
    <!--******************ALT KODE TIL HISTORIK*****************-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
                    <hr>
                    <h1>HISTORIK</h1>
                    <hr>
                </div>
            </div>
            <div class="container-fluid lasse3Margin">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h2>Underskrevne kontrakter</h2>
                    </div>
                </div>
                <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">      
                    <?php
            $query3 = "SELECT * FROM kontrakt WHERE laangiver_underskrift_id = '2' AND laantager_underskrift_id = '2' + laantager_user_id = '$user_id' OR laangiver_user_id = '$user_id' ORDER BY reg_underskrift_1";
                $result3 = mysqli_query($con, $query3);
                $row3 = mysqli_num_rows($result3);
                    if($row3 > 0){
                    while($row3 = mysqli_fetch_assoc($result3)){
                        $modtageruser_id = $row3['laantager_user_id'];
                        $afsenderuser_id = $row3['laangiver_user_id'];
                        $dato_underskrift_laangiver = $row3['reg_underskrift_1'];
                        $dato_underskrift_laantager = $row3['reg_underskrift_2'];
                        $beloebforkontrakt = $row3['beloeb_id'];
                        $renteforkontrakt = $row3['rente_id'];
                        $kontrakt_id2 = $row3['kontrakt_id'];
                $query33 = "SELECT * FROM beloeb WHERE beloeb_id = '$beloebforkontrakt'";
                    $result33 = mysqli_query($con, $query33);
                    $row33 = mysqli_fetch_assoc($result33);
                    $beloebValue = $row33['beloeb'];
                $query333 = "SELECT * FROM rente WHERE rente_id = '$renteforkontrakt'";
                    $result333 = mysqli_query($con, $query333);
                    $row333 = mysqli_fetch_assoc($result333);
                    $renteValue = $row333['rente'];
                $query3333 = "SELECT fornavn, efternavn FROM users WHERE user_id = '$afsenderuser_id'";
                    $result3333 = mysqli_query($con, $query3333);
                    $row3333 = mysqli_fetch_assoc($result3333);
                    $afsenderfornavn = $row3333['fornavn'];
                    $afsenderefternavn = $row3333['efternavn'];
                $query33333 = "SELECT fornavn, efternavn FROM users WHERE user_id = '$modtageruser_id'";
                    $result33333 = mysqli_query($con, $query33333);
                    $row33333 = mysqli_fetch_assoc($result33333);
                    $modtagerfornavn = $row33333['fornavn'];
                    $modtagerefternavn = $row33333['efternavn'];
        ?>
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3>Din kontrakt</h3>
                        </div>
                        <div class="panel-body">
                            <p><strong>Aftale indgået mellem:</strong></p>
                            <p><?php echo $afsenderfornavn; ?> <?php echo $afsenderefternavn; ?> &amp; <?php echo $modtagerfornavn; ?> <?php echo $modtagerefternavn; ?> </p>
                            <p><strong>Underskrevet den:</strong> <?php echo $dato_underskrift_laangiver; ?></p>
                            <p><strong>Beløb: </strong><?php echo $beloebValue;?> DKK</p>
                            <p><strong>Rente: </strong> <?php echo $renteValue;?> %</p>
                        </div>
                        <div class="panel-footer">
                            <a href="viskontrakt.php?kontrakt_id2=<?php echo $kontrakt_id2 ?>">
                            <button class="btn btn-warning btn-lg">Vis kontrakt</button></a>
                        </div>
                    </div>
                    <?php
                        }} else {echo 'Du har ikke nogen aktive kontrakter';}
        ?>
                </div>
            </div>
        </div>

        <br>
        <?php
require_once("includes/footer.php");
?>