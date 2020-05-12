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
           
         for ($i=0;$i<1;$i++){   
          foreach ($recepti as $recept) {

          $imageProperties = [
            'src' => "http://localhost/ps/$recept->slika",
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
            echo "<td><br>";
           echo "<h5> {$recept->ime} </h5> <hr/>";

           echo "{$recept->sastojci}  <hr/>";

           echo "{$recept->priprema}  <hr/>";
           
           //
           //echo anchor("Korisnik/ocenjivanje?id=$recept->id&o=1", "<input type='button' class='btn btn-light'  value='1' />");
           echo "<input type='button' onclick='oceni("."$recept->id,1".")' class='btn btn-light' value='1'>";
           echo "&nbsp";
          // echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='1' />&nbsp	";    
        
           echo "<input type='button' onclick='oceni("."$recept->id,2".")' class='btn btn-light' value='2'>";
           echo "&nbsp";
          // echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='2' /> &nbsp	";
       
           echo "<input type='button' onclick='oceni("."$recept->id,3".")' class='btn btn-light' value='3'>";
           echo "&nbsp";
          // echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='3' /> &nbsp	";
        
           echo "<input type='button' onclick='oceni("."$recept->id,4".")' class='btn btn-light' value='4'>";
           echo "&nbsp";
         //  echo "<input type='submit' class='btn btn-light' name="."o$recept->id"."  value='4' /> &nbsp";
         
           echo "<input type='button' onclick='oceni("."$recept->id,5".")' class='btn btn-light' value='5'>";
           echo "&nbsp &nbsp ";
           //echo "<input type='submit' class='btn btn-light' name="."o$recept->id"." value='5' /> &nbsp &nbsp ";
         
           echo "<input type='button' onclick='sacuvaj("."$recept->id".")' class='btn btn-primary' value='sacuvaj'>";
           echo "&nbsp &nbsp ";
           //echo "<input type='submit' name="."sacuvaj$recept->id"."  class='btn btn-primary' value='sačuvaj'> &nbsp &nbsp";   
           
           echo "<input type='button' onclick='prijavi("."$recept->id".")' class='btn btn-danger' value='prijavi'>";
           echo "&nbsp &nbsp <br><br><hr/><br>";   
           //echo "<input type='submit' name="."prijavi$recept->id"."  class='btn btn-danger' value='prijavi'><hr/><hr/><br>";
         
            echo "</td>";
            echo "</tr>";
            echo "</table>";
            
            echo '<hr style="border: 1px solid gray;">';
            echo "</td>";
            echo "</tr>";
            
            
            }
         }
         
    /*     foreach ($recepti as $recept){
             
             if(isset($_POST["sacuvaj$recept->id"])){
                 echo "$recept->id";
                 $kontroler='Korisnik';
                 $k->provera();
             }
             
             if(isset($_POST["prijavi$recept->id"])){
                // echo "$recept->id";
             }
             if(isset($_POST["o$recept->id"])){
                 $kontroler='Korisnik';
                 $k->ocenjivanje($recept->id,$_POST["o$recept->id"]);
                 //$_POST["o$recept->id"];
                 //echo "$recept->id -- $lala";
             }
             
         }
         */
        
         
            ?>
   
    </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  

    function oceni(id,o)
    {
    
        $.ajax({
             url:"http://localhost:8080/index.php/Korisnik/ocenjivanje",
             method: 'GET',
             data: {id:id,o:o},
             dataType: 'json',
             timeout: 3000,
          success: function(status){
          if(status!="uspesno ste ocenili recept")
             alert (status);
          },error:function(error){
              console.log(error);
        }
        });
  
     }
     
    function sacuvaj(id)
    {
    
       $.ajax({
             url:"http://localhost:8080/index.php/Korisnik/sacuvaj",
             method: 'GET',
             data: {id:id},
             dataType: 'json',
             timeout: 3000,
         success: function(status){
         if(status!="recept je sačuvan")
             alert (status);
         },error:function(error){
             console.log(error);
        }
        });
  
     }
     
    function prijavi(id)
    {
    
        $.ajax({
                url:"http://localhost:8080/index.php/Korisnik/prijavi",
                method: 'GET',
                data: {id:id},
                dataType: 'json',
                timeout: 3000,
            success: function(status){
            if(status!="recept je prijavljen")
                alert (status);
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