//SDA -> D2
//SCK -> D5
//MOSI -> D7
//MISO -> D6
//GND -> GND
//RST -> D4
//3v -> 3v

#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include "MFRC522.h"

const char* ssid     = "BukanWifiGratisBro";
const char* password = "Apapasswordnya?";
String url = "http://192.168.100.6/Absen/absenrfid?uid=";

#define RST_PIN D4
#define SS_PIN  D2
MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

boolean reconnect() {
  digitalWrite(D0, HIGH);
  WiFi.begin(ssid, password);

  int retry = 51;
  while (WiFi.status() != WL_CONNECTED) {
    if (retry > 50) {
      Serial.println("");
      Serial.printf("Trying connect to %s", ssid);
      retry = 0;
    }
    delay(500);
    Serial.print(".");
    retry++;
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  digitalWrite(D0, LOW);
}

String logToServer(unsigned long cardUID) {

  Serial.printf("Send Request to %s%u\n", url.c_str(), cardUID);
  HTTPClient http;

  http.begin(url + cardUID); //HTTP
  int httpCode = http.GET();
  if (httpCode > 0) {
    Serial.printf("[HTTP] GET... code: %d\n", httpCode);

    if (httpCode == HTTP_CODE_TEMPORARY_REDIRECT) {

      Serial.print("berhasil");
  
        for (int i = 0; i < 1; i++) {
            Serial.println("HIGH");
            digitalWrite(D3, HIGH);
            digitalWrite(D0, HIGH);
            digitalWrite(D4, HIGH);
            delay(500);
            Serial.println("LOW");
            digitalWrite(D3, LOW);
            digitalWrite(D0, LOW);
            digitalWrite(D4, LOW);
            delay(500);
        }
    }
  } else {
    Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    Serial.print("gagal");
  }

  http.end();

}

void setup() {
  pinMode(D0, OUTPUT);
  pinMode(D1, OUTPUT);
  pinMode(D3, OUTPUT);
  Serial.begin(115200);
  Serial.println("");
  delay(1000);

  reconnect();

  SPI.begin();        // Init SPI bus
  mfrc522.PCD_Init(); // Init MFRC522 card

  //If you set Antenna Gain to Max it will increase reading distance
  mfrc522.PCD_SetAntennaGain(mfrc522.RxGain_max);
}

unsigned long getCardUID() {
  if ( !mfrc522.PICC_ReadCardSerial()) { //Since a PICC placed get Serial and continue
    return -1;
  }
  unsigned long hex_num;
  hex_num =  mfrc522.uid.uidByte[0] << 24;
  hex_num += mfrc522.uid.uidByte[1] << 16;
  hex_num += mfrc522.uid.uidByte[2] <<  8;
  hex_num += mfrc522.uid.uidByte[3];
  mfrc522.PICC_HaltA(); // Stop reading
  return hex_num;
}

int wait = 51;

void loop() {
  if (WiFi.status() != WL_CONNECTED)
    reconnect();

  if (wait > 50) {
    Serial.println("");
    Serial.print("Wait for new Card");
    wait = 0;
  }

  Serial.print(".");

  wait++;

  if (wait % 2 == 0)
    digitalWrite(D0, HIGH);
  else
    digitalWrite(D0, LOW);

  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    delay(100);
    return;
  }

  unsigned long cardUID = getCardUID();

  for (int i = 0; i < 3; i++) {
    digitalWrite(D0, HIGH);
    delay(100);
    digitalWrite(D0, LOW);
    delay(100);
  }
  if (cardUID == -1) {
    Serial.println("Failed to get UID");
    return;
  }

  Serial.printf("\nCard UID is %u\n", cardUID);
  for (int i = 0; i < 3; i++) {
    digitalWrite(D1, HIGH);
    delay(250);
    digitalWrite(D1, LOW);
    delay(250);
  }
  logToServer(cardUID);

  wait = 51;
}
