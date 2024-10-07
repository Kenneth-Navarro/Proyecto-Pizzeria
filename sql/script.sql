CREATE TABLE `pizzeria`.`Cliente` (`Cedula` INT NOT NULL , `Nombre` VARCHAR(50) NOT NULL ,
 `PrimerApellido` VARCHAR(50) NOT NULL , `SegundoApellido` VARCHAR(50) NOT NULL , 
 `Direccion` VARCHAR(50) NOT NULL , `NumeroTelefono` INT NOT NULL , `Correo` 
 VARCHAR(50) NOT NULL , PRIMARY KEY (`Cedula`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Puesto` (`ID_Puesto` INT NOT NULL AUTO_INCREMENT , 
`NombrePuesto` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID_Puesto`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Empleado` (`Cedula` INT(9) NOT NULL , `Nombre`
 VARCHAR(50) NOT NULL , `PrimerApellido` VARCHAR(50) NOT NULL , `SegundoApellido` 
 VARCHAR(50) NOT NULL , `Edad` INT(2) NOT NULL , `ID_Puesto` INT NOT NULL , `Salario` 
 DECIMAL(10,2) NOT NULL , `FechaContratacion` DATE NOT NULL , `Direccion` VARCHAR(200) 
 NOT NULL , `Telefono` INT(11) NOT NULL, `Correo` VARCHAR(50) NOT NULL, PRIMARY KEY (`Cedula`), FOREIGN KEY (`ID_Puesto`) REFERENCES `Puesto`(`ID_Puesto`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Usuario` ( `Usuario` VARCHAR(16) NOT NULL , `Contrasena` VARCHAR(60) NOT NULL, `Rol` BOOLEAN NOT NULL, `Estado` BOOLEAN NOT NULL, `Id_Empleado` INT NOT NULL , PRIMARY KEY (`Usuario`), FOREIGN KEY(`Id_Empleado`) REFERENCES `Empleado`(`Cedula`) ) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Proveedor` (`ID_Proveedor` INT NOT NULL AUTO_INCREMENT , `Nombre` VARCHAR(50) NOT NULL , `Encargado` VARCHAR(50) NOT NULL , `Telefono` INT NOT NULL , `Correo` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID_Proveedor`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Tipo` (`ID_Tipo` INT NOT NULL AUTO_INCREMENT , `Nombre` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID_Tipo`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Metodo_pago` (`ID_Metodo` INT NOT NULL AUTO_INCREMENT , `Metodo` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID_Metodo`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Producto` (`ID_Producto` INT NOT NULL AUTO_INCREMENT, `Nombre` VARCHAR(50) NOT NULL , `Descripcion` VARCHAR(200) NOT NULL , `Precio` DECIMAL(10,2) NOT NULL , `ID_Tipo` INT NOT NULL , `ID_Proveedor` INT  , PRIMARY KEY (`ID_Producto`), FOREIGN KEY (`ID_Tipo`) REFERENCES `Tipo`(`ID_Tipo`), FOREIGN KEY (`ID_Proveedor`) REFERENCES `Proveedor`(`ID_Proveedor`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Estado` (`ID_Estado` INT NOT NULL AUTO_INCREMENT , `tipo` VARCHAR(50) NOT NULL , PRIMARY KEY (`ID_Estado`)) ENGINE = InnoDB;
CREATE TABLE `pizzeria`.`Pedido` (`ID_Pedido` INT NOT NULL AUTO_INCREMENT , `ID_Cliente` INT NOT NULL , `ID_Empleado` INT NOT NULL , `FechaHora` DATETIME NOT NULL , `ID_Estado` INT NOT NULL , PRIMARY KEY (`ID_Pedido`), FOREIGN KEY (`ID_Cliente`) REFERENCES `Cliente`(`Cedula`), FOREIGN KEY (`ID_Empleado`) REFERENCES `Empleado`(`Cedula`), FOREIGN KEY (`ID_Estado`) REFERENCES `Estado`(`ID_Estado`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Pago` (`ID_Pago` INT NOT NULL AUTO_INCREMENT , `ID_Pedido` INT NOT NULL , `Monto` DECIMAL(10,2) NOT NULL , `ID_Metodo` INT NOT NULL , PRIMARY KEY (`ID_Pago`), FOREIGN KEY (`ID_Pedido`) REFERENCES `Pedido`(`ID_Pedido`), FOREIGN KEY (`ID_Metodo`) REFERENCES `Metodo_pago`(`ID_Metodo`)) ENGINE = InnoDB;

CREATE TABLE `pizzeria`.`Pedido_producto` (`ID_Pedido` INT NOT NULL, `ID_Producto` INT NOT NULL , `cantidad` INT NOT NULL, FOREIGN KEY (`ID_Pedido`) REFERENCES `Pedido`(`ID_Pedido`), FOREIGN KEY (`ID_Producto`) REFERENCES `Producto`(`ID_Producto`)) ENGINE = InnoDB;



/*Se insertan los siguientes datos para las tablas de Tipo, Puesto y Estado*/


INSERT INTO `tipo`(`Nombre`) VALUES ('Comida'), ('Bebida');

INSERT INTO `estado`(`tipo`) VALUES ('Pendiente'),('En preparación'),('Entregado');

INSERT INTO `puesto`(`NombrePuesto`) VALUES ('Pizzero'), ('Repartidor'),('Cajero');

INSERT INTO `metodo_pago`(`Metodo`) VALUES ('Efectivo'), ('Tarjeta');