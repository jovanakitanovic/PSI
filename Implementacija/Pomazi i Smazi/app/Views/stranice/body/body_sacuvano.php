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
            echo "<td><br/>";
           echo "<h5> {$recept->ime} </h5> <hr/>";

           echo "{$recept->sastojci}  <hr/>";

           echo "{$recept->priprema}  <hr/>";
           echo anchor("Korisnik/izbaci?id=$recept->id", "<input type='button' class='btn btn-danger'  value='izbaci' />");
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
</table>
</td>
</tr>
</div>
</table>
</body>
</html>