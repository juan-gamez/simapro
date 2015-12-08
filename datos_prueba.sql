USE `simapro`;

DELETE FROM personal;
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Juan Domingo');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Carlos Sandoval');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Domingo Perez');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Mateo Sosa');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Juan Hernandez');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Lic. Carlos Pleitez');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Enrique Gamez');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Carlos Segura');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Luis Alonso');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Obrero Palacios');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Fernando Aguilar');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Mateo Palomo');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Ing. Cesar');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Oscar Barrera');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Marvin Segura');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Josué Iraheta');
INSERT INTO `personal` (`id`, `nombre`) VALUES (DEFAULT, 'Hugo Campos');

INSERT INTO `alumnos` (`carnet`, `apellidos`, `nombres`, `password`) VALUES ('BC04009', 'Barrera Cubias', 'Oscar Ulises', NULL);
INSERT INTO `alumnos` (`carnet`, `apellidos`, `nombres`, `password`) VALUES ('CZ11004', 'Campos Zelaya', 'Hugo Alexander', NULL);
INSERT INTO `alumnos` (`carnet`, `apellidos`, `nombres`, `password`) VALUES ('IM08002', 'Iraheta Marín', 'Josué Antonio', NULL);
INSERT INTO `alumnos` (`carnet`, `apellidos`, `nombres`, `password`) VALUES ('SM05083', 'Segura Menjivar', 'Marvin Rolando', NULL);

DELETE FROM usuarios;
INSERT INTO `usuarios` VALUES(DEFAULT, 'juan', MD5('juan'), 1, NULL);
INSERT INTO `usuarios` VALUES(DEFAULT, 'oscar', MD5('oscar'), 2, NULL);
INSERT INTO `usuarios` VALUES(DEFAULT, 'hugo', MD5('hugo'), 2, NULL);
INSERT INTO `usuarios` VALUES(DEFAULT, 'josué', MD5('josué'), 3, NULL);
INSERT INTO `usuarios` VALUES(DEFAULT, 'marvin', MD5('marvin'), 4, NULL);
INSERT INTO `usuarios` VALUES(DEFAULT, 'cesar', MD5('cesar'), 5, NULL);

DELETE FROM facultades;
INSERT INTO `facultades` (`id`, `nombre`) VALUES (DEFAULT, 'Facultad de Ingenieria y Arquitectura');

DELETE FROM escuelas;
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Arquitectura', 1, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería Civil', 2, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería Industrial', 3, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería Mecánica', 4, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería Eléctrica', 5, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería Química', 6, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Escuela de Ingeniería de Sistemas Informáticos', 7, 2, 1);
INSERT INTO `escuelas` (`id`, `nombre`, `director`, `secretario`, `facultad`) VALUES (DEFAULT, 'Unidad de Ciencias Basicas', 8, 2, 1);

DELETE FROM carreras;
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('A10507', 'Arquitectura', 1);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10501', 'Ingeniería Civil', 2);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10502', 'Ingeniería Industrial', 3);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10503', 'Ingeniería Mecánica', 4);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10504', 'Ingeniería Eléctrica', 5);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10506', 'Ingeniería Química', 6);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10511', 'Ingeniería de Alimentos', 6);
INSERT INTO `carreras` (`codigo`, `nombre`, `escuela`) VALUES ('I10515', 'Ingeniería en Sistemas Informáticos', 7);

DELETE FROM areas_administrativas;
INSERT INTO `areas_administrativas` (`id`, `nombre`, `jefe`, `escuela`) VALUES (DEFAULT, 'Administración', 3, 7);
INSERT INTO `areas_administrativas` (`id`, `nombre`, `jefe`, `escuela`) VALUES (DEFAULT, 'Comunicaciones y Ciencias de la Computación', 6, 7);
INSERT INTO `areas_administrativas` (`id`, `nombre`, `jefe`, `escuela`) VALUES (DEFAULT, 'Desarrollo de Sistemas', 4, 7);
INSERT INTO `areas_administrativas` (`id`, `nombre`, `jefe`, `escuela`) VALUES (DEFAULT, 'Programación y Manejo de datos', 5, 7);

