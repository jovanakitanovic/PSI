<!--Jovana Kitanovic 603/17-->
<html>
    <head>
	<title> Pomaži i Smaži</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta charset="UTF-8">
    </head>
    <body>   
           <?php 
           $ime="";
           $sastojci="";
           $priprema="";
           $slika="";
           $ponovi=false;
            $id;
        include_once 'kontrola.php';
            $id=1;
            session_start();
            //provera da li smo na stranicu probali da udjemo direktno preko linka, bez logovanja
            if(!isset($_SESSION["username"])) {
               $_SESSION["err1"]=1;
                header("Location: index.php");
                exit;
               echo "<script type='text/javascript'>alert('nistte lepo ulogovani');</script>"    ;

                
            }
              $user=$_SESSION["username"];

           $sql="SELECT id FROM korisnik WHERE username='$user'";
            $result= mysqli_query($conn, $sql);
         
                    if(mysqli_num_rows($result)>0)
                       while($row= mysqli_fetch_assoc($result)){
                     // echo "<script type='text/javascript'>alert(".$row['id'].");</script>" ;
                            $id=$row['id'];
                       }
            
            //ulogovani korisnik moze biti admin ili ne, pa shodno tome jedine dve stranice na koje se skace nakon logovanja su ili admin ili korisnik sa nalogom
            //ako smo nekako uspeli da odemo na onu drugu stranicu u odnosu na ono sta smo mi, vracamo se na nasu
            //ovo postoji za slucaj kada vise puta pritiskamo back, tu zeza
            if($_SESSION["admin"]==NULL) {
                header("Location: pocetna_sa_nalogom.php");
                exit;
            }

           ?>      
        
        <form action="" method="post" enctype="multipart/form-data">
	<div class="container-fluid">
            <table class="table table-borderless table-dark" align="center" >
		<tr>
                    <td></td>
                    <td align=""><h3>Pomaži i Smaži</h3></td>
                    <td align="right"> <form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
                                <button type="submit" class="btn btn-warning" name="logout" >Izloguj se</button>
                            </form>
                                              <?php
                                             
                                                if(isset($_POST["logout"])) {
                                                echo "<script type='text/javascript'>alert(".$row['id'].");</script>" ;

                                                session_unset();
                                                session_destroy();
                                                header("Location: index.php");
                                                exit;
                                                 }
                                                 ?></td>
                    <td></td>
                </tr>
            </table>

                <table class="table table-borderless table-dark" align="center" >
                    <tr>
                        <td align="right" width="50%">Ime:</td>
                        <td align="left"><input type="text" id="ime" name="ime" value="<?php if(isset($_POST["submit"])) echo $_POST['ime']; ?>"></td>
                    </tr>
                    <tr>
                        <td align="right" width="50%">Kategorija</td>
                        <td align="left">
                            <input type="checkbox"  name="kategorija[]" value="k1" >  &nbsp Jelo od mesa &nbsp
                            <input type="checkbox"  name="kategorija[]" value="k2">  &nbsp Slatkiš &nbsp
                            <input type="checkbox"  name="kategorija[]" value="k3">  &nbsp Testa &nbsp
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="50%">Sastojci</td>
                        <td align="left"><textarea id="w3mission" rows="4" cols="50" name="sastojci" ><?php 
                                                                                                        if(isset($_POST['submit']))
                                                                                                            echo $_POST['sastojci'];
                                                                                                            ?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" width="50%">Način pripreme</td>
                        <td align="left"><textarea id="w3mission" rows="8" cols="50" id="priprema" name="priprema"><?php 
                                                                                            if(isset($_POST['submit']))
                                                                                              echo $_POST['priprema'];
                                                                                                            ?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" width="50%">Ucitaj sliku</td>
                        <td align="left">
                            <!-- deo za ubacivanje slike-->
                            <input type="file" name="fileToUpload" >	
                        </td>
                    </tr>
                    <tr>
                        <td align="right" width="50%"><a href="moj_nalog.php" ><button type="button" class="btn btn-danger" >Odustani</button></a></td>
                        <td align="left"><a href="moj_nalog.php"><input type="submit" href="moj_nalog.php" value="Objavi" class="btn btn-success" name="submit"></a> &nbsp &nbsp &nbsp
                            <a href="moj_nalog.php"><input type="button"  value="Pregledaj recepte" class="btn btn-secondary" name="submit"></a></td>
                       <!-- <td align="right" width="50%"><a href="moj_nalog.php" ><button type="button" class="btn btn-danger" >Odustani</button></a></td>-->
                    </tr>
                </table>
            </form>

        </div>
              <?php
                    $ime="";
                    $sastojci="";
                    $priprema="";
                    $slika="";
                if(isset($_POST["submit"])) {
                    include_once 'kontrola.php';
                   
                    $ime=$_POST['ime'];
                    $sastojci=$_POST['sastojci'];
                    $priprema=$_POST['priprema'];
                    $slika= basename($_FILES['fileToUpload']['name']);  
                  //  echo $priprema;
                    $imageFileType;
                    $target_dir;
                     $target_file ;
                                        
                   // echo $ime;
                  //  echo $sastojci;
                  //  echo $priprema;                    
                    //echo $slika;
                    
                    $k1=0;
                    $k2=0;
                    $k3=0;

                    $num=0;
                    if(isset($_POST['kategorija'])){
                    $k=$_POST['kategorija'];
                    if($k>0)
                    foreach($k as $val){
                   // echo $val;
                    if($val=="k1")
                        $k1=1;
                    if($val=="k2")
                        $k2=1;
                    if($val=="k3")
                        $k3=1;
                    
                    $num++;
                        }

                   
                     }
                       
                     $ok=false;
                     
                     if($ime==""){
                       echo "<script type='text/javascript'>alert('postavite ime recepta');</script>";
                   
                     }
                     else
                    if($num>2 )
                        echo "<script type='text/javascript'>alert('odabrali ste vise od 2 kategorije');</script>";  
                      else 
                        if($num==0)
                           echo "<script type='text/javascript'>alert('molimo izaberite kategorije');</script>";
                          else 
                             if($sastojci=="")
                              echo "<script type='text/javascript'>alert('unesite sastojke');</script>";
                           else 
                              if($priprema=="")
                                     echo "<script type='text/javascript'>alert('unesite nacin pripreme');</script>";
                        else
                            if($slika=="")
                                echo "<script type='text/javascript'>alert('postavite sliku');</script>";
                             else{
                                 $imageFileType= pathinfo($slika, PATHINFO_EXTENSION);
                                // echo $imageFileType;
                                 $target_dir = "uploads/";
                                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                                
                                        if($imageFileType == "jpg" || $imageFileType == "JPG"|| $imageFileType == "png" || $imageFileType == "PNG" || $imageFileType == "jpeg" || $imageFileType == "JPEG" ) {
                                      
                                             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                             $ok=true;
                                           }
                                           else
                                             echo "<script type='text/javascript'>alert('izvinjavamo se, doslo je do greske, pokusajte ponovo');</script>";

                                      } else {
                                            echo "<script type='text/javascript'>alert('dokument koji ste odabrali nije slika');</script>";

                                     }
                             }
                                     
                      if($ok)
                     {

                 // echo " ".$target_file." ".$sastojci." ".$priprema." ".$k1." ".$k2." ".$k3." ".$ime;
                  
                 /*  $sql="SELECT * FROM recepti";
                   
                   
                   $result= mysqli_query($conn, $sql);
                   
                   if(mysqli_num_rows($result)>0){
                       while($row= mysqli_fetch_assoc($result))
                              echo '<img src="'.$row['slika'] .'"></img>';
                           //echo $row["slika"];
                   }*/

                 $sql="INSERT INTO recepti(slika,sastojci,priprema,k1,k2,k3,autor,ime) VALUES('$target_file','$sastojci','$priprema',$k1,$k2,$k3,$id,'$ime')";
               //  $sgl="INSERT INTO recepti(slika,sastojci) VALUES('$target_file','$sastojci')";
         
                        $result= mysqli_query($conn, $sql);
                       echo '<script type="text/javascript">',     'jsfunction();',     '</script>';
                         echo "<script type='text/javascript'>alert('USPEŠNO STE UNELI RECEPT');</script>";
                         

                     //  header('Location: moja_jela.php?id=1&val=<script type="text/javascript">alert("BRAVOOO! OVDE MOŽETE VIDETI SVOJ RECEPT");</script>');
                      //    exit();
                    }    

                    
                }
                
            ?>
   
            </script>
    </body>
</html>