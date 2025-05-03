/**
 * IOT based projects with Arduino: sensor data online with ESP32!  
 * 
 * MyCircuits
 * Date: 20/08/22
 * 
 * Transmits sensor data to an online server
 * 
 * Requiered boards:
 * 
 *  - https://github.com/espressif/arduino-esp32
 * 
 * Required libraries:
 * 
 *  - http://www.airspayce.com/mikem/arduino/RadioHead/ (v1.59)
 *  - https://github.com/adafruit/Adafruit_Sensor
 *  - https://github.com/adafruit/Adafruit_BME280_Library
 *  - https://github.com/adafruit/Adafruit_AHTX0
 *  
 *  Board type: ESP32
 *  
 *  Code based on BasicHTTPClient.ino for ESP32 boards
 **/
 

/* LIBRARIES ESP32-WIFI-HTTP comunication*/
#include <WiFi.h>
#include <WiFiMulti.h>
#include <HTTPClient.h>
 
int sleeptime = 5; //Time between reading in seconds;

const char* ssid   = "Wokwi-GUEST";   
const char* password  = "";       
 
void setup() {
Serial.begin(115200);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print("."); 
  }
 
  Serial.println("");
  Serial.println("WiFi connected!");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
 
}

void loop() {
  
 
  /* Prepare URL */
  String url = "https://esp32.webtimism.de/api.php?licht=on";
  Serial.println(url);
  
  /* Start Post */
  HTTPClient http;
  
  if((WiFi.status() == WL_CONNECTED)) // wait for WiFi connection
  {
    Serial.print("[HTTP] begin...\n");
    http.begin(url); //HTTP send

    //Get Answer (Not mandatory)
    
    int httpCode = http.GET();//Start connection and get HTTP respond
    
    // httpCode will be negative on error
    if(httpCode > 0) 
    {
      // HTTP header has been send and Server response header has been handled
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);
  
      // file found at server
      if(httpCode == HTTP_CODE_OK) 
      {
          String payload = http.getString();
          Serial.println(payload);
      }
    }
    else 
    {
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    //End of -Get Answer- (Not Mandatory)
  
    /* End Post */
    http.end(); 
  }

  /* Delay - timer */
  delay(sleeptime*1000);
  //Check RepeatTimer.ino example (File -> Examples -> ESP32 -> DeepSleep) for deep sleep and wake-up of the sensor

}