DELETE FROM asignaturas;
INSERT INTO `asignaturas` VALUES('IAI115', 4, 'INTRODUCCIÓN A LA INFORMÁTICA');
INSERT INTO `asignaturas` VALUES('MSM115', 4, 'MANEJO DE SOFTWARE PARA MICROCOMPUTADORAS');
INSERT INTO `asignaturas` VALUES('PRN115', 4, 'PROGRAMACIÓN I');
INSERT INTO `asignaturas` VALUES('PRN215', 4, 'PROGRAMACIÓN II');
INSERT INTO `asignaturas` VALUES('ESD115', 4, 'ESTRUCTURA DE DATOS');
INSERT INTO `asignaturas` VALUES('MEP115', 1, 'MÉTODOS PROBABILÍSTICOS');
INSERT INTO `asignaturas` VALUES('PRN315', 4, 'PROGRAMACIÓN III');
INSERT INTO `asignaturas` VALUES('ANS115', 2, 'ANÁLISIS NUMÉRICO');
INSERT INTO `asignaturas` VALUES('HDP115', 4, 'HERRAMIENTAS DE PRODUCTIVIDAD');
INSERT INTO `asignaturas` VALUES('SYP115', 1, 'SISTEMAS Y PROCEDIMIENTOS');
INSERT INTO `asignaturas` VALUES('ARC115', 2, 'ARQUITECTURA DE COMPUTADORAS');
INSERT INTO `asignaturas` VALUES('TSI115', 3, 'TEORÍA DE SISTEMAS');
INSERT INTO `asignaturas` VALUES('DSI115', 3, 'DISEÑO DE SISTEMAS I');
INSERT INTO `asignaturas` VALUES('MIP115', 2, 'MICROPROGRAMACIÓN');
INSERT INTO `asignaturas` VALUES('TAD115', 1, 'TEORÍA ADMINISTRATIVA');
INSERT INTO `asignaturas` VALUES('COS115', 2, 'COMUNICACIONES I');
INSERT INTO `asignaturas` VALUES('DSI215', 3, 'DISEÑO DE SISTEMAS II');
INSERT INTO `asignaturas` VALUES('SIO115', 2, 'SISTEMAS OPERATIVOS');
INSERT INTO `asignaturas` VALUES('BAD115', 3, 'BASES DE DATOS');
INSERT INTO `asignaturas` VALUES('RHU115', 1, 'RECURSOS HUMANOS');
INSERT INTO `asignaturas` VALUES('SGI115', 3, 'SISTEMAS DE INFORMACIÓN GERENCIAL');
INSERT INTO `asignaturas` VALUES('ACC115', 1, 'ADMINISTRACIÓN DE CENTROS DE CÓMPUTO');
INSERT INTO `asignaturas` VALUES('API115', 3, 'ADMINISTRACIÓN DE PROYECTOS INFORMÁTICOS');
INSERT INTO `asignaturas` VALUES('CPR115', 1, 'CONSULTORÍA PROFESIONAL');
INSERT INTO `asignaturas` VALUES('AGR115', 2, 'ALGORITMOS GRÁFICOS');
INSERT INTO `asignaturas` VALUES('TDS115', 2, 'TÉCNICAS DE SIMULACIÓN');
INSERT INTO `asignaturas` VALUES('COS215', 2, 'COMUNICACIONES II');
INSERT INTO `asignaturas` VALUES('TPI115', 4, 'TECNICAS DE PROGRAMACIÓN EN INTERNET');
INSERT INTO `asignaturas` VALUES('ADC115', 1, 'ANÁLISIS DE COSTOS INFORMÁTICOS');
INSERT INTO `asignaturas` VALUES('TOO115', 3, 'TECNOLOGÍA ORIENTADA A OBJETOS');
INSERT INTO `asignaturas` VALUES('AUS115', 1, 'AUDITORÍA DE SISTEMAS');
INSERT INTO `asignaturas` VALUES('IBD115', 3, 'IMPLEMENTACIÓN DE BASES DE DATOS');
INSERT INTO `asignaturas` VALUES('IGF115', 3, 'INGENIERÍA DE SOFTWARE');
INSERT INTO `asignaturas` VALUES('PDC115', 2, 'PROTOCOLOS DE COMUNICACIONES');
/*Buscar la area administrativa correcta: */
INSERT INTO `asignaturas` VALUES('CET115', 1, 'COMERCIO ELECTRÓNICO');
INSERT INTO `asignaturas` VALUES('PDM115', 1, 'PROGRAMACIÓN PARA DISPOSITIVOS MÓVILES');
INSERT INTO `asignaturas` VALUES('PDD115', 1, 'PROGRAMACIÓN 3D');
INSERT INTO `asignaturas` VALUES('SIF115', 1, 'SEGURIDAD INFORMÁTICA');
INSERT INTO `asignaturas` VALUES('IIN115', 1, 'INTRODUCCIÓN A LA INFOGRAFÍA');
INSERT INTO `asignaturas` VALUES('PAM115', 1, 'INTRODUCCIÓN A LA PROGRAMACIÓN DE APLICACIONES MÓVILES');
INSERT INTO `asignaturas` VALUES('SGG115', 1, 'SISTEMAS DE INFORMACIÓN GEOGRÁFICOS');


