
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CFC CHENNAI CHURCH</title>
<meta name="keywords" content="free css templates, church website, CSS, HTML" />
<meta name="description" content="Church website layout - free css template provided by templatemo.com" />
<link href="styles/templatemo_style.css" rel="stylesheet" type="text/css" />
<!-- Free CSS Templates from TemplateMo.com -->
</head>
<body>
<div id="templatemo_container">
	<div id="templatemo_header">
        <div id="out_mission_section">
        <?php 
        
        $servername = "bqmayq5x95g1sgr9.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $username = "cchnflwiwmucc12k";
        $password = "aom0shz4do0uf1bi";
        
        // Create connection
        $conn = new mysqli($servername, $username, $password);
        
        // Check connection
        if ($conn->connect_error) {
        	die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
        
        $sql = "SELECT id, firstname, lastname FROM MyGuests";
        $result = $conn->query($sql);
        echo "ssss".$result->num_rows;
        
        if ($result->num_rows > 0) {
        	// output data of each row
        	while($row = $result->fetch_assoc()) {
        		echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
        	}
        } else {
        	echo "0 resultxxxxs";
        }
        ?>
            <p>
           That all human beings are dead in sin and utterly lost and that the only way their sins can be forgiven is through repentance and through faith in the death and resurrection of our Lord Jesus Christ. <a href="subpage.php">more...</a>
            </p>
        </div>
        <div id="daily_bible_verse_section">
        	<p> Do to others as you would have them do to you. </p>
        	<div id="bible_verse">Luke 6:31</div>
        </div>
    
    </div> <!-- end of header -->
    
    <div id="templatemo_menu">
        <ul>
            <li><a href="index.php" class="current">Home</a></li>
            <li><a href="about-us.php" >About Us</a></li>
            <li><a href="media.php">Media</a></li>
            <li><a href="about-us.php">About Zac Poonen</a></li>  
            <li><a href="locate-us.php">Locate Us</a></li> 
                            
        </ul>  
    </div> <!-- end of menu -->
    
    <div id="templatemo_content">
    	<div id="templatemo_left">
        	<div id="templatemo_news_section">
            	<h1>Our Meetings</h1>
                 <div class="templatemo_news_box">
                    <h2>CFC -Thirumullaivoyal</h2>
                    <h3>Sunday : 10.30 AM - 1.00 PM</h3>
                    <p>
                    For Directions
    <a href="locate-us.php">[Click Here]</a></p>
				</div>
                <div class="templatemo_news_box">
                    <h2>CFC -Tambaram</h2>
                    <h3>Sunday : 10.30 AM - 1.00 PM</h3>
					<h3>Thursday : 7.30 PM - 8.30 PM</h3>
					<p>
                    For Directions
    <a href="locate-us.php">[Click Here]</a></p>
				</div>
            </div>
           
        </div> <!-- end of left -->
        
        <div id="templatemo_right">
        
       	  <div class="right_col_section">
   	      <h1>What We believe</h1>
                <p><img src="images/templatemo_image_01.jpg" alt="church" />That all human beings are dead in sin and utterly lost and that the only way their sins can be forgiven is through repentance and through faith in the death and resurrection of our Lord Jesus Christ.</p>
                
              <p>That there is one God eternally existent in three Persons: Father, Son and Holy Spirit.</p>
            <p>In the regenerating work of the Holy Spirit, whereby a person is born again to be a child of God.</p>
</div>
            <div class="cleaner_with_height">&nbsp;</div>
            
            
            <div class="cleaner">&nbsp;</div>
        </div> <!-- end of right -->
    </div> <!-- end of content -->
    
    <div id="templatemo_footer">
    	Copyright © 2016 <a href="http://www.cfcchennai.herokuapp.com">The Church</a> 
    </div> <!-- end of footer -->
</div> <!-- end of container -->
</body>
</html>