<td>
<table>
    <form method="post" >
     
           <?php   
           
           if($_SESSION['izbor']=='izvrsni_kuvar'){
            echo "<h5>recepti sa ocenom vecom od 4 </h5>";
            echo "<hr/>";
           }
           if($_SESSION['izbor']=='odlicni_kuvar'){
            echo "<h5>recepti sa ocenom vecom od 2, a manjom od 4 </h5>";
            echo "<hr/>";
           }
           if($_SESSION['izbor']=='solidni_kuvar'){
            echo "<h5>recepti sa ocenom manjom od 2 </h5>";
            echo "<hr/>";
           }
           
          $k=new \App\Controllers\Korisnik();
           
           $input = dirname(__DIR__);
           $arr1 = explode("\\", $input);
           $output = array_slice($arr1, -4, 1);
           $output = implode(',', $output);
           $path = "http://localhost/" . $output;

          for ($i=0;$i<1;$i++){   
          foreach ($recepti as $recept) {

          $imageProperties = [
            'src' => $path."/$recept->slika",
            'alt' => "$recept->slika",
            'width' => '90%',
             ];
          
             echo "<tr>";
            echo "<td width='40%' align='center'>";
           // echo img("http://localhost/ps/$recept->slika");
            echo img($imageProperties);
            echo "</td>";
            
            echo "<td width='60%'>";
            echo "<table style=>";
            echo "<tr>";
            echo "<td><br/>";
           echo "<h5> {$recept->ime} </h5> <hr/>";

           echo "{$recept->sastojci}  <hr/>";

           echo "{$recept->priprema}  <hr/>";
           echo "<input type='button' onclick='izbaci("."$recept->id".")' class='btn btn-danger' value='izbaci'>";
           echo "&nbsp &nbsp ";
           echo " <br/><hr/><br/><br/>";

            echo "</td>";
            echo "</tr>";
            echo "</table>";
             echo '<hr style="border: 1px solid gray;">';
            echo "</td>";
            echo "</tr>";
            
            }
         }
         
         
         
            ?>
   
    </form>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>    
      
    function izbaci(id)
    { 
    
        $.ajax({
             url:"http://localhost:8080/index.php/Korisnik/izbaci",
             method: 'GET',
             data: {id:id},
             dataType: 'json',
             timeout: 3000,
          success: function(status){
          if(status!="recept je izbacen")
             alert (status);
            location.reload(true); 
          $('#pagination').html(status.pagination);
          },error:function(error){
              console.log(error);
        }
        });
  
     }
     
  </script>
  
</table>
</td>
</tr>
</div>
</table>
</body>
</html>