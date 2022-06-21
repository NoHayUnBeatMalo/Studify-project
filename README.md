


**DESARROLLO DE UN SITIO WEB PARA AYUDAR A ESTUDIANTES**







**Proyecto final de segundo año de Desarrollo de Aplicaciones Web usando PHP, MySQL, JavaScript, HTML, CSS, frameworks y librerías de PHP y JavaScript**







**TRABAJO REALIZADO POR AITOR VÁZQUEZ GARCÍA**







ÍNDICE

	**Introducción 

	Análisis 

	Descripción del proyecto

	Requisitos generales 

	Casos de uso 

	Diseño 

	Arquitectura 

	Modelo de datos 

	Interfaz gráfica (usabilidad, accesibilidad, responsive, etc.) 

	Pruebas

	Despliegue (operaciones, mantenimiento, etc.)**








**Introducción**
Esta aplicación surgió por la necesidad que tienen los estudiantes para el aprendizaje de la gestión de su tiempo, cada vez los calendarios escolares están más apretados, exámenes, trabajos, proyectos…
Para acceder a la aplicación tiene que tener un perfil de usuario. Con esta aplicación podremos incluir nuestros eventos a un calendario, gestionar una lista de tareas única para cada usuario y acceder a una sección de cursos.
Lo que se pretende con esta aplicación es ayudar a los estudiantes a aprender a gestionar y agilizar su tiempo.

**Análisis de requisitos**
**Descripción del proyecto**
Todos los usuarios deben estar registrados para acceder a la aplicación. Cada usuario puede ser ‘invitado’ o ‘administrador’. Los usuarios pueden ser, a su vez, ‘estudiantes’ o ‘profesores’. Cada usuario, ya sea ‘invitado’ o ‘administrador’, puede acceder a todos los servicios de la aplicación. 
Los administradores tendrán un panel desde el que controlar la gestión de usuarios, gestión de estudiantes, gestión de profesores y cursos.
Los usuarios pueden acceder a un calendario único para cada usuario, a una lista de tareas única para cada usuario y a una sección de compraventas de cursos, además de a su perfil de usuario.
Un invitado no puede subir un curso. Tiene que ponerse en contacto con un administrador a través de email, pero si puede editarlo.
El proyecto debe ser responsive, además de tener un panel desde el que personalizar el panel de los administradores.

**
Requisitos **


![image](https://user-images.githubusercontent.com/58789494/174832106-568a5f86-6bec-4b86-974c-47a96a0d104c.png)



**Planificación**
Las instrucciones de este repositorio son para la construcción y el despliegue en local. Para ello primero debes instalar PHP y MySQL, para ello hemos utilizado XAMPP, la cuál nos proporciona una herramienta de instalación automática.
Antes de crear el proyecto debemos configurar la base de datos a la que daremos un nombre de usuario y una contraseña.
Para crear la interfaz de administradores utilizaremos un framework, llamado AdminLTE y para el listado de usuarios, cursos, profesores y estudiantes utilizaremos DataTables. Para el calendario otro framework, FullCalendar, que nos ayudará creando la interfaz del calendario.
Además utilizaremos Bootstrap para ahorrarnos tiempo en las interfaces.







**Casos de uso**
![image](https://user-images.githubusercontent.com/58789494/174832672-af8f7b04-d4a2-405d-a02b-1f16af6bd32e.png)
![image](https://user-images.githubusercontent.com/58789494/174832700-df9440ed-d24e-4553-a81b-60f20c8562ac.png)
![image](https://user-images.githubusercontent.com/58789494/174832750-f1ea26d9-a86d-4675-8763-f18db25d1918.png)






**Diseño**
Para el desarrollo de la aplicación web en conjunto se tomó como guía la arquitectura en tres capas. 
El objetivo es separar en partes el desarrollo de la aplicación. Cada parte es explicada a continuación. 

- Primera capa: La interfaz web que el usuario visualiza, está relacionada con el diseño de las páginas web. Para esto se utilizó la herramienta Bootstrap y CSS, además de algunos frameworks como DataTables y FullCalendar
- Capa 2: Maneja la lógica de la aplicación, procesar las peticiones y dependiendo de las solicitudes accede a la base de datos para obtener la información y mostrarla al usuarios. El lenguaje utilizado fue PHP
- Capa 3: Se diseñó el esquema de la base de datos usando el modelo Entidad Relación. Luego, se crearon las bases de datos en MariaDB y PostgreSQL. 

![image](https://user-images.githubusercontent.com/58789494/174832866-4fd3cd11-c3ca-4df2-9a24-2bf5d9848b5d.png)


El portal web tiene las siguientes funcionalidades: 
- Ofrece una página principal que facilita el acceso al resto del portal web.
 - Ofrece otra página para los administradores
- La página principal es estática 
- Muestra un calendario 
- Muestra una lista de tareas
- Muestra un portal de compraventas de cursos
- Muestra el perfil de usuario

	El diseño de la aplicación consta de un home, una página para el calendario, una página para la lista de tareas, una página para la compraventas de cursos y una página para modificar el perfil de usuario


El diseño de la base de datos se presenta a través de un modelo Entidad/Relación. Trás realizar el modelo lo introducimos en la base de datos y dió como resultado la estructura de las tablas que se muestran a continuación




**Modelo de datos**
![image](https://user-images.githubusercontent.com/58789494/174832949-5917ee2e-c38e-45c9-b745-96a400595439.png)

**Interfaz**
La interfaz debe ser clara, intuitiva y con un diseño responsive. Para ello hemos utilizado CSS y Bootstrap. 


