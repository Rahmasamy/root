<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project</title>
    <link rel="stylesheet" href="fpstyle.css">
    <link rel="stylesheet" href="pstyle.css">
    
  
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h0 class="logo">TERT</h0>
<img src="https://cdn-icons-png.flaticon.com/128/3284/3284612.png" width="70" height="70" >
            </div>

            <div class="menu">
                <ul>
                  <li><a href="project3.php?page=LogIn">login</a></li>
                    <li><a href="project3.php?page=ome">HOME</a></li>
                    <li><a href="project3.php?page=about">ABOUT</a></li>
                    <li><a href="project3.php?page=charts">Charts</a></li>
                    <li><a href="project3.php?page=Format">Formats</a></li>
                   <li><a href="project3.php?page=servises">SERVICE</a></li>
                   <li><a href="project3.php?page=Related">Related</a></li>
                   
                
                </ul>
            </div>


        </div> 
        

        <div class="content">
        <?php
                  $page=$_GET['page'].'.php';
                  include_once($page);
                  ?>
                

                </div>
                    </div>
                </div>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>