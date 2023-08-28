<html>
 <head>
    <title> PHP WITH HTML</title>
    <link rel="stylesheet" href="fpstyle.css">
 </head>
 <body>
    <h1>Biological Functions</h1>
    <form action="" method="post">
     <label for="id"> Gene ID:</label><br>
     <input type="number" id="id" name="gene_id"><br>
     <label for="sym">Symbol:</label><br>
     <input type="text" id="sym" name="symbol"> <br>
     <label for="gene_name">Gene_name:</label><br>
     <input type="text" id="gene_name" name="gen_name"><br>
     <label for="sc">Scientific_name:</label><br>
     <input type="text" id="sc" name="scient_name"><br>
     <label for="ge_type">Gene_type:</label><br>
     <input type="text" id="ge_type" name="gene_type"><br>
     <label for="loc">Location:</label><br>
     <input type="text" id="loc" name="location"> <br>
     <label for="typ">Type:</label><br>
     <input type="text" id="typ" name="type"><br>
     <label for="seq">Fasta Sequence:</label><br>
     <input type="text" id="seq" name="fasta_seq"> <br>
     <label for="del">Enter gene id you want to delete:</label><br>
     <input type="number" id="del" name="del"><br>
     <label for="up">Enter gene id you want to update:</label><br>
     <input type="number" id="up" name="upd"><br>
     <label for="scien">Enter the scientific name you want to update:</label><br>
     <input type="text" id="scien" name="scien"><br>
     <input type="submit" value="Insert"  name="sub">
     <input type="submit" value="Delete" name="delete">
     <input type="submit" value="Update"  name="update">
     <input type="submit" value="Update-Val" name="update_val">
     <input type="submit" value="Delete-Val" name="delete_val">
     <input type="submit" value="Insert-Val" name="insert_val">
     <input type="submit" value="Select" name="select_val">
     <!--<input type="submit" value="sequence" name="seq"><br> -->

     <input type="submit" value="Len" name="len">
     <input type="submit" value="GC_Content" name="GC">
     <input type="submit" value="CPG_Ratio" name="CPG">
     <input type="submit" value="N_Bases" name="n">
     <input type="submit" value="Transcription" name="transcripe">
     <input type="submit" value="Comp Seq" name="Compseq">
     <input type="submit" value="Rev Seq" name="revcompseq">
  
   
      
    </form>
 <?php
        $servername ="localhost";
        $username = "root";
        $password = "trt";
        $dbname ="trt-gene";
        // Create connection
        $conn = new mysqli($servername, $username,$password,$dbname);
        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        else { echo "Connected successfully";
          $seq="";
          DB_select($conn);
          DB_insert($conn);
          DB_insert_form($conn);
          DB_Delete_form($conn);
          DB_update_form($conn);
          DB_update($conn);
          DB_Delete($conn);
          #$seq=DB_Get_seq($conn);
          #echo $seq;
          echo"<br>";
          if (isset($_POST['len'])){
            echo "Sequance length is:".Length($conn)." Bases<br>";
          }
          echo"<br>";
          
          echo GC_Content($conn)."<br>";
          echo"<br>";
          echo CpG_Ratio($conn)."<br>";
          echo"<br>";
          echo N_bases($conn)."<br>";
          echo"<br>";
          $sequense=Transcription($conn);
          
          for($i=0;$i<20;$i++){
             echo $sequense[$i];
            }
          echo "<br>";
          $comp=Complement_Seq($conn);
          
          for($i=0;$i<20;$i++){
             echo $comp[$i];
            }
          echo "<br>";
          $rev=Reverse_Seq($conn);         
          for($i=0;$i<20;$i++){
             echo $rev[$i];
            }
          echo "<br>";
         
           
          
        


        
         // Close connection
         $conn->close();
        }
        function DB_Get_seq($conn){
            $seq="";
            #if (isset($_POST['seq'])){
                $sql="SELECT * FROM trt"; 
                print"<br>";
           
               //print var_dump($sql); 
               $result=$conn->query($sql);
               if ($result->num_rows > 0){
                while($row = $result-> fetch_assoc()){
                   $seq.=$row["squence"];   
               }             
             }
            #}
          return $seq;
        }




        function DB_select($conn){
          if (isset($_POST['select_val'])){
           $sql="SELECT * FROM trt"; 
           print"<br>";
           
           //print var_dump($sql); 
           $result=$conn->query($sql);
           
           if ($result->num_rows > 0){
              echo "begining selecting successfully <br> ";
              echo"<h3> Sql Select result</h3> <br>";
              while($row = $result-> fetch_assoc()){
                echo "Gene_name: [" . $row["Gene_name"]. "] - Scientific_name: [".$row["Scientific_name"]. "] Gene type : [" .$row["Gene_type"]. "]<br>";
                echo "location: [" . $row["location"]. "] - type: [".$row["type"]. "]<br>";
                echo "Id: [" . $row["Gene_ID"]. "] - symbol: [".$row["Symbol"]. "] Fasta Sequence : [" .$row["squence"]. "]<br>";
                
             }
           }
           /*
           if ($result->num_rows > 0){
             echo"<h3> Sql Select result</h3> <br>";
             while($row = $result-> fetch_assoc()){
                echo "Id: [" . $row["GID"]. "] - Name: [".$row["GName"]. "] – Fasta Sequence : [" .$row["FastaSeq"]. "]<br>";
             }

           }
           */
         }
        }
        function DB_insert($conn){
          if (isset($_POST['insert_val'])){
            $sql ="INSERT INTO trt (Gene_name,Symbol,squence)
            VALUES ('TRN', 'TERT', 'AAGGAAAAAAAAAAATAGAAGGGGGCCCCCAAAAAGGGTTGTGTGAAAGCGCGAAGAGAAAACG') ";
            if ($conn->query($sql) === TRUE)
            {
            echo "<br>";
            echo "New record created successfully";
            }
            else
            {
            echo "<br>";
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
         }
        }
        function DB_insert_form($conn){
            
            if (isset($_POST['submit'])){
                echo "insert new value from form<br>";
                $GID=$_POST['gene_id'];
                $GName=$_POST['gen_name'];
                $type=$_POST['type'];
                $location=$_POST['location'];
                $sci_name=$_POST['scient_name'];
                $symool=$_POST['symbol'];
                $seq=$_POST['fasta_seq'];
                $gen_type=$_POST['gene_type'];
                

                if (!(empty($GID)&empty($GName)&empty($type)&empty($location)&empty($sci_name)&empty($symool)&empty($seq)&empty($gen_type))){
                    $sql="INSERT INTO trt (Gene_ID,Gene_name,type,location,Scientific_name,symbol,squence,Gene_type) VALUES ('$GID','$GName','$type','$location','$sci_name','$symool','$seq','$gen_type')";
                    if ($conn->query($sql) ===true)
                    {
                        print "A new record has been inserted into database.";
                    }
                    else
                    {
                        print "Error form: ".$sql."<br>".$conn->error;
                    }      
            

                }

            }    
        }
        
        function DB_Delete($conn){
           // sql to delete a record
        if (isset($_POST['delete_val'])){
           // $del=$_POST['del'];
            $sql = "DELETE FROM trt WHERE Gene_ID= 7019" ;
            echo"<br>";
            
            if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
            } else {
            echo "Error deleting record: " . $conn->error;
            }
        }
        }
       function DB_Delete_form($conn){
        // sql to delete a record
       if (isset($_POST['delete'])){
        if (!(empty($_POST['del']))){
        // $del=$_POST['del'];
         $sql = "DELETE FROM trt WHERE Gene_ID=" .$_POST['del'];
         echo"<br>";
         
         if ($conn->query($sql) === TRUE) {
         echo "Record deleted successfully";
         } else {
         echo "Error deleting record: " . $conn->error;
         }
        }
        }
       }
        function DB_update($conn){
        if (isset($_POST['update_val'])){
           
            //$sql = "UPDATE trt SET Scientific_name=$_POST['scien'] WHERE Gene_ID=" .$_POST['upd'];
            $sql="UPDATE trt SET Scientific_name='HOM SP' WHERE Gene_ID=7016";
            echo"<br>";
            if ($conn->query($sql) === TRUE) {
              echo "Record updated successfully";
            } else {
              echo "Error updating record: " . $conn->error;
            }
           
        }
        }
        function DB_update_form($conn){
            if (isset($_POST['update'])){
                //$sql = "UPDATE trt SET Scientific_name=$_POST['scien'] WHERE Gene_ID=" .$_POST['upd'];
                if (!(empty($_POST['scien'])&empty($_POST['upd']))){
                $sql="UPDATE trt SET Scientific_name ='".$_POST['scien']."'WHERE Gene_ID='".$_POST['upd']."'";
                echo"<br>";
                if ($conn->query($sql) === TRUE) {
                  echo "Record updated successfully";
                } else {
                  echo "Error updating record: " . $conn->error;
                }

                }
            }
        }
        #(1) lenght of Sequance.
        function Length($conn)
        {  
          $seq=DB_Get_seq($conn);   
          return (strlen($seq));
        }
         
        #(2)GC content
        function GC_Content($conn)
         {
            $seq=DB_Get_seq($conn); 
           
           if (isset($_POST['GC'])){
             echo "GC Content :";
             $seq2=strtoupper($seq);
             $G=0;
             $C=0;
             for($i=0;$i<strlen($seq2);$i++)
             {
               if($seq2[$i]==="G"){$G=$G+1;}
               if($seq2[$i]==="C"){$C=$C+1;}
             }
             $GC=$G+$C;
             $GC_percentage=($GC/strlen($seq2)*100);
             return($GC_percentage);
            }
         }
        #(3)CpG Ratio
        function CpG_Ratio($conn)
         {  if (isset($_POST['CPG'])){
             echo "CpG Ratio :";
             $seq=DB_Get_seq($conn); 
             $seq2=strtoupper($seq);
             $G=0;
             $C=0;
             for($i=0;$i<strlen($seq2);$i++)
             {
               if($seq2[$i]==="G"){$G=$G+1;}
               if($seq2[$i]==="C"){$C=$C+1;}
             }
             $CpG=$G*$C;
             $CpG_Ratio=($CpG/strlen($seq2));
             return($CpG_Ratio);
           }
         }
        #(4)N Bases
        function N_bases($conn)
         {
      
            if (isset($_POST['n'])){
            echo " N_Bases: ";
            $seq=DB_Get_seq($conn); 
            $seq2=strtoupper($seq);
            $N=0;
             for($i=0;$i<strlen($seq2);$i++)
             {
               if($seq2[$i]==="N"){$N=$N+1;}
             }
             $N_Bases=($N/strlen($seq2)*100);
             return($N_Bases);
            }
         }
        
        #(5)Transcription
        function Transcription($conn)
         {
            if (isset($_POST['transcrip'])){
             print("we will show sample from our sequence After transcription ...<br>");
             $seq=DB_Get_seq($conn); 
             $seq2=strtoupper($seq);
             $Transcription=str_replace("T","U",$seq2);
             return($Transcription);
            }
         }
        #(6)Complement sequance
        function Complement_Seq($conn)
        {
         if (isset($_POST['Compseq'])){
            print("we will show sample from our sequence after complement seq...<br>");
            $seq=DB_Get_seq($conn); 
            $seq2=strtoupper($seq);
            $Complement="";
            for($i=0;$i<strlen($seq2);$i++)
            {
                if($seq2[$i]==="A")
                {
                $Complement=$Complement."T";
                }
                else if($seq2[$i]==="T")
                {
                    $Complement=$Complement."A";
                }
                else if($seq2[$i]==="C")
                {
                    $Complement=$Complement."G";
                }
                else if($seq2[$i]==="G")
                {
                    $Complement=$Complement."C";
                }  
            }
            return($Complement);

         }
        }
         #(7)Reverse SEquance
        function Reverse_Seq($conn){
          if (isset($_POST["revcompseq"])){
            print("we will show sample from our sequence after reverse seq...<br>");
            $seq=DB_Get_seq($conn); 
            $seq2=strtoupper($seq);
            $Reverse=strrev($seq2);
            return($Reverse);
          }
         }
        
        

?>

 </body>

</html>