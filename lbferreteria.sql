CREATE DATABASE lbferrereria;

USE lbferrereria;

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `c_id` int(11) NOT NULL,
  `c_idproductofk` int(11) NOT NULL,
  `c_nombre` varchar(500) NOT NULL,
  `c_marca` varchar(500) NOT NULL,
  `c_precio` int(11) NOT NULL,
  `c_cantidad` int(11) NOT NULL,
  `c_total` int(11) NOT NULL,
  `c_idusuariofk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `p_id` int(11) NOT NULL,
  `p_codigo` varchar(10) NOT NULL,
  `p_nombre` varchar(500) NOT NULL,
  `p_categoria` varchar(200) NOT NULL,
  `p_marca` varchar(200) NOT NULL,
  `p_precio` int(11) NOT NULL,
  `p_stock` int(11) NOT NULL,
  `p_foto` varchar(500) NOT NULL,
  `p_fecha_vencimiento` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `u_id` int(11) NOT NULL,
  `u_nombres` varchar(500) NOT NULL,
  `u_apellidos` varchar(500) NOT NULL,
  `u_identificacion` bigint(20) NOT NULL,
  `u_email` varchar(500) NOT NULL,
  `u_ciudad` varchar(200) NOT NULL,
  `u_direccion` text NOT NULL,
  `u_celular` bigint(20) NOT NULL,
  `u_tipo` int(11) NOT NULL,
  `u_contrasena` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`u_id`, `u_nombres`, `u_apellidos`, `u_identificacion`, `u_email`, `u_ciudad`, `u_direccion`, `u_celular`, `u_tipo`, `u_contrasena`) VALUES
(1, 'ADMIN', 'ADMINISTRADOR', 1234567890, 'admin@hotmail.com', 'Bogota', 'Calle Principal', 3210001111, 1, '12345');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `v_id` int(11) NOT NULL,
  `v_factura` varchar(500) NOT NULL,
  `v_nombre` varchar(500) NOT NULL,
  `v_marca` varchar(500) NOT NULL,
  `v_precio` int(11) NOT NULL,
  `v_cantidad` int(11) NOT NULL,
  `v_total` int(11) NOT NULL,
  `v_fkidusuario` int(11) NOT NULL,
  `v_identificacion` bigint(20) NOT NULL,
  `v_nombresapellidos` varchar(500) NOT NULL,
  `v_ciudad` varchar(300) NOT NULL,
  `v_direccion` varchar(500) NOT NULL,
  `v_celular` bigint(20) NOT NULL,
  `v_fecha` date NOT NULL,
  `v_hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `idproductofk` (`c_idproductofk`),
  ADD KEY `idusuariofk` (`c_idusuariofk`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`p_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`u_id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`v_id`),
  ADD KEY `fkidusuario` (`v_fkidusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT;
  

--
-- Restricciones para tablas volcadas
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `idproductofk` FOREIGN KEY (`c_idproductofk`) REFERENCES `producto` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idusuariofk` FOREIGN KEY (`c_idusuariofk`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


-- Crear tabla inventario
CREATE TABLE `inventario` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_idproductofk` int(11) NOT NULL,
  `i_cantidad` int(11) NOT NULL,
  `i_idusuariofk` int(11) NOT NULL,
  `i_estado` int(11) NOT NULL,
  `i_fecha` date NOT NULL,
  `i_hora` time NOT NULL,
  PRIMARY KEY (`i_id`),
  KEY `i_idproductofk` (`i_idproductofk`),
  KEY `i_idusuariofk` (`i_idusuariofk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Agregar las restricciones de llave foránea después de crear la tabla
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`i_idproductofk`) REFERENCES `producto` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`i_idusuariofk`) REFERENCES `usuario` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;