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
(1, 'Administrador Aprore', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(2, 'Staff Aprore', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(3, 'Administrador Cliente', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(4, 'Secretaria Cliente', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL),
(5, 'Trabajador', NULL, '2020-09-19 16:43:03', '2020-09-19 16:43:03', NULL);

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `persona_id`, `role_id`, `empresa_id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `profile_photo_path`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 'Luis Antonio Morales Velazquez', 'morales.lamv@gmail.com', NULL, '$2y$10$XjzOQzTvz50nXaCx2YyTReYcZfJt3iw7B8AHkB4fRi4G9ZIwWk17q', NULL, NULL, NULL, NULL, '2020-09-19 16:43:04', '2020-09-19 16:43:04', NULL);

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1, 'Registro de Clientes', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

--
-- Volcado de datos para la tabla `modulo_user`
--

INSERT INTO `empresa_modulo` (`id`, `empresa_id`, `modulo_id`, `created_at`, `updated_at`, `deleted_at`) VALUES 
(1, '1', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);

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
(20, 'Empresa.secre.destroy', NULL, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);


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
(20, 20, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL);