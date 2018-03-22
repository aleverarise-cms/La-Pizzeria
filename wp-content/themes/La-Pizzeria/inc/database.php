<?php 

	// INICIALIZA LA CREACION DE LAS TABLAS NUEVAS
	function lapizzeria_database(){
		// NOS DA LOS METODOS PARA TRABAJAR CON TABLAS
		global $wpdb;
		// AGREGAMOS LA VERSION
		global $lapizzeria_dbversion;
		$lapizzeria_dbversion = '1.0';

		// OBTENEMOS EL PREFIJO
		$tabla = $wpdb->prefix . 'reservaciones';
		
		// OBTENEMOS EL COLLATION DE LA INSTALACION
		$charset_collate = $wpdb->get_charset_collate();
		
		// AGREGAMOS LA ESTRUCTURA DE LA BASE DE DATOS
		$sql = "CREATE TABLE $tabla (
			id int NOT NULL AUTO_INCREMENT,
			nombre varchar(50) NOT NULL,
			fecha datetime NOT NULL,
			correo varchar(50) DEFAULT '' NOT NULL,
			telefono varchar(10) NOT NULL,
			mensaje longtext NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		// SE NECESITA DBDELTA PARA EJECUTAR EL SQL Y ESTA EN LA SIGUIENTE OPCION
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		// AGREGAMOS LA VERSION DE LA BASE DE DATOS, PARA COMPARAR
		add_option('lapizzeria_dbversion', $lapizzeria_dbversion);
		
		// ACTUALIZAR EN CASO DE SER NECESARIO
		$version_actual = get_option('lapizzeria_version');

		// COMPARAMOS LAS DOS VERSIONES
		if($lapizzeria_dbversion != $version_actual){
			$tabla = $wpdb->prefix . 'reservaciones';
		
			// AQUI SE REALIZARIA LAS ACTUALIZACIONES
			$sql = "CREATE TABLE $tabla (
				id int NOT NULL AUTO_INCREMENT,
				nombre varchar(50) NOT NULL,
				fecha datetime NOT NULL,
				correo varchar(50) DEFAULT '' NOT NULL,
				telefono varchar(10) NOT NULL,
				mensaje longtext NOT NULL,
				PRIMARY KEY (id)
			) $charset_collate;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);

			// AQUI ACTUALIZAMOS A LA VERSION NUEVA
			update_option('lapizzeria_dbversion', $lapizzeria_dbversion);
		}
	}

	add_action('after_setup_theme', 'lapizzeria_database');

	// FUNCION PARA COMPROBAR QUE LA VERSION INSTALADA ES IGUAL A LA BASE DE DATOS NUEVA
	function lapizzeria_revisar(){
		global $lapizzeria_dbversion;
		if (get_site_option('lapizzeria_dbversion') != $lapizzeria_dbversion) {
			lapizzeria_database();
		}
	}

	add_action('plugins_loaded', 'lapizzeria_revisar');

?>