<!--Jovana Kitanovic 603/17-->
<html>
		<head>
		<title> Pomaži i Smaži</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<meta charset="UTF-8">
	</head>
	<body>
          <?php
        include_once 'kontrola.php';
            $id;
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
            <form method="POST">
						
		<div class="container-fluid">
		

			<table class="table table-borderless table-dark" align="center" >
				<tr>
				<td></td>
					<td align="">
					<h3>Pomaži i Smaži</h3>
					</td>
					
					<td align="right">
					
			<form method="post" action="<?php $_SERVER["PHP_SELF"]?>">
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
                                              ?>
							
					</td>
					<td></td>
				</tr>
			</table>
		
			<table class="table " align="center" >


				<tr >
					<td align="right" width="20%">
							
					<table class="table table-bordered table-dark" align="center" >
						<tr>
							<td align="center">
								<a href="moja_jela.php" class="text-white">moja jela</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="sacuvano.php" class="text-white">sačuvana jela</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="pocetna_sa_nalogom.php" class="text-success">sva jela</a>
							</td>
						</tr>
												<tr>
							<td align="center">
								<a href="moj_nalog.php" class="text-info">moj nalog</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="novi_recept.php" class="text-warning" >objavi novi recept</a>
							</td>
						</tr>
					</table>
					</td>
					<td align="left">
					<table  class="table " align="center" >
                  <?php  
                  include_once 'kontrola.php';
                   ini_set("precision",3);
             
                   $indeksi;
                   $i=0;
                   
            /*   if(isset($_GET['val'])){
                       echo $_GET['val'];
                       
                       }*/
    
                   $sql="SELECT * FROM recepti WHERE autor=$id";
                   $result= mysqli_query($conn, $sql);
                   
                   if(mysqli_num_rows($result)>0){
                       while($row= mysqli_fetch_assoc($result)){
                           $indeksi[$i++]=$row['id'];
                           echo '<tr> <td align="center" width="40%" >';
                              echo '<img width="100%" src="'.$row['slika'] .'"></img></td>';
                             echo '<td width="60%"><table> <tr> <h5> '.$row['ime'].'<hr/></h5></h5></tr>'.$row['sastojci'].'<hr/>'.$row['priprema'].'</td></tr>
									</table>
								</td>
							</tr></tr>';
                             }

                   }

               /*    foreach ($indeksi as $ind)
                   if(isset($_POST['o'.$ind])){
                       $ocena=$_POST['o'.$ind];
                       
                   $sql="SELECT * FROM ko WHERE idK=".$id." and idR="."$ind";
                   $result= mysqli_query($conn, $sql);
                        
            if(mysqli_num_rows($result)>0)  {
               echo "<script type='text/javascript'>alert('recept je već ocenjen');</script>"    ;
                }
              else{
                  $o=0;
                  $num;
                $sql="INSERT INTO ko(idK,idR,ocena) VALUES($id,$ind,$ocena)";
                $result= mysqli_query($conn, $sql);
                
                $sql="select count(idR) as sum from ko where idR="."$ind" ;
                $result= mysqli_query($conn, $sql);
            
                while($row= mysqli_fetch_assoc($result)){
                        echo "<script type='text/javascript'>alert('".$row['sum']."');</script>"   ;
                    $num=$row['sum'];    
                }
                
                 $sql="select SUM(ocena) as sumO from ko where idR="."$ind" ;
                $result= mysqli_query($conn, $sql);
            
                while($row= mysqli_fetch_assoc($result)){
                        echo "<script type='text/javascript'>alert('".$row['sumO']."');</script>"   ;
                    $o=$row['sumO'];    
                }
                $rez=$o/$num;
                 echo "<script type='text/javascript'>alert('".$rez."');</script>"   ;
                
                 $sql="UPDATE recepti SET ocena=$rez WHERE id=$ind";
                  $result= mysqli_query($conn, $sql);
                 
                }
              }       */            
            ?> 
  
                   
     
                                 
			</table>

		</div>
                
            </form>
	</body>
</html>