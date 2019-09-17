<?php

$weather = "";
    $error = "";
    
    if (array_key_exists('city', $_GET)) {
        
        $city = str_replace(' ', '', $_GET['city']);
        
        $file_headers = @get_headers("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        
        if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
    
            $error = "That city could not be found.";

        } else {
        
        $forecastPage = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
        
        $pageArray = explode('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">', $forecastPage);
            
        if (sizeof($pageArray) > 1) {
        
                $secondPageArray = explode('</span></span></span>', $pageArray[1]);
            
                if (sizeof($secondPageArray) > 1) {

                    $weather = $secondPageArray[0];
                    
                } else {
                    
                    $error = "That city could not be found.";
                    
                }
            
            } else {
            
                $error = "That city could not be found.";
            
            }
        
        }
        
    }


?>


<html>
    <head>
        <title>Welcome to ShoperStock</title>

        <!-- Bootstrap CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <!-- css link-->
        <link rel="stylesheet" type="text/css" href="style.css">
         <!-- Begin Mailchimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/horizontal-slim-10_7.css" rel="stylesheet" type="text/css">
      <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    </head>

<body>

<div class="container">
      
      <h1>What's The Weather?</h1>
      
      
      
      <form>
<fieldset class="form-group">
<label for="city">Enter the name of a city.</label>
<input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php 
                                                                                                       
                                                                                                       if (array_key_exists('city', $_GET)) {
                                                                                                       
                                                                                                       echo $_GET['city']; 
                                                                                                       
                                                                                                       }
                                                                                                       
                                                                                                       ?>">
</fieldset>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
  
      <div id="weather"><?php 
          
          if ($weather) {
              
              echo '<div class="alert alert-success" role="alert">
'.$weather.'
</div>';
              
          } else if ($error) {
              
              echo '<div class="alert alert-danger" role="alert">
'.$error.'
</div>';
              
          }
          
          ?></div>
  </div>


   

    
       

<!-- Bootstrap LINK-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>