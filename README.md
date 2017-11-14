Vease de contar con Composer y Laravel instalados junto a la version 7.0 de PHP

Levantar una instancia de mysql en el puerto default(3306)

Por ejemplo usando docker se puede correr el comando:

_sudo docker run --name mysql -v {directory for volume} -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 -d mysql_

Luego tambien es necesario generar una base de datos llamada **adved** o sino modificarla a gusto en el archivo **.env**

Luego es necesario correr el comando de migrations de Laravel y el de Seeds para generar las tablas y popularlas:

**php artisan migrate --seed -vvv**

Finalmente se puede correr la aplicacion con el comando 

**php artisan serve**

