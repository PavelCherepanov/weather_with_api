<?php
// $email = "fle43016@cuoly.com";

if ($_GET["city"]){

  $urlContent =  file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET["city"])."&appid=YOURAPI"); 

  $weatherArray = json_decode($urlContent, true);
  print_r($weatherArray);
  
  if ($weatherArray["cod"] == 200){
    $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";

    $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

    $weather .= "The temperature ".$tempInCelcius."&deg";

    $wind = $weatherArray['wind']['speed'];

    $weather .= " Wind speed is ".$wind."m/s.";
} else {
    $error .= "City not found.";
  }

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Weather</title>


  </head>
  <body>

    <style type="text/css">
      html { 
        background: url("background_image.jpg") no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }
      body{
        background: none;
      }

      .container{
        text-align: center;
        margin-top: 100px;
        width:  450px;
      }

      input{
        margin: 20px 0;
      }

      #weather{
        margin-top: 15px;
      }
    </style>
    <div class="container">
      <h1>What is The Weather?</h1>

      <form>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Enter the name of a city.</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="London, Moscow" value="<?php echo $_GET['city'];?>">
          
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div id="weather"><?
        if ($weather){
          echo '<div class="alert alert-success" role="alert">'
          . $weather .
'</div>';
        } else if ($error){
          echo '<div class="alert alert-danger" role="alert">'
          . $error .
'</div>';
        }

      ?></div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  </body>
</html>
