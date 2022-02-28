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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- ini css toogle -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">

    <!-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
    
    <!-- script node js untuk menggunakan mqtt, jangan lupakan ini :v -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>



    <title>MQTT-ESP8266</title>
    <style>
      body {
      font-family: 'Raleway', sans-serif;
      background-image: url('asset/img/bgdata.png');
      background-position: bottom left;
      background-repeat: no-repeat;
      background-size: 60 vmax;
      /* z-index: -10; */
    }
       /* .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }   */
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
                    <a class="nav-link active" class="nav-link" href="chart.php">Chart</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="device.php">Kontrol</a>
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
<br><br>
    <div class="container">
        <h4 class="text-center mt-4" style="font-weight: bold;">Halaman Ploting <i> Data Temperature</i> Menggunakan MQTT & ESP8266</h4>
        <!-- <input data-id="{{$res->id}}" class="toggle-class" type="checkbox"  data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="ON" data-off="Off" data-style="slow"><br>
        <button onclick="ledState(1)">LED ON</button>
        <button onclick="ledState(0)">LED OFF</button><br> -->
        <hr>
        <div class="row">
        <!-- <div class="col-8">
        <div class="card">
            <h5 class="card-header" style="text-align: center;">Featured</h5>
            <div class="card-body">
                <h5 class="card-title" style="text-align: center;">Special title treatment</h5>
                <canvas id="myChart"  style="width:100%; height:400px;"></canvas>
            </div>
        </div>
        </div> -->
                <div class="col-sm-6">
                <div class="card">
                    <h5 class="card-header" style="text-align: center;">Farenheit</h5>
                    <div class="card-body">
                        <div id="highcat" style="width:100%; height:400px;"></div>
                    </div>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="card">
                    <h5 class="card-header" style="text-align: center;">Celcius</h5>
                    <div class="card-body">
                        <div id="highcat1" style="width:100%; height:400px;"></div>
                    </div>
                </div>
                </div>
        </div><br>
        <div class="row">
            <div class="col-12">
            <div class="card">
                    <h5 class="card-header" style="text-align: center;">Humidity</h5>
                    <div class="card-body">
                        <div id="highcat2" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- <div id="far"></div>
        <div id="cel"></div>
        <div id="hum"></div> -->
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
    <!-- <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="chartjs/assets/dist/chart.js"></script>


 <script type="text/javascript">
 var MQTTbroker = 'cloudmqtt.com';
 var MQTTport = 38894;
 var MQTTsubTopic = 'test/dht11/temp_f';
 var MQTTsubTopic1 = 'test/dht11/temp_c';
 var MQTTsubTopic2 = 'test/dht11/humi';
 var chart;
 var dataTopics = new Array();
 var chart1;
 var dataTopics1 = new Array();
 var chart2;
 var dataTopics2 = new Array();

// Create a client instance
  // ############# ATTENTION: Enter Your MQTT TLS Port and host######## Supports only TLS Port
  client = new Paho.MQTT.Client("driver.cloudmqtt.com", 38708,"web_" + parseInt(Math.random() * 100, 10));
    // client = new Paho.MQTT.Client("13.76.228.167", 8083,"web_" + parseInt(Math.random() * 100, 10));

  // set callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

 //############# ATTENTION: Enter Your MQTT user and password details ########  
 var options = {
    timeout: 5,
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

    client.subscribe("test/dht11/temp_f");
    client.subscribe("test/dht11/temp_c");
    client.subscribe("test/dht11/humidity");

    client.subscribe("esp/test");
    message = new Paho.MQTT.Message("Data Berhasil");
    message.destinationName = "esp/test";
    client.send(message);
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

        if(dataTopics.indexOf(message.destinationName) < 0){
            dataTopics.push(message.destinationName);
            var y = dataTopics.indexOf(message.destinationName);
            // console.log(y);

            var newseries = {
                id: y,
                name: message.destinationName,
                data: []
            };
            chart.addSeries(newseries);
        };

        var y = dataTopics.indexOf(message.destinationName);
        var myEpoch = new Date().getTime();
       
        var thenum = message.payloadString.replace( /^\D+/g, '');
        var plotMqtt = [myEpoch, Number(thenum)];
        // console.log(plotMqtt);
        if(isNumber(thenum)){
            console.log("yes number")
            plot(plotMqtt, y);
        }


    // console.log("farenheit:"+message.payloadString);
    // document.getElementById("far").innerHTML = message.payloadString + "° F";



    } else if(message.destinationName == "test/dht11/temp_c") {

        if(dataTopics1.indexOf(message.destinationName) < 0){
            dataTopics1.push(message.destinationName);
            var z = dataTopics1.indexOf(message.destinationName);
            // console.log(y);

            var newseries = {
                id: z,
                color: 'rgba(255, 0, 255, 0.5)',
                name: message.destinationName,
                data: []
            };
            chart1.addSeries(newseries);
        };

        var z = dataTopics1.indexOf(message.destinationName);
        var myEpoch1 = new Date().getTime();
       
        var thenum1 = message.payloadString.replace( /^\D+/g, '');
        var plotMqtt1 = [myEpoch1, Number(thenum1)];
        // console.log(plotMqtt1);
        if(isNumber(thenum1)){
            console.log("yes nubul")
            plot1(plotMqtt1, z);
        }

}  else if (message.destinationName == "test/dht11/humidity") {
    if(dataTopics2.indexOf(message.destinationName) < 0){
            dataTopics2.push(message.destinationName);
            var ez = dataTopics2.indexOf(message.destinationName);
            // console.log(y);

            var newseries = {
                id: ez,
                name: message.destinationName,
                data: []
            };
            chart2.addSeries(newseries);
        };

        var ez = dataTopics2.indexOf(message.destinationName);
        var myEpoch2 = new Date().getTime();
        // console.log(myEpoch2);
       
        var thenum2 = message.payloadString.replace( /^\D+/g, '');
        var plotMqtt2 = [myEpoch2, Number(thenum2)];
        // console.log(plotMqtt2);
        if(isNumber(thenum2)){
            console.log("yes nubb")
            plot2(plotMqtt2, ez);
        }

}
  }
  function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
  }
