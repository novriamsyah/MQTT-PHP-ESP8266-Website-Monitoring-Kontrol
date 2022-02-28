<?php
//koneksi ke file connection.php
  include 'connection.php';
  $sql = mysqli_query($dbconnect, "SELECT * FROM tb_iot");
  while ($row = mysqli_fetch_assoc($sql)) {

?>

<!-- mulai html -->
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- ini css toogle -->
    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
    
    <!-- script node js untuk menggunakan mqtt, jangan lupakan ini :v -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>


    <title>Mqtt-nodemcu</title>
   

  </head>
  <body>
      <div class="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container-fluid">
              <a class="navbar-brand" href="#">Mqtt-nodemcu</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Data</a>
                  </li>
                  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Tindakan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                  </li>
                </ul>
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Cari</button>
              </form>
          </div>
        </div>
      </nav>
    </div>
    </div>
    
    <div class="container">
        <h5 class="text-center mt-4">Halaman Monitoring <i>Temperature Sederhana using MQTT & Arduino</i></h5>
        <!-- <input data-id="{{$res->id}}" class="toggle-class" type="checkbox"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="ON" data-off="Off" data-style="slow"><br>
        <button onclick="ledState(1)">LED ON</button>
        <button onclick="ledState(0)">LED OFF</button><br> -->
        <hr>
        <br>
        <div class="row">
          <div class="col-sm-4">
            <div class="card" style="text-align: center;">
              <div class="card-header">
                Temperature
              </div>
              <div class="card-body">
                <h5 id="far" class="card-title" style="font-size: 42px;">0</h5><br>
                <p class="card-text">Data Realtime temperature Using Protocol MQTT & NODEMCU 8266</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card" style="text-align: center;">
              <div class="card-header">
                Temperature
              </div>
              <div class="card-body">
                <h5 id="cel" class="card-title" style="font-size: 42px;">0</h5><br>
                <p class="card-text">Data Realtime temperature Using Protocol MQTT & NODEMCU 8266</p>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card" style="text-align: center;">
              <div class="card-header">
                Temperature
              </div>
              <div class="card-body">
                <h5 id="hum" class="card-title" style="font-size: 42px;">0</h5><br>
                <p class="card-text">Data Realtime temperature Using Protocol MQTT & NODEMCU 8266</p>
              </div>
            </div>
          </div>
        </div>
        
        <div id="far"></div>
        <div id="cel"></div>
        <div id="hum"></div>
    </div>
      
<?php
  }
?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
<script type="text/javascript">
   
  // Create a client instance
  // ############# ATTENTION: Enter Your MQTT TLS Port and host######## Supports only TLS Port
    client = new Paho.MQTT.Client("driver.cloudmqtt.com", 38722,"web_" + parseInt(Math.random() * 100, 10));

  // set callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

 //############# ATTENTION: Enter Your MQTT user and password details ########  
 var options = {
    useSSL: true,
    userName: "vzltapih",
    password: "8UN9tiChH5CQ",
    onSuccess:onConnect,
    onFailure:doFail
  }

  // connect the client
  client.connect(options);

  // called when the client connects
  function onConnect() {
    // Once a connection has been made, make a subscription and send a message.
    console.log("onConnect");
    client.subscribe("test/dht11/temp_f");
    client.subscribe("test/dht11/temp_c");
    client.subscribe("test/dht11/humidity");

  }
  

  

  function doFail(e){
    console.log(e);
  }

  // called when the client loses its connection
  function onConnectionLost(responseObject) {
    if (responseObject.errorCode !== 0) {
      console.log("onConnectionLost:"+responseObject.errorMessage);
    }
  }

  // called when a message arrives
  function onMessageArrived(message) {
    if(message.destinationName == "test/dht11/temp_f") {

      // console.log("farenheit:"+message.payloadString);
      document.getElementById("far").innerHTML = message.payloadString + "° F";

    } else if(message.destinationName == "test/dht11/temp_c") {

      document.getElementById("cel").innerHTML = message.payloadString + "° C";
      // console.log("celsius:"+message.payloadString);

    } else if (message.destinationName == "test/dht11/humidity") {

      document.getElementById("hum").innerHTML = message.payloadString + "%";
      // console.log("humidity:"+message.payloadString);

    }
    // console.log("onMessageArrived:"+message.payloadString);
    // document.getElementById("cel").innerHTML = message.payloadString;
    // console.log(message);
  }
  

    </script >
    
  </body>
</html>