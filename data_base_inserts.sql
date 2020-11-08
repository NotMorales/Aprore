--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `direccion`, `correo`, `contacto`, `telefono`, `rfc`, `data_base`, `logo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Aprore', 'Toluca', 'desarollo@aprore.com', 'Luis Morales V', '9211479791', 'MOVL991024', 'aproreco_aprore', '', '2020-09-19 16:43:04', '2020-09-19 16:43:04', NULL);

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `sexo`, `telefono`, `fecha_nacimiento`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Luis Antonio', 'Morales', 'Velazquez', 'Hombre', '9211479791', '1999-10-24', '2020-09-19 16:43:04', '2020-09-19 16:43:04', NULL);

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrador', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(2, 'Administrador Aprore', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(3, 'Staff Aprore', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(4, 'Administrador Cliente', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(5, 'Secretaria Cliente', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(6, 'Trabajador', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL);

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `persona_id`, `role_id`, `empresa_id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Luis Antonio Morales Velazquez', 'morales.lamv@gmail.com', NULL, '$2y$10$XjzOQzTvz50nXaCx2YyTReYcZfJt3iw7B8AHkB4fRi4G9ZIwWk17q', NULL, NULL, NULL, NULL, '2020-09-19 16:43:04', '2020-09-19 16:43:04', NULL);

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Registro de Clientes', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(2, 'Registro de Postulantes', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(3, 'Asignacion de contrato', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

--
-- Volcado de datos para la tabla `modulo_user`
--

INSERT INTO `empresa_modulo` (`id`, `empresa_id`, `modulo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(2, '1', '2', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(3, '1', '3', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'empresa.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(2, 'empresa.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(3, 'empresa.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(4, 'empresa.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(5, 'empresa.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(6, 'Empresa.staff.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(7, 'Empresa.staff.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(8, 'Empresa.staff.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(9, 'Empresa.staff.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(10, 'Empresa.staff.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(11, 'Empresa.admin.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(12, 'Empresa.admin.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(13, 'Empresa.admin.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(14, 'Empresa.admin.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(15, 'Empresa.admin.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(16, 'Empresa.secre.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(17, 'Empresa.secre.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(18, 'Empresa.secre.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(19, 'Empresa.secre.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(20, 'Empresa.secre.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(21, 'Empresa.encargado.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(22, 'Empresa.encargado.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(23, 'Empresa.encargado.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(24, 'Empresa.encargado.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(25, 'Empresa.encargado.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(26, 'Postulante.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(27, 'Postulante.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(28, 'Postulante.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(29, 'Postulante.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(30, 'Postulante.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(31, 'Postulante.informacion.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(32, 'Postulante.informacion.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(33, 'Postulante.informacion.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(34, 'Postulante.informacion.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(35, 'Postulante.informacion.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(36, 'Postulante.expediente.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(37, 'Postulante.expediente.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(38, 'Postulante.expediente.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(39, 'Postulante.expediente.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(40, 'Postulante.expediente.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(41, 'Postulante.solicitud.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(42, 'Postulante.solicitud.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(43, 'Postulante.solicitud.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(44, 'Postulante.solicitud.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(45, 'Postulante.solicitud.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(46, 'Empresa.staff.assign', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(47, 'Contrato.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(48, 'Contrato.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(49, 'Contrato.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(50, 'Contrato.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(51, 'Contrato.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(52, 'Sucursal.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(53, 'Sucursal.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(54, 'Sucursal.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(55, 'Sucursal.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(56, 'Sucursal.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(57, 'Area.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(58, 'Area.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(59, 'Area.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(60, 'Area.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(61, 'Area.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(62, 'Seccion.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(63, 'Seccion.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(64, 'Seccion.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(65, 'Seccion.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(66, 'Seccion.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(67, 'Baja.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(68, 'Baja.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(69, 'Baja.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(70, 'Baja.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(71, 'Baja.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(72, 'Baja.solicitud.index', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(73, 'Baja.solicitud.create', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(74, 'Baja.solicitud.edit', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(75, 'Baja.solicitud.show', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(76, 'Baja.solicitud.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

--
-- Volcado de datos para la tabla `permiso_role`
--

INSERT INTO `permiso_role` (`id`, `permiso_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(2, 2, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(3, 3, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(4, 4, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(5, 5, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(6, 6, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(7, 7, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(8, 8, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(9, 9, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(10, 10, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(11, 11, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(12, 12, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(13, 13, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(14, 14, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(15, 15, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(16, 16, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(17, 17, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(18, 18, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(19, 19, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(20, 20, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(21, 21, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(22, 22, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(23, 23, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(24, 24, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(25, 25, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(26, 26, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(27, 27, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(28, 28, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(29, 29, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(30, 30, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(31, 31, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(32, 32, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(33, 33, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(34, 34, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(35, 35, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(36, 26, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(37, 27, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(38, 28, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(39, 29, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(40, 30, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(41, 31, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(42, 32, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(43, 33, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(44, 34, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(45, 35, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(46, 36, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(47, 36, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(48, 37, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(49, 37, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(50, 46, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(51, 46, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(52, 26, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(53, 29, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(54, 41, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(55, 42, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(56, 43, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(57, 44, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(58, 45, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(59, 47, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(60, 48, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(61, 49, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(62, 50, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(63, 51, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(64, 52, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(65, 53, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(66, 54, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(67, 55, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(68, 56, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(69, 57, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(70, 58, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(71, 59, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(72, 60, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(73, 61, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(74, 62, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(75, 63, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(76, 64, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(77, 65, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(78, 66, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),

(79, 67, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(80, 68, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(81, 69, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(82, 70, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(83, 71, 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(84, 67, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(85, 68, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(86, 69, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(87, 70, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(88, 71, 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(89, 67, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(90, 70, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),

(91, 72, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(92, 73, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(93, 74, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(94, 75, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
(95, 76, 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);
