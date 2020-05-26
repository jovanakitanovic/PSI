<td>
<table>
    <form method="post" >
     
        <?php   
         
        $k=new \App\Controllers\Admin();
             $input=dirname(__DIR__);
             $arr1 =  explode("\\", $input);
             $output = array_slice($arr1, -4, 1);
             $output=implode(',', $output);
             $path= "http://localhost/".$output;
             
        for ($i=0;$i<1;$i++){   
            foreach ($recepti as $recept) {

            $imageProperties = [
            'src' => $path."/{$recept['recept']->slika}",
            'alt' => "{$recept['recept']->slika}",
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
           echo "<h5> {$recept['recept']->ime} </h5> <hr/>";

           echo "{$recept['recept']->sastojci}  <hr/>";

           echo "{$recept['recept']->priprema}  <hr/>";
           echo "<b>Broj prijava: ".$recept['broj']."</b>";
           echo "&nbsp &nbsp ";
           echo "<input type='button' onclick='ukloni("."{$recept['recept']->id}".")' class='btn btn-danger' value='ukloni'>";
           echo "&nbsp &nbsp ";
           echo "<input type='button' onclick='ostavi("."{$recept['recept']->id}".")' class='btn btn-success' value='ostavi'>";
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
      
    function ukloni(id)
    { 
   
        $.ajax({
             url:"http://localhost:8080/index.php/Admin/izbaci",
             method: 'GET',
             data: {id:id},
             dataType: 'json',
             timeout: 3000,
          success: function(status){
          if(status!="recept je uklonjen")
             alert (status);
            location.reload(true); 
          $('#pagination').html(status.pagination);
          },error:function(error){
              console.log(error);
        }
        });
  
     }
     
    function ostavi(id)
    { 
     
        $.ajax({
             url:"http://localhost:8080/index.php/Admin/ostavi",
             method: 'GET',
             data: {id:id},
             dataType: 'json',
             timeout: 3000,
          success: function(status){
          if(status!="recept je ostavljen")
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