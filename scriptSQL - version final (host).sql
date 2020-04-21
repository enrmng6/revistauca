
/*--DROP USER web1@localhost;

--select user, host from mysql.user;*/

CREATE USER 'web1'@'localhost' IDENTIFIED BY 'web1';

DROP DATABASE if exists revistauca;

CREATE DATABASE revistauca;

USE revistauca;

CREATE TABLE carreras (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50)
);

INSERT INTO carreras (nombre) VALUES ('Ingenieria Informatica');
INSERT INTO carreras (nombre) VALUES ('Recursos');
INSERT INTO carreras (nombre) VALUES ('Derecho');
INSERT INTO carreras (nombre) VALUES ('Tecnico en Telematica');
INSERT INTO carreras (nombre) VALUES ('Otra');


CREATE TABLE usuarios (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(50),
	correo VARCHAR(50),
	passw VARCHAR(250),
	id_carrera INT,
	tipo VARCHAR(20),
	imagen VARCHAR(300),
	creado TIMESTAMP
);

INSERT INTO usuarios (nombre, correo, passw, tipo, creado) VALUES ('admin', 'admin@uca.app', SHA1('admin'), 'administrador', NULL);
UPDATE usuarios SET imagen = '/revistauca/_public/img/Perfil.png' where correo = 'admin@uca.app';

INSERT INTO usuarios (nombre, correo, passw, tipo, creado) VALUES ('uca', 'uca@uca.app', SHA1('uca'), 'administrador', NULL);
UPDATE usuarios SET imagen = '/revistauca/_public/img/Perfil2.png' where correo = 'uca@uca.app';

INSERT INTO usuarios (nombre, correo, passw, tipo, creado) VALUES ('editor', 'editor@uca.app', SHA1('editor'), 'editor', NULL);
UPDATE usuarios SET imagen = '/revistauca/_public/img/Perfil.png' where correo = 'editor@uca.app';

INSERT INTO usuarios (nombre, correo, passw, tipo, creado) VALUES ('estudiante', 'estudiante@uca.app', SHA1('estudiante'), 'estudiante', NULL);
UPDATE usuarios SET imagen = '/revistauca/_public/img/Perfil.png' where correo = 'estudiante@uca.app';

INSERT INTO usuarios (nombre, correo, passw, tipo, creado) VALUES ('visitante', 'visitante@uca.app', SHA1('visitante'), 'visitante', NULL);
UPDATE usuarios SET imagen = '/revistauca/_public/img/Perfil.png' where correo = 'visitante@uca.app';


