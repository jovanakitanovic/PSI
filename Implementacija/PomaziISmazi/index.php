<!-- autor: Jovana Kitanović 0603/17 -->


<html>
    <head>
	<title>Pomaži i Smaži</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            include_once "kontrola.php";
            session_start();
            if(isset($_SESSION["username"])&&!isset($_SESSION["err1"])){
                if($_SESSION["admin"]==1) header("Location: administrator.php");
                else header("Location: pocetna_sa_nalogom.php");
                exit;
            }
            if(isset($_SESSION["err1"])) {
                session_unset();
                session_destroy();
            }
        ?>
	<div class="container-fluid">
            <div class="row table-dark pt-3 ml-1 mr-1">
                <div class="col-9"><h3>Pomaži i Smaži</h3></div>
                <div class="col-3" align="right"><a href="pocetna_bez_naloga.php" ><button type="button" class="btn btn-warning">Poseti bez logovanja</button></a></div>
                <div class="col-12 p-3" align="center"><h1>Dobrodošli i dobro se najeli</h1></div>
            </div>
	</div>
	<div class="container-fluid mt-3">
            <form method="post" action="<?php $_SERVER["PHP_SELF"];?>">
                <div class="row table-dark pt-3 pb-3 ml-1 mr-1">
                    <div class="col-6 pt-3" align="right">Username:</div>
                    <div class="col-6 pt-3" align="left"><input type="text" name="username"></div>
                    <div class="col-6 pt-3" align="right">Password:</div>
                    <div class="col-6 pt-3" align="left"><input type="password" name="password"></div>
                    <div class="col-6 pt-3" align="right">
                        <input type="submit" value="Uloguj se" name="submit" class="btn btn-primary">
                    </div>
                    <div class="col-6 pt-3" align="left">
                        <a href="napravi_nalog.php">
                            <input type="button" value="Napravi nalog" class="btn btn-info">
                        </a>
                    </div>
                </div>
            </form>
            <?php
                if(isset($_POST["submit"])) {
                    if($_POST["username"]==""||$_POST["password"]=="") {
                        echo '<script type="text/javascript">alert("Niste uneli sve potrebne podatke!")</script>';
                    } else {
                        $user=$_POST["username"];
                        $password=hash('sha512',$_POST["password"]);
                        
                        $sql="SELECT * FROM korisnik WHERE korisnik.username='$user'";
                        $result= mysqli_query($conn, $sql);
                        
                        
                        if(mysqli_num_rows($result)==0) echo '<script type="text/javascript">alert("Uneli ste nepostojece korisnicko ime!")</script>';
                        else {
                            $row= mysqli_fetch_assoc($result);
                            if($row["sifra"]==$password) {
                                $_SESSION["username"]=$user;
                                $_SESSION["admin"]=$row["admin"];
                                if($row["admin"]==1) header("Location: administrator.php");
                                else header("Location: pocetna_sa_nalogom.php");
                                exit;
                            } else {
                                echo '<script type="text/javascript">alert("Uneli ste pogresnu lozinku")</script>';
                            }
                              
                        }
                    }
                }
            ?>
	</div>
    </body>
</html>