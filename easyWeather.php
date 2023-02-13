<?php
  TODO:
  //fix inline spaggeti code and implement a better UI

  if(array_key_exists('submit', $_GET)){
    if(!$_GET['city']){
      $error = "Sorry, your input field is empty!";
    }
    if($_GET['city']){
      $apiData = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".
      $_GET['city']."&appid=86f20e46bff464a57295b71aef8e86fb&units=metric");
      $weatherArray = json_decode($apiData, true);
      $weather_main = $weatherArray['weather']['0']['main'];
      $weather_id = $weatherArray['weather']['0']['id'];
      $city = "<b>City of " .$weatherArray['name']. "</b>";
      $weather = "<b>Weather Condition: </b>" .$weatherArray['weather']['0']['description'];
      $temp = "<b>Temperature: </b>" .$weatherArray['main']['temp'];
      $realFeel = "<b>Real Feel: </b>" .$weatherArray['main']['feels_like'];
      $humidity = "<b>Humidity: </b>" .$weatherArray['main']['humidity'];
    }
  }
?>

<!DOCTYPE html>
<html lang="eng">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css"
      integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/styles.css">

    <title>Easy Weather</title>

    
  </head>
  <body>
    <div class="container">
      <h1>Search Global Weather</h1>
      <form action="" method="GET">
        <p>
          <label for="city">Enter your City name</label>
        </p>
        <p>
          <input type="text" name="city" id="city" placeholder="City Name" />
        </p>
        <button type="submit" name="submit" class="btn btn-success">
          Search now
        </button>
        <div class="output">
          <?php
            if(isset($weather)){
              echo  $city;
              
              if($weather_main == 'Thunderstorm'){
                $img_url = 'assets/thunderstorm.jpg';
              }
              if( $weather_main == 'Drizzle' || $weather == 'Rain'){
                $img_url = 'assets/rainy.jpg';
              }
              if($weather_main == 'Snow'){
                $img_url = 'assets/snow.jpg';
              }
              //atmosphere main starts with 7xx id
              if(preg_match("/^[7]\d\d$/", $weather_id)){
                $img_url = 'assets/mist.jpg';
              }
              if($weather_main == 'Clear'){
                $img_url = 'assets/clear_sky.jpg';
              }
              if($weather_main == 'Clouds'){
                $img_url = 'assets/cloudy.jpg';
              }
              echo '<div class="alert alert-success" role="alert">
              '. $weather .'
            </div>';  
            echo
              '<script type="text/JavaScript">
                document.body.style.backgroundImage="url('.$img_url.')";
                </script>
              ';

            }
            if(isset($temp)){
              echo '<div class="alert alert-success" role="alert">
              '. $temp .' &#x2103
            </div>';  
            }
            if(isset($realFeel)){
              echo '<div class="alert alert-success" role="alert">
              '. $realFeel .' &#x2103
            </div>';  
            }
            if(isset($humidity)){
              echo '<div class="alert alert-success" role="alert">
              '. $humidity .' %
            </div>';  
            }
            if(isset($error)){
              echo '<div class="alert alert-danger" role="alert">
              '. $error .'
            </div>';
            }
          ?>
        </div>
      </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    -->
  </body>
</html>
