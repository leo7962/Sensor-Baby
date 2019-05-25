#include <ESP8266WiFi.h>
#include <WiFiClient.h>
//#include <WiFiClientSecure.h>

//-------------------VARIABLES GLOBALES--------------------------

const int inputPin = 16;
int sensorPin = 13;
int value = 0;
int value2 = 0;
int contconexion = 0;
const char *ssid = "c.sandovall";
const char *password = "TiquiTiqui2019";
char host[48];
String strhost = "192.168.43.8";
String strurl = "/parcial/enviardatos.php";
String chipid = "";
WiFiServer server(80);

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

  server.begin();
  Serial.println("Servidor iniciado");

  // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) { //Cuenta hasta 50 si no se puede conectar lo cancela
    Serial.print(".");
    delay(500);
  }
}

int c = 0;

void loop() {
  // Compruebo si hay un cliente disponible (una petición)
  WiFiClient client = server.available();
  if (!client) {
    return; // En caso de no haber un cliente, no hago nada
  }

  // Espero hasta que el cliente realice una petición
  Serial.println("¡Nuevo cliente!");
  while (!client.available()) {
    delay(1);
  }

  // Leo la primera linea de la petición del cliente
  String request = client.readStringUntil('\r'); // Leo hasta retorno de carro
  Serial.println(request); //Imprimo la petición
  client.flush(); //Limpio el buffer

  // Interpreto lo que he recibido

  int value = digitalRead(sensorPin);



  
  if (request.indexOf("/LED=ON") != -1)  {
    digitalWrite(sensorPin, HIGH);
    value = HIGH;
  }
  if (request.indexOf("/LED=OFF") != -1)  {
    digitalWrite(sensorPin, LOW);
    value = LOW;
  }

  // Pongo ledPin al valor que ha solicitado el cliente en la petición

  // Devuelvo la respuesta al cliente -> Todo ha ido bien, el mensaje ha sido interpretado correctamente
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println(""); //  do not forget this one

  // A partir de aquí creo la página en raw HTML
  client.println("<!DOCTYPE HTML>");
  client.println("<meta http-equiv='refresh' content='2' />");
  client.println("<html>");

  client.print("El sensor esta:  ");

  if (value == HIGH) {
    client.print("encendido.");

    value2 = digitalRead(inputPin); //Lectura digital del sensor
    c++;
    //Mandar mensaje a puerto serie en funcion del valor 1410leido

    if (value2 == LOW ) {
      Serial.println ("Encendido :");
      client.println("<h1 style='color:red'>Si esta el bebe!</h1>");
    } else {
      enviardatos("mensaje= No está el bebé");
      Serial.println("Apagado" );
      client.println("<h1 style='color:red'>No esta el bebe!</h1>");
    }
  } else {
    client.print("apagado.");
  }

  client.println("<br><br>");
  client.println("<a href=\"/LED=ON\"\"><button>Encender </button></a>"); // Los botones con enlace
  client.println("<a href=\"/LED=OFF\"\"><button>Apagar </button></a><br />");
  client.println("</html>");

  delay(2000);
}
