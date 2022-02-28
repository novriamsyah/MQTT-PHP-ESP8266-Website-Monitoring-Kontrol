<!DOCTYPE html>
<html>
<head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
</head>
<body>

<p>Click the button to turn on/off on Board Blue LED</p>

<button onclick="ledState(1)">LED ON</button>
<button onclick="ledState(0)">LED OFF</button><br>
<a href="https://circuits4you.com">Circuits4you.com</a>
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
    client.subscribe("esp/test");
    message = new Paho.MQTT.Message("Hello CloudMQTT");
    message.destinationName = "esp/test";
    client.send(message);
  }

  function ledState(state) {
    if(state == 1) { message = new Paho.MQTT.Message("#on"); }
    if(state == 0) { message = new Paho.MQTT.Message("#off"); }
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
    console.log("onMessageArrived:"+message.payloadString);
  }
</script>

</body>
</html>