DELETE FROM carrera_recibe_asignatura;

INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'IAI115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'MSM115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PRN115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PRN215');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'ESD115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'MEP115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PRN315');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'ANS115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'HDP115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'SYP115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'ARC115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'TSI115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'DSI115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'MIP115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'TAD115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'COS115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'DSI215');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'SIO115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'BAD115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'RHU115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'SGI115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'ACC115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'API115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'CPR115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'AGR115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'TDS115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'COS215');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'TPI115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'ADC115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'TOO115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'AUS115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'IBD115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'IGF115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PDC115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'CET115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PDD115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'SIF115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'IIN115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'PAM115');
INSERT INTO `carrera_recibe_asignatura` VALUES('I10515', 'SGG115');



INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'B21');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'B22');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'B31');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'B32');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'BIB301');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'BIB302');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C11');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C23');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C32');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C44');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C43');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'C41');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'D11');
INSERT INTO `aulas` (`id`, `nombre`) VALUES (DEFAULT, 'D42');





DELETE FROM ciclos;

INSERT INTO `ciclos` VALUES(id, '2015-07-01', '2015-12-01', 'Ciclo II-15', 'I', TRUE);

DELETE FROM asignatura_ciclo;
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'ACC115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'API115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'ARC115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'AUS115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'CET115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'COS115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'CPR115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'DSI215', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'ESD115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'IBD115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'IGF115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'MEP115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'MSM115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'PRN115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'PRN315', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'SIO115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'TOO115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'TPI115', 1, 1, 1);
INSERT INTO asignatura_ciclo VALUES(DEFAULT, 1, 'TSI115', 1, 1, 1);

DELETE FROM horarios;
INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   0);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   0);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  0);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  0);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  0);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  0);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  0);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  0);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   1);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   1);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  1);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  1);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  1);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  1);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  1);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  1);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   2);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   2);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  2);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  2);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  2);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  2);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  2);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  2);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   3);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   3);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  3);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  3);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  3);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  3);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  3);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  3);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   4);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   4);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  4);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  4);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  4);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  4);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  4);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  4);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   5);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   5);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  5);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  5);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  5);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  5);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  5);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  5);

INSERT INTO horarios VALUES(DEFAULT, '6:20',   '8:00',   6);
INSERT INTO horarios VALUES(DEFAULT, '8:05',   '9:45',   6);
INSERT INTO horarios VALUES(DEFAULT, '9:50',   '11:30',  6);
INSERT INTO horarios VALUES(DEFAULT, '11:35',  '13:15',  6);
INSERT INTO horarios VALUES(DEFAULT, '13:20',  '15:00',  6);
INSERT INTO horarios VALUES(DEFAULT, '15:05',  '16:45',  6);
INSERT INTO horarios VALUES(DEFAULT, '16:50',  '18:30',  6);
INSERT INTO horarios VALUES(DEFAULT, '18:35',  '20:15',  6);