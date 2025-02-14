#!/bin/bash

 
HOST="localhost"
USER="usuario" # Aqui se debe introducir el nombre del usuario en Mysql/PHPMyadmin
PASS="contraseña" # Y aqui la contraseña
DBNAME="biblioteca"
SQL_FILE="biblioteca.sql"  

echo "Creando la base de datos $DBNAME..."
mysql -h $HOST -u $USER -p$PASS -e "CREATE DATABASE IF NOT EXISTS $DBNAME;"

echo "Usando la base de datos $DBNAME..."
mysql -h $HOST -u $USER -p$PASS $DBNAME < $SQL_FILE

echo "La base de datos $DBNAME ha sido creada con éxito."
