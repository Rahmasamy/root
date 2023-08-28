   
   <html>
   
   <head> 
     <title>LOG-IN</title>

   </head>
   
   <body>
    <form action="project3.php?page=servises" method=post name="form1" onsubmit="return validate() & required_email()">
        <div class=log>
        <label for="name">Name</label>
        <input type="text" id="name" name="fname" > 
                
        <label for="mail">mail</label>
        <input type="email" id="mail"  placeholder="Enter UserName or e-mail" name="fname" > 
                
        <label for="pass">Password</label>
        <input type="password" id="pass"  name="fname" > <br><br>
                
        <input type="submit" value="Submit" name="login" > 
            <!---<button type="submit" class="sub-btn">Sub </button> --->
        </div>
        
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
            else { #echo "Connected successfully";
                DB_user_insert_form($conn);
            }
            function DB_user_insert_form($conn){
                
                if (isset($_POST['login'])){
                    echo "insert new value from form<br>";
                    $name=$_POST['name'];
                    $id=$_POST['id'];
                    $email=$_POST['email'];
                    $pass=$_POST['password'];
                    
                    
                    
    
                    if (!(empty($name)&empty($gender)&empty($email)&empty($pass))){
                        $sql="INSERT INTO user (name,id,password,gmail) VALUES ('$name','$id','$pass','$email')";
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
        
        ?>
        <script src="pjs.js"> </script>
    </body>
    </html>
