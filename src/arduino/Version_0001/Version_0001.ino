#include <WiFi.h>
#include <HTTPClient.h>

// Ultrasonic Sensor Pin Definitions
const int trigPin = 0;
const int echoPin = 2;

long duration;
float distance;

// Wi-Fi credentials
const char* ssid = "Tenda_FBBD18";
const char* password = "12341234";

// Server URL
const char* serverName = "http://192.168.1.110/Automated%20Irrigation%20System/src/php/insert.php";

// Timing settings
unsigned long lastTime = 0;
unsigned long timerDelay = 10000; // Send data every 10 seconds

// Wi-Fi timeout duration
const unsigned long wifiTimeout = 10000;

void setup() {
  Serial.begin(115200);

  // Initialize ultrasonic sensor pins
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  // Connect to Wi-Fi
  connectToWiFi();
}

void loop() {
  // Reconnect to Wi-Fi if disconnected
  if (WiFi.status() != WL_CONNECTED) {
    connectToWiFi();
  }

  // Send data at defined intervals
  if ((millis() - lastTime) > timerDelay) {
    lastTime = millis();

    // Get distance from the ultrasonic sensor
    distance = getUltrasonicDistance();

    // Send data if Wi-Fi is connected
    if (WiFi.status() == WL_CONNECTED) {
      sendSensorData(distance);
    }
  }
}

// Function to connect to Wi-Fi
void connectToWiFi() {
  Serial.println("Connecting to WiFi...");
  WiFi.begin(ssid, password);

  unsigned long startTime = millis();

  // Wait for connection or timeout
  while (WiFi.status() != WL_CONNECTED && (millis() - startTime) < wifiTimeout) {
    delay(500);
    Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED) {
    Serial.println("\nConnected to WiFi");
  } else {
    Serial.println("\nFailed to connect to WiFi");
  }
}

// Function to calculate distance using the ultrasonic sensor
float getUltrasonicDistance() {
  // Clears the trigPin
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);

  // Sets the trigPin HIGH for 10 microseconds
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  // Reads the echoPin and calculates the distance
  duration = pulseIn(echoPin, HIGH);
  distance = duration * 0.034 / 2;

  Serial.print("Distance: ");
  Serial.print(distance);
  Serial.println(" cm");

  return distance;
}

// Function to send the sensor data to the server
void sendSensorData(float distance) {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Construct the server path with distance data
    String serverPath = String(serverName) + "?distance=" + String(distance, 2) + "&id=1";  // Add the id parameter


    http.begin(serverPath.c_str()); // Initiate HTTP connection
    int httpResponseCode = http.GET(); // Send HTTP GET request

    // Check the response from the server
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
      Serial.println("Server response: " + response);
    } else {
      Serial.print("Error on sending GET request: ");
      Serial.println(httpResponseCode);
    }

    http.end(); // Free resources
  } else {
    Serial.println("WiFi not connected. Data not sent.");
  }
}
