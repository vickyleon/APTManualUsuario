import random
import time

def anio():
	furier=random.randrange(5)
	estados={1:"batman", 2:"blink", 3:"1526", 4:"supersegura", 5:"ekisde",0:"batbat"}
	return (estados[furier])

def nombre():
	furier=random.randrange(20)
	estados={0:"JOAQUIN",1:"ISRAEL", 2:"ANGEL", 3:"PEDRO", 4:"ELIZABETH", 5:"ALAN", 6:"TEUCTZINTLI",7:"MAURICIO",
	 8:"JAVIER",9:"GERARDO",10:"ALY",11:"GABRIEL",12:"LUIS",13:"IVAN",14:"ERIKA",15:"ALAN",16:"AKETZALI",17:"ANTONIO",18:"ALEJANDRO",19:"BRANDO",20:"JESUS",21:"ARTURO" }
	return (estados[furier])	

def app():
	furier=random.randrange(20)
	estados={0:"AGUIRRE",1:"BARUCH", 2:"DIAZ", 3:"FERNANDEZ", 4:"GONZALEZ", 5:"LARA", 6:"LOPEZ",7:"MORANTE",
	 8:"OCHOA",9:"RONQUILLO",10:"RUIZ",11:"GABRIEL",12:"VAZQUEZ",13:"ZUNIGA",14:"BLANCO",15:"CARRASCO",16:"CASTRO",17:"CHACON",18:"FUENTES",19:"GARCIA",20:"GOMEZ",21:"GUZMAN" }
	return (estados[furier])

j=0;
k=input("Ingrese numero");
while j!=k:
	furier=random.randrange(5)
	print "update aspirante set contra=\"",
	print anio(),
	print"\"",
	print" where folio=",
	print j,
	print ";"

	j=j+1 