CREATE TABLE machotes (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	archivo VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	descripcion VARCHAR(250),
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/*En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/

INSERT INTO machotes (preview, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.ingeniovirtual.com/wp-content/uploads/tecnologias-de-desarrollo-web.jpg', 'Desarrollo Web', 1, NULL, 'Desarrollo Web es un curso ...', 'Desarrollo Web es un curso ...');
INSERT INTO machotes (preview, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://3485z63fwd8csdtuv2g785iv-wpengine.netdna-ssl.com/wp-content/uploads/esat-carrera-programacion-vj.png', 'Programación', 2, NULL, 'La programación de sistemas ...', 'La programación de sistemas ...');
INSERT INTO machotes (preview, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://image.jimcdn.com/app/cms/image/transf/none/path/s30752bf103bba28e/image/ia8600f55f82df495/version/1485554770/image.jpg', 'Mates Discretas', 1, NULL, 'Las matemáticas discretas ...', 'Las matemáticas discretas ...');


CREATE TABLE comments (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_padre INT,
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	comentario TEXT
);
/*En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/

INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (1, 1, NULL, 'Comentario Admin');
INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (1, 2, NULL, 'Comentario UCA');
INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (1, 1, NULL, 'Comentario 3');
INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (2, 1, NULL, 'Comentario de Admin');
INSERT INTO comments (id_padre, id_autor, creado, comentario) VALUES (3, 2, NULL, 'Comentario de UCA');






CREATE TABLE entrecontadores (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	archivo VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	descripcion VARCHAR(250),
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/*En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/



INSERT INTO entrecontadores (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/10/Revista-Profesional-Vol-3-No-2-Oct-2019.png', 'https://www.uca.ac.cr/wp-content/uploads/2019/10/Revista-Entre-Contadores-V3_N2_OCT2019.pdf', 'Revista Entre Contadores, Volumen 3, Nº 2, Octubre 2019', 1, NULL, 'Revista Entre Contadores, Volumen 3, Nº 2, Octubre 2019', 'Revista Entre Contadores, Volumen 3, Nº 2, Octubre 2019');
INSERT INTO entrecontadores (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/05/Portada-EntreContadores-V3_N1_MAY2019.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2019/05/Revista-Entre-Contadores-V3_N1_MAY2019.pdf', 'Revista Entre Contadores, Volumen 3, Nº 1, Mayo 2019', 1, NULL, 'Revista Entre Contadores, Volumen 3, Nº 1, Mayo 2019', 'Revista Entre Contadores, Volumen 3, Nº 1, Mayo 2019');
INSERT INTO entrecontadores (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/07/Portada-EntreContadores-V2_N1_JUL2018.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2018/07/2-EntreContadores-Revista.pdf', 'Revista Entre Contadores, Volumen 2, Nº 1, Julio 2018', 1, NULL, 'Revista Entre Contadores, Volumen 2, Nº 1, Julio 2018', 'Revista Entre Contadores, Volumen 2, Nº 1, Julio 2018');
INSERT INTO entrecontadores (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/02/Portada-EntreContadores-V1_N1_NOV2017.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/12/EntreContadores-Revista-1.pdf', 'Revista Entre Contadores, Volumen 1, Nº 1, Noviembre 2017', 1, NULL, 'Revista Entre Contadores, Volumen 1, Nº 1, Noviembre 2017', 'Revista Entre Contadores, Volumen 1, Nº 1, Noviembre 2017');


CREATE TABLE entrecontadores_comments(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_padre INT,
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	comentario TEXT
);
/*En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/




CREATE TABLE ucaprofesional (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	archivo VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	descripcion VARCHAR(250),
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/* En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/



INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/revista-profesional-01.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/11/Revista-Profesional-Vol-1.pdf', 'Revista Profesional #1', 1, NULL, 'Revista Profesional #1', 'Revista Profesional #1');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/revista-profesional-02-1.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/11/Revista-Profesional-Vol-2.pdf', 'Revista Profesional #2', 1, NULL, 'Revista Profesional #2', 'Revista Profesional #2');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/02/Revista-Profesional-III.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/02/Revista-Profesional-Vol-3.pdf', 'Revista Profesional #3', 1, NULL, 'Revista Profesional #3', 'Revista Profesional #3');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/05/Portada-Uca-profesional-4-1.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/05/Revista-Profesional-Vol-4.pdf', 'Revista Profesional #4', 1, NULL, 'Revista Profesional #4', 'Revista Profesional #4');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/09/Revista-Profesional-Vol-2-No-1-Set-2018-1.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/09/Revista-Profesional-Vol-5-P3.pdf', 'Revista Profesional #5', 1, NULL, 'Revista Profesional #5', 'Revista Profesional #5');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/04/Revista-6-Mini-1.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2019/04/Revista-Profesional-Vol-6.pdf', 'Revista Profesional #6', 1, NULL, 'Revista Profesional #6', 'Revista Profesional #6');
INSERT INTO ucaprofesional (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/09/Rev-Prof-7.png', 'https://www.uca.ac.cr/wp-content/uploads/2019/09/Revista-Profesional-Vol-7.pdf', 'Revista Profesional # 7', 1, NULL, 'Revista Profesional # 7', 'Revista Profesional # 7');


CREATE TABLE ucaprofesional_comments(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_padre INT,
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	comentario TEXT
);
/*En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/



CREATE TABLE educar (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	archivo VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	descripcion VARCHAR(250),
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/* En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/



INSERT INTO educar (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/Articulo-2.png', 'https://www.uca.ac.cr/wp-content/uploads/2017/09/Revista-Educar-V1N10617A2-1.pdf', 'Revista Educar 2017-2', 1, NULL, 'Revista Educar 2017-2', 'Revista Educar 2017-2');
INSERT INTO educar (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/Articulo-1.png', 'https://www.uca.ac.cr/wp-content/uploads/2017/09/Revista-Educar-V1N10617A1-1.pdf', 'Revista Educar 2017-1', 1, NULL, 'Revista Educar 2017-1', 'Revista Educar 2017-1');
INSERT INTO educar (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/02/Editorial.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/02/Revista-Educar-V1N10617Editorial.pdf', 'Revista Educar 2017-Editorial', 1, NULL, 'Revista Educar 2017-Editorial', 'Revista Educar 2017-Editorial');



CREATE TABLE educar_comments(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_padre INT,
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	comentario TEXT
);
/* En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/



--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `preview` varchar(250) DEFAULT NULL,
  `archivo` varchar(250) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  `modificado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `creado` timestamp NOT NULL DEFAULT current_timestamp(),
  `descripcion` varchar(250) DEFAULT NULL,
  `contenido` text DEFAULT NULL,
  `likes` int(3) DEFAULT NULL,
  `nomegusta` int(11) DEFAULT 0,
  `compartido` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `noticias` (`id`, `preview`, `archivo`, `titulo`, `id_autor`, `modificado`, `creado`, `descripcion`, `contenido`, `likes`, `nomegusta`, `compartido`) VALUES
(1, 'https://static4.abc.es/media/tecnologia/2019/11/29/hotmail-mail-kHpE--620x349@abc.jpg', NULL, 'Cuidado, las estafas para robar fotografias y documentos a los usuarios aumentan', 1, '2020-04-20 04:49:15', '2020-03-31 02:44:59', 'La compañIa de ciberseguridad Kaspersky ha alertado sobre el aumento...', 'La compañIa de ciberseguridad Kaspersky ha alertado sobre el aumento durante el tercer trimestre de este año 2019 de los ataques de PHISHING y fraudes a usuarios relacionados con el robo de documentos y datos personales como selfies.', 20, 3, 0),
(2, 'https://cdn.crhoy.net/imagenes/2019/10/Facebook1.jpg', NULL, 'Facebook presenta Problemas a nivel Mundial', 1, '2020-03-31 02:44:59', '2020-03-31 02:44:59', 'La transmisión de videos por medio de la red presenta severas intermitencias...', 'La transmisión de videos por medio de la red presenta severas intermitencias, al igual que la opción de cargar los últimos “posts”, o revisar la bandeja de entrada de mensajes. No es la primera vez que Facebook presenta un “apagón“.', 0, 0, 0),
(3, 'https://cdn.crhoy.net/imagenes/2019/11/tik-tok1-300x300.jpg', NULL, 'Una Nueva app china se posiciona entre los mas jovenes', 1, '2020-03-31 02:44:59', '2020-03-31 02:44:59', 'La aplicación para compartir videos TikTok ha conquistado a los adolescentes...', '(AFP)- La aplicación para compartir videos TikTok ha conquistado a los adolescentes del mundo entero con pasos de baile, desfiles filmados y consejos para maquillarse, aunque genera también controversia por sus vínculos con el gobierno y la censura de contenidos en China.', 0, 0, 0);


ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;





CREATE TABLE boletines (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	archivo VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	descripcion VARCHAR(250),
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/* En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/




INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/boletin-lllC-2016.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/09/Boletin-UCA-III-Cuat-2016.pdf', 'Boletín UCA lll C 2016', 1, NULL, 'Boletín UCA lll C 2016', 'Boletín UCA lll C 2016');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/portada-boletin-l-1017.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/09/Boletin-UCA-I-C-2017-2.pdf', 'Boletín UCA l C 2017', 1, NULL, 'Boletín UCA l C 2017', 'Boletín UCA l C 2017');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/09/portada-boletin-ll-2017.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/09/Boletin-UCA-IIC-2017-2.pdf', 'Boletín UCA ll C 2017', 1, NULL, 'Boletín UCA ll C 2017', 'Boletín UCA ll C 2017');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2017/11/boletin-lllC-2017.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2017/11/Boletin-UCA-III-C-2017.pdf', 'Boletín UCA lll C 2017', 1, NULL, 'Boletín UCA lll C 2017', 'Boletín UCA lll C 2017');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/01/Boletines.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/01/Boletin-UCA-IC-2018.pdf', 'Boletin UCA I C 2018', 1, NULL, 'Boletin UCA I C 2018', 'Boletin UCA I C 2018');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/06/Miniatura-Boletin-II-C-2018.png', 'https://www.uca.ac.cr/wp-content/uploads/2018/06/Boletin-UCA-IIC-2018.pdf', 'Boletin II C 2018', 1, NULL, 'Boletin II C 2018', 'Boletin II C 2018');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2018/06/III-BOLETIN-3Q-Portada.jpg', 'https://www.uca.ac.cr/wp-content/uploads/2018/09/BOLETIN-UCA-IIIC-2018.pdf', 'BOLETIN III C 2018', 1, NULL, 'BOLETIN III C 2018', 'BOLETIN III C 2018');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/02/MINI-PORTADA-IC2019.png', 'https://www.uca.ac.cr/wp-content/uploads/2019/02/BOLETIN-IC-2019.pdf', 'BOLETIN I C 2019', 1, NULL, 'BOLETIN I C 2019', 'BOLETIN I C 2019');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/07/WhatsApp-Image-2019-07-10-at-4.42.17-PM.jpeg', 'https://www.uca.ac.cr/wp-content/uploads/2019/07/Boletin-UCA-II-C-2019.pdf', 'BOLETIN II C 2019', 1, NULL, 'BOLETIN II C 2019', 'BOLETIN II C 2019');
INSERT INTO boletines (preview, archivo, titulo, id_autor, creado, descripcion, contenido) VALUES ('https://www.uca.ac.cr/wp-content/uploads/2019/10/Mini-Portada-Bole-III-2019.png', 'https://www.uca.ac.cr/wp-content/uploads/2019/10/Bolet%C3%ADn-IIIC-2019.pdf', 'Boletin III C 2019', 1, NULL, 'Boletin III C 2019', 'Boletin III C 2019');





CREATE TABLE visitas (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_elemento INT,
	entidad VARCHAR(30),
	id_usuario INT,
	contador INT DEFAULT 0,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	request_header TEXT
);
/*--id_elemento (id del machote, noticia, revista, calendario, boletin, etc...)
--entidad (el nombre del elemento: machote, noticia, revista, calendario, boletin, etc...)
--request_header (el texto del encabezado de la solicitud web)*/


CREATE TABLE about (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	preview VARCHAR(250),
	titulo VARCHAR(100),
	id_autor INT,
	modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	contenido TEXT,
	megusta INT DEFAULT 0,
	nomegusta INT DEFAULT 0,
	compartido INT DEFAULT 0
);
/* En HOST: creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,*/


INSERT INTO about (titulo, id_autor, creado, contenido) VALUES ('App de las Revistas UCA', 2, NULL, '<h4 id="appinfo">Informacion de la aplicación</h4>

<div id="blog_detail_description"> 
	<p>Esta es la primera version de la app para la Revista UCA.</p>
</div>

<div class="disenadores" style="margin-bottom: 3%;">

	<h3>Diseñadores</h3>

	<div class="disenador">
		Andre McKenzie
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

	<div class="disenador">
		Daniel Villalobos
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

	<div class="disenador">
		Jeison González
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

	<div class="disenador">
		Julian Castillo
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

	<div class="disenador">
		Kirsten Barquero
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

	<div class="disenador">
		Victor Monge
		<img src="/revistauca/_public/img/Perfil.png" alt="[Foto de Perfil]" height="42" width="42">
	</div>

</div>');








CREATE TABLE `likes` (
  `id_lik` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `likes` text NOT NULL,
  `dislikes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id_lik`, `usuario`, `post`, `likes`, `dislikes`) VALUES
(54, 801, 2, 'true', 'false'),
(55, 804, 2, 'true', 'false'),
(56, 4, 1, 'true', 'false');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_lik`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id_lik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





GRANT ALL ON revistauca.* TO 'web1' IDENTIFIED BY 'web1';
FLUSH PRIVILEGES;





