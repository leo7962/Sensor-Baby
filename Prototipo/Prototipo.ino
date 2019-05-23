#include <ESP8266WiFi.h>
#include <WiFiClient.h>
//#include <WiFiClientSecure.h>

//-------------------VARIABLES GLOBALES--------------------------

const int inputPin = 16;
int sensorPin = 13;
int value = 0;
int contconexion = 0;
const char *ssid = "c.sandovall";
const char *password = "TiquiTiqui2019";
char host[48];
String strhost = "192.168.43.8";
String strurl = "/parcial/enviardatos.php";
String chipid = "";

//-------Función para Enviar Datos a la Base de Datos SQL--------

String enviardatos(String datos) {
  String linea = "error";
  WiFiClient client;
  strhost.toCharArray(host, 49);

  if (!client.connect(host, 80)) {
    Serial.println("Fallo de conexion");
    return linea;
  }
  Serial.println("***************");
Serial.println(String("POST ") + strurl + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Accept: */*" + "*\r\n" +
               "Content-Length: " + datos.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
               "\r\n" + datos);
Serial.println("***************");
  client.print(String("POST ") + strurl + " HTTP/1.1" + "\r\n" +
               "Host: " + strhost + "\r\n" +
               "Accept: */*" + "*\r\n" +
               "Content-Length: " + datos.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
               "\r\n" + datos);
  delay(10);
  Serial.print("Enviando datos a SQL...");

  unsigned long timeout = millis();

  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente fuera de tiempo!");
      client.stop();
      return linea;
    }
  }

  // Lee todas las lineas que recibe del servidro y las imprime por la terminal serial

  while (client.available()) {
    linea = client.readStringUntil('\r');
  }

  Serial.println(linea);
  return linea;
}

//-------- Fin de Variables------------------

void setup() {
  Serial.begin(115200);
  pinMode(inputPin, INPUT);
  pinMode(sensorPin, OUTPUT);
  digitalWrite(sensorPin, LOW);

  // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) { //Cuenta hasta 50 si no se puede conectar lo cancela
    Serial.print(".");
    delay(500);
  }
}

int c = 0;

void loop() {
  value = digitalRead(inputPin); //Lectura digital del sensor
  c++;
  //Mandar mensaje a puerto serie en funcion del valor leido

  if (value == LOW) {
    Serial.println ("Encendido :");
  }
  else {
    enviardatos("mensaje= No está el bebé");
    Serial.println("Apagado" );
  }
  delay(10000);
  digitalWrite(sensorPin, HIGH);
}
