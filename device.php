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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- ini css toogle -->
    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
    
    <!-- script node js untuk menggunakan mqtt, jangan lupakan ini :v -->
    <!-- <link href="node_modules/toastr/build/toastr.css" rel="stylesheet"/> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>


    <title>MQTT-ESP32</title>
    <style>
         body {
      font-family: 'Raleway', sans-serif;
      background-image: url('asset/img/bgdata.png');
      background-position: bottom left;
      background-repeat: no-repeat;
      background-size: 60 vmax;
    }
       /* .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }    */
       footer {
         margin-top: 80px;
       } 
    </style>

  </head>
  <body>

      
  <div class="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container-fluid">
              <a class="navbar-brand" href="#">MQTT-ESP8266</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="chart.php">Chart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Kontrol</a>
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
                <button class="btn btn-success" type="submit">Cari</button>
              </form>
          </div>
        </div>
      </nav>
    </div>
    </div>
    <br>

    <div class="container">
        <h5 class="text-center mt-4" style="font-weight: bold;">Website Kontrol <i>Relay & LED Sederhana using MQTT</i></h5>
        <!-- <input data-id="{{$res->id}}" class="toggle-class" type="checkbox"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="ON" data-off="Off" data-style="slow"><br>
        <button onclick="ledState(1)">LED ON</button>
        <button onclick="ledState(0)">LED OFF</button><br> -->
        <hr>
        <div class="row">
            <div class="col-6">
                <div class="card text-center mt-4">
                  <div class="card-header">
                    Channel 1
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Channel 1 - LED</h5>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <a onclick="ledState(1)" href="aksi.php?channel=1&state=1" class="btn btn-success" id="idup">ON</a>
                    <a onclick="ledState(0)" href="aksi.php?channel=1&state=0" class="btn btn-danger">OFF</a>
                    <h6 class="card-title mt-3"> Status : <b>
                          <?php 
                          if($row['ch1'] == '0'){
                            $state = "Off";
                          }else{
                            $state = "On";
                           }
                          echo $state;
                          ?>
                          </b>
                    </h6>
                  </div>
                <div class="card-footer text-muted"></div>
                 </div>
            </div>
            <div class="col-6">
              <div class="card text-center mt-4">
                <div class="card-header">
                  Channel 2
                </div>
                  <div class="card-body">
                    <h5 class="card-title">Channel 2 - LED</h5>
                    <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                    <a onclick="ledState2(1)" href="aksi.php?channel=2&state=1" class="btn btn-success">ON</a>
                    <a onclick="ledState2(0)" href="aksi.php?channel=2&state=0" class="btn btn-danger">OFF</a>
                    <h6 class="card-title mt-3">Status : <b>
                    <?php 
                          if($row['ch2'] == '0'){
                            $state = "Off";
                          }else{
                            $state = "On";
                          }
                          echo $state;
                          ?>
                        </b>
                    </h6>
                  </div>
                  <div class="card-footer text-muted"></div>
                </div>
              </div>
      
          <!-- Force next columns to break to new line -->
          <div class="w-100 d-none d-md-block"></div>
          
              <div class="col-6">
                <div class="card text-center mt-4">
                  <div class="card-header">
                    Channel 3
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Channel 3 - LED</h5>
                    <a onclick="ledState3(1)" href="aksi.php?channel=3&state=1" class="btn btn-success">ON</a>
                    <a onclick="ledState3(0)" href="aksi.php?channel=3&state=0" class="btn btn-danger">OFF</a>
                    <h6 class="card-title mt-3">Status : <b>
                    <?php 
                          if($row['ch3'] == '0'){
                            $state = "Off";
                          }else{
                            $state = "On";
                          }
                          echo $state;
                          ?>
                        </b>
                    </h6>
                  </div>
                  <div class="card-footer text-muted"></div>
                </div>
              </div>
              <div class="col-6">
                <div class="card text-center mt-4">
                  <div class="card-header">
                    Channel 4
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Channel 4 - Relay</h5>
                    <a onclick="ledState4(1)" href="aksi.php?channel=4&state=1" class="btn btn-success">ON</a>
                    <a onclick="ledState4(0)" href="aksi.php?channel=4&state=0" class="btn btn-danger">OFF</a>
                    <h6 class="card-title mt-3">Status : <b>
                    <?php 
                          if($row['ch4'] == '0'){
                            $state = "Off";
                          }else{
                            $state = "On";
                          }
                          echo $state;
                    ?>
                    </b>
                    </h6>
                  </div>
                  <div class="card-footer text-muted"></div>
                </div>
              </div>
        </div>
    </div>
    <div class="container">
    <footer class="bg-dark text-center text-white">
              <!-- Grid container -->
              <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                  <!-- Facebook -->
                  <a class="btn btn-outline-light btn-floating m-1" href="https://facebook.com/novri.amsyah/" role="button" target="_blank"
                    ><i class="fab fa-facebook-f"></i
                  ></a>

                  <!-- Instagram -->
                  <a class="btn btn-outline-light btn-floating m-1" href="https://instagram.com/novri_amsyah26" role="button" target="_blank"
                    ><i class="fab fa-instagram"></i
                  ></a>

                  <!-- Linkedin -->
                  <a class="btn btn-outline-light btn-floating m-1" href="www.linkedin.com/in/novri-amsyah-4259341b0" role="button" target="_blank"
                    ><i class="fab fa-linkedin-in"></i
                  ></a>

                  <!-- Github -->
                  <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/novriamsyah" role="button" target="_blank"
                    ><i class="fab fa-github"></i
                  ></a>

                  <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/novriamsyah" role="button" target="_blank"
                    ><i class="fab fa-youtube"></i
                  ></a>
                </section>
                <!-- Section: Social media -->
              </div>
              <!-- Grid container -->

              <!-- Copyright -->
              <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2021 Copyright:
                <a class="text-white" href="#">novriamsyah</a>
              </div>
              <!-- Copyright -->
            </footer>
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
    <!-- <script src="node_modules/toastr/toastr.js"></script> -->
    <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->

    <!-- <script>
      $(document).ready(function(){
        $("#idup").click(function(){
          toastr.success('Sukses Merubah', 'perhatikan status tombol')
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 1000;
          toastr.options.closeEasing = 'swing';
        });
      });

     

    </script> -->

    <script type="text/javascript">
   
  // Create a client instance
  // ############# ATTENTION: Enter Your MQTT TLS Port and host######## Supports only TLS Port
  client = new Paho.MQTT.Client("driver.cloudmqtt.com", 38708,"web_" + parseInt(Math.random() * 100, 10));

  // set callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

 //############# ATTENTION: Enter Your MQTT user and password details ########  
 var options = {
    useSSL: true,
    userName: "pqsukkgy",
    password: "HEYnIYLmbxVb",
    onSuccess:onConnect,
    onFailure:doFail
  }

  // connect the client
  client.connect(options);

  // called when the client connects
  function onConnect() {
    // Once a connection has been made, make a subscription and send a message.
    console.log("onConnect");

    client.subscribe("esp/test");
    message = new Paho.MQTT.Message("Data Berhasil");
    message.destinationName = "esp/test";
    client.send(message);
  }

  function ledState(state) {
    if(state == 1) { message = new Paho.MQTT.Message("#on"); }
    if(state == 0) { message = new Paho.MQTT.Message("#off"); }
    message.destinationName = "esp/test";
    client.send(message);
  }

  function ledState2(state) {
    if(state == 1) { message = new Paho.MQTT.Message("#ch2On"); }
    if(state == 0) { message = new Paho.MQTT.Message("#ch2Off"); }
    message.destinationName = "esp/test";
    client.send(message);
  }

  function ledState3(state) {
    if(state == 1) { message = new Paho.MQTT.Message("#ch3On"); }
    if(state == 0) { message = new Paho.MQTT.Message("#ch3Off"); }
    message.destinationName = "esp/test";
    client.send(message);
  }

  function ledState4(state) {
    if(state == 1) { message = new Paho.MQTT.Message("#ch4On"); }
    if(state == 0) { message = new Paho.MQTT.Message("#ch4Off"); }
    message.destinationName = "esp/test";
    client.send(message);
  }

  

  // $(function() {
  //     $('.toggle-class').change(function(panel) {
  //         var panel = $(this).prop('checked') == true ? 1 : 0; 
  //         console.log(panel);
  //         // var id = $(this).data('id'); 
  //         if(panel == 1) { message = new Paho.MQTT.Message("#on"); }
  //         if(panel == 0) { message = new Paho.MQTT.Message("#off"); }
  //         message.destinationName = "esp/test";
  //         client.send(message);
  //         console.log(message);
          
  //     })
  //   });

  

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
    
    console.log("onMessageArrived:"+message.payloadString);
  }
</script>
    
  </body>
</html>