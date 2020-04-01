<!--Jovana Kitanovic 603/17-->
<html>
		<head>
		<title> Pomaži i Smaži</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<meta charset="UTF-8">
	</head>
	<body>
		 <?php $id=1;?>
            <form method="POST">			
		<div  class="container-fluid">			
			<table class="table table-borderless table-dark" align="center" >
				<tr>
				<td></td>
					<td align="">
					<h3>Pomaži i Smaži</h3>
					</td>
					
					<td align="right">
					
					<a href="index.php" ><button type="button" class="btn btn-warning" >uloguj se</button></a>
							
					</td>
					<td></td>
				</tr>
			</table>
		</div>
			
		<div class="container-fluid">

			
			<table class="table " align="center" >

				<tr >
					<td align="right" width="20%">
							
					<table class="table table-bordered table-dark" align="center" >
						<tr>
							<td align="center">
								<a href="slatko.php"  class="text-white">slatko ćoše</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="meso.php"  class="text-white">za mesojede</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="testo.php" class="text-white">svakojaka testa</a>
							</td>
						</tr>
												<tr>
							<td align="center">
								<a href="pocetna_bez_naloga.php" class="text-success">sva jela</a>
							</td>
						</tr>
												<tr>
							<td align="center">
								<a href="izvrni_kuvar_bez_naloga.php" class="text-danger">izvrsni kuvar</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="odlični_kuvar_bez_naloga.php" class="text-danger">odlični kuvar</a>
							</td>
						</tr>
						<tr>
							<td align="center">
								<a href="solidni_kuvar_bez_naloga.php" class="text-danger">solidni kuvar</a>
							</td>
						</tr>


					</table>
					</td>
					<td  align="left">
					<table  align="center" >
                                            
                                      
<b>recepti sa ocenom manjom od 2</b>
		
                                            
                            <?php  
                   include_once 'kontrola.php';
                   ini_set("precision",3);
             
                   $indeksi=array();
                   $i=0;
                 //   echo "<script type='text/javascript'>alert('alalal');</script>"   ;

 
                   $sql="SELECT * FROM recepti WHERE ocena<2";
                   $result= mysqli_query($conn, $sql);
                   
                   if(mysqli_num_rows($result)>0){
                       while($row= mysqli_fetch_assoc($result)){
                           $indeksi[$i++]=$row['id'];
                           echo '<tr> <td width="40%" align="center" >';
                              echo '<img width="100%" src="'.$row['slika'] .'"></img></td>';
                             echo '<td width="60%"><table> <tr> <h5> '.$row['ime'].'<hr/></h5></h5></tr>'.$row['sastojci'].'<hr/>'.$row['priprema'].'</td></tr><tr>								
									</tr>
									</table>
								</td>
							</tr></tr>';
                             }
                   }
                ?>
		
		</div>
			</table>
		
	</body>

</html>