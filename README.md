Guía del Usuario para el Sistema de Gestión de Asistencia
PARTICIPO
1. Introducción
El sistema PARTICIPO está diseñado para ayudar a los profesores en la gestión de asistencias, notas y registros de alumnos. A continuación se detalla cómo navegar y utilizar sus funcionalidades.
________________________________________
2. Acceso al Sistema:
Descargar archivo zip, extraer los archivos en la carpeta www que es leída por servidor laragon. Iniciar laragon, ejecutar documento sql de la carpeta nombrado “BaseDatosParticipo” en su base de datos. Desde el menú de laragon, ejecutar “participo 2.0.”

2.1 Inicio de Sesión
  	Dirígete a la página de inicio de sesión.
  	Ingresa tu nombre de usuario y contraseña (JavierParra – 1234).
  	Haz clic en el botón "Iniciar" para acceder al sistema.
2.2 Panel Principal
    Una vez que inicies sesión correctamente, serás redirigido al panel principal, donde verás un mensaje de bienvenida con tu nombre y       el   acceso a las funciones principales.
________________________________________
3. Navegación por el Menú
El menú principal, ubicado en la parte superior, te permite acceder a distintas secciones del sistema:
    •	Inicio: Página principal con el mensaje de bienvenida y acceso a las funciones.
    •	Gestión de Asistencias: Donde puedes registrar, actualizar y eliminar asistencias de los estudiantes en las materias y fechas            seleccionadas.
    •	Gestión de Notas: Donde puedes registrar y actualizar las notas de los estudiantes. Además visualizar la condicion de cada               estudiante de acuerdo a el porcentaje de Asistencia y el promedio de notas, cumpliendo con los registros del RAM.
    •	Registros: Sección en la que se puede visualizar el registro de los alumnos y los valores del RAM, en ambos se pueden editar los         datos, y en alumnos tambien elimianr registro..
    •Altas: Sección para registrar nuevos estudiantes, institutos y materias en el sistema. Tambien se permite dar de baja materias.
________________________________________
4. Guía para el Registro de Asistencias
    Dirígete a la sección Asistencias a través del menú principal.
    Selección de Instituto, Materia y Fecha utilizando el calendario.
    Haz clic en "Obtener lista de alumnos" para visualizar los estudiantes matriculados.
   
    Marcar Asistencia:
  	Se mostrará una lista de alumnos inscritos en la materia.
  	Marca la casilla de verificación junto a cada estudiante presente.
  	Haz clic en "Guardar Asistencia".
    Al guardar exitosamente, el sistema mostrará un mensaje de confirmación.

     Modificar Asistencias:
  	Desde el menú Asistencias, accede a las asistencias previamente guardadas.
  	Filtra el registro que deseas modificar y realiza los cambios necesarios.
  	Guarda los cambios con "Guardar Cambios". También puedes eliminar registros completos aceptando la alerta de confirmación.
________________________________________
5. Gestión de Notas:
  	En el menú principal, selecciona Notas.
    Elige la Materia en el menú desplegable.
  	Se mostrará una tabla con los datos de cada alumno, incluyendo:
      o	Nombre y Apellido
      o	Notas: Campos editables para ingresar o modificar las calificaciones entre 0 y 10.
      o	Porcentaje de Asistencia: Calculado automáticamente.
      o	Condición Académica: Calculada en función del promedio de notas y asistencia del alumno de forma automática, teneindo en cuenta         los paràmentos registrados en el RAM.
        	Libre: Promedio < 6 y asistencia < 70%.
        	Regular: Promedio ≥ 6 && Promedio >8 , con asistencia ≤ 80% && asistencia ≥ 70%.
        	Promocionado: Promedio ≥ 8 y asistencia ≥ 80%.
        	Pendiente: No cumple con las condiciones anteriores.
  	Al finalizar, haz clic en "Guardar Notas". Se guardarán automáticamente y recibirás un mensaje de confirmación.
________________________________________
6. Alta de Alumnos
   	Accede a Alta, Alta de Alumnos desde el menú principal.
    Selecciona Instituto y luego la Materia en la sección Alta de Alumnos.
   	Completa los datos del alumno: Nombre, Apellido, y opcionalmente Email, Fecha de Nacimiento y DNI.(Obligatorio solo nombre y apellido)
  	Haz clic en "Dar de Alta". Si el registro es exitoso, recibirás un mensaje de confirmación.

   Modificación de Alumnos:
  	En la sección Registros, puedes editar la información de los alumnos o eliminar registros si es necesario.
________________________________________
7. Alta de Institutos
    Accede a Alta, Alta de Institutos desde el menú principal.
   	Completa los datos del instituto: Nombre y Dirección.
  	Haz clic en "Dar de Alta" y confirma el registro.
________________________________________
8. Alta y Baja de Materias
    Accede a Alta, Alta de Materias desde el menú principal.
  	Selecciona el Instituto al que deseas agregar la materia. (Solo aparecen los istitutos relacionados al profesor)
  	Ingresa el Nombre de la Materia y haz clic en "Dar de Alta" para confirmar.

    Baja de Materias:
  	Marca la materia que deseas eliminar.
  	Haz clic en el botón de baja correspondiente y confirma la eliminación.
   ________________________________________
10. Calendario
  El sistema en la versin actual solo permite el atajo de visualizacion del calendario, sin nunguna función adicional.
________________________________________
10. Mensajes y Alertas del Sistema
El sistema utiliza SweetAlert para mostrar notificaciones:
•	Alertas verdes: para confirmaciones exitosas (registro guardado correctamente).
•	Alertas rojas: para advertencias de errores o registros duplicados.
________________________________________
11. Contacto para Soporte
Para soporte adicional, puedes contactar al administrador del sistema en:
Correo electrónico: elisamariaronconi@gmail.com

________________________________________

