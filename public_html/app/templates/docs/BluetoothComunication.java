package bluetoothled;

import javax.microedition.midlet.*;
import javax.microedition.lcdui.*;
import javax.bluetooth.*;
import java.io.*;
import javax.microedition.io.*;


public class BluetoothComunication extends MIDlet implements CommandListener, DiscoveryListener {

    private Display display;
    private Command conectar, desconectar, ok, comenzar,salir;
    private Form bienvenida;
    private List comandos;
    private StreamConnection con;
    private OutputStream outs;
    private InputStream ins;
    private LocalDevice localDevice = null;
    private DiscoveryAgent discoveryAgent = null;
    private ServiceRecord[] serviciosEncontrados = null;
    private String URL = "btspp://201402181704:1;authenticate=false;encrypt=false;master=false";


    public void startApp() {
        display = Display.getDisplay(this);
        conectar = new Command("Conectar", Command.ITEM, 1);
        desconectar = new Command("Desconectar", Command.ITEM, 1);
        ok = new Command("OK", Command.OK, 1);
        comenzar = new Command("Comenzar", Command.OK, 1);
        salir = new Command("Salir", Command.EXIT, 1);

        bienvenida = new Form("Bienvenido");
        comandos = new List("Escoja una accion", List.EXCLUSIVE);

        bienvenida.addCommand(comenzar);
        bienvenida.setCommandListener(this);

        comandos.addCommand(conectar);
        comandos.addCommand(ok);
        comandos.addCommand(desconectar);
        comandos.append("Encender LED", null);
        comandos.append("Apagar LED", null);
        comandos.setCommandListener(this);

        display.setCurrent(bienvenida);
    }


    public void commandAction(Command c, Displayable d) {
        if (c == comenzar){
            comenzar();
        }  else if(c == salir){
              destroyApp(false);
              notifyDestroyed();
        } else if (c == ok){
            enviar();
        } else if(c == conectar){
            conectar();
        } else if(c == desconectar){
            desconectar();
        }
    }


     public void deviceDiscovered(RemoteDevice remoteDevice, DeviceClass deviceClass) {



     }


     public void inquiryCompleted(int discType) {

     }

    public void servicesDiscovered(int transID, ServiceRecord[] servRecord) {

    }

    public void serviceSearchCompleted(int transID, int respCode) {

    }

    public void pauseApp() {
    }

    public void destroyApp(boolean unconditional) {
    }

    private void comenzar() {
        try {
            localDevice = LocalDevice.getLocalDevice();
            localDevice.setDiscoverable(DiscoveryAgent.GIAC);
            Display.getDisplay(this).setCurrent(comandos);
        } catch (BluetoothStateException e) {
            e.printStackTrace();
            Alert alerta = new Alert("Error", "No se puede hacer uso de Bluetooth", null, AlertType.ERROR);
            alerta.setTimeout(Alert.FOREVER);
            Display.getDisplay(this).setCurrent(alerta);
        }
    }



    private  void conectar(){
        try{
            con = (StreamConnection) Connector.open(URL);
            outs = con.openOutputStream();
            ins = con.openInputStream();
        }
        catch(IOException e){
             mostrarAlarma(e, comandos, 3);
        }
    }

    private void desconectar() {
        try {
            ins.close();
            outs.close();
            con.close();
        } catch (IOException e) {
            mostrarAlarma(e, comandos, 4);
        }
    }

    private void enviar(){
        conectar();
       int i = comandos.getSelectedIndex();
       String comando_elegido = comandos.getString(i);
       if(comando_elegido == "Encender LED"){
           String greeting = "1";
           try {
           outs.write(greeting.getBytes());
           mostrarAlarma(null, comandos, 5);
           }
           catch(IOException e){
               mostrarAlarma(e, comandos,2);
           }
       }
       else{
           String greeting = "0";
           try {
           outs.write(greeting.getBytes());
           mostrarAlarma(null, comandos, 5);
           }
           catch(IOException e){
               mostrarAlarma(e, comandos,2);
           }

       }
       desconectar();


    }



    public void mostrarAlarma(Exception e, Screen s, int tipo) {
        Alert alerta = null;
        if (tipo == 0) {
            alerta = new Alert("Excepcion", "Se ha producido la excepcion " + e.getClass().getName(), null,
                    AlertType.ERROR);
        } else if (tipo == 1) {
            alerta = new Alert("Info", "Se completo la busqueda de servicios", null, AlertType.INFO);
        } else if (tipo == 2) {
            alerta = new Alert("ERROR", "No se pudo enviar", null, AlertType.ERROR);
        } else if (tipo == 3) {
            alerta = new Alert("ERROR", "No se pudo establecer conexion" + e.getClass().getName(), null, AlertType.ERROR);
        } else if (tipo == 4) {
            alerta = new Alert("ERROR", "No se pudo desconectar" , null, AlertType.INFO);
        }  else if (tipo == 5) {
            alerta = new Alert("INFO", "Se envio el comando" , null, AlertType.INFO);
        }
        alerta.setTimeout(Alert.FOREVER);
        display.setCurrent(alerta, s);
    }

}


