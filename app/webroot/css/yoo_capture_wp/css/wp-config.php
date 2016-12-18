<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'eadvert1_ferrocarriles');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'eadvert1_ferro');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'RbkM6i?u[f8b');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'o~<N~_KV#8+wL0/>d{h5D7_{=(+-hhRJYq7azgLR~zMM2E?wd]>[fRC$b4`x{W-.'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'jN3-is(H[4-~F,MKf9-K8Uvq+3|Inr5DTG_5gd#|Q{chz4<+y55{WWHh9P~!+YUB'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'qfN1pjRI4*mD-Lg9hTdBr=b=NT* -.wH=x LoEA:YZt-&wE#Egi2tU&x_ azKcCz'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'WI3RG$OVJW1Ie1jfE17Q[6#i,Fud%l}XRd}XL_CvKvo*2p;7C|r20Db(Gg[y>HJ+'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'dJUF~VRC|-8+@;pZcA/y|G m2M)2P1X<U*^7--6hDD0zPs}~FGB2_2q!PtwbN$vu'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'J )7#C89~eVqdTKl2_-?ezicY7oB0e2~Pmm2iDTE5/9&uqJLGw,>>g),ZAC6Oj%O'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '5{g--=E!b|#va)@|$&nQF|2N5a 1Rbw-sGS%8Y__!$4f]&#;n1@!Tc6D!wvY4&7W'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'NH)NVY)&~^[%oa{F+i*9bD_RMj+1q1sZaP++=s]>^)jk#3 t|m[PW5-q:#-{~ ,$'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');