//   function init() {
//       //i find i have to set this to false if i have trouble with timezones.
//       Highcharts.setOptions({
//         global: {
//           useUTC: false
//         }
//       });
//       // Connect to MQTT broker
//       client.connect(options);
//     };
    function plot(point, chartno) {
        // console.log(point);

            var series = chart.series[0],
                shift = series.data.length > 10; // shift if the series is
                                                 // longer than 20
            // add the point
            chart.series[chartno].addPoint(point, true, shift);
    };
    function plot1(point, chartno) {
        // console.log(point);

            var series = chart1.series[0],
                shift = series.data.length > 10; // shift if the series is
                                                 // longer than 20
            // add the point
            chart1.series[chartno].addPoint(point, true, shift);
    };
    function plot2(point, chartno) {
        // console.log(point);

            var series = chart2.series[0],
                shift = series.data.length > 20; // shift if the series is
                                                 // longer than 20
            // add the point
            chart2.series[chartno].addPoint(point, true, shift);
    };
 </script>
<script type="text/javascript">
// var ctx = document.getElementById('myChart');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['jan', 'feb', 'mar', 'apr', 'mei', 'jul', 'jun', 'agst', 'sep', 'okt', 'nov', 'des'],
//         datasets: [{
//             labels: 'Red',
//             data: [12, 19, 3, 5, 2, 3, 7, 3, 9, 7, 4, 20],
//             backgroundColor: 'rgba(255, 99, 132, 0.2)',
//             borderWidth: 4,
//             fill: true,
//             borderColor: 'rgb(75, 192, 192)',
//             tension: 0.1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

$(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'highcat',
                defaultSeriesType: 'spline',
            },
            title: {
                text: 'Plotting Live data from a MQTT'
            },
            subtitle: {
                text: 'broker: ' + MQTTbroker + ' | port: ' + MQTTport + ' | topic : ' + MQTTsubTopic
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Value',
                    margin: 50
                }
            },
            series: []
        });
    });
    $(document).ready(function() {
        chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'highcat1',
                defaultSeriesType: 'spline'
            },
            title: {
                text: 'Plotting Live data from a MQTT'
            },
            subtitle: {
                text: 'broker: ' + MQTTbroker + ' | port: ' + MQTTport + ' | topic : ' + MQTTsubTopic1
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Value',
                    margin: 80
                }
            },
            series: []
        });
    });
    $(document).ready(function() {
        chart2 = new Highcharts.Chart({
            chart: {
                renderTo: 'highcat2',
                defaultSeriesType: 'area'
            },
            title: {
                text: 'Plotting Live data from a MQTT'
            },
            subtitle: {
                text: 'broker: ' + MQTTbroker + ' | port: ' + MQTTport + ' | topic : ' + MQTTsubTopic2
            },
            xAxis: {
                type: 'datetime',
                tickPixelInterval: 150,
                maxZoom: 20 * 1000
            },
            yAxis: {
                minPadding: 0.2,
                maxPadding: 0.2,
                title: {
                    text: 'Value',
                    margin: 80
                }
            },
            series: []
        });
    });
</script>    
  </body>
</html>