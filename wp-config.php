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
define('DB_NAME', 'hotelmarbella');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'rosadocardenas');

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
define('AUTH_KEY', '0y:-3RVz3W1cR7X;kQ-3w{IL!]+o@I;OGP:oqet:-Uov2+J2)HyMTU3Az-l~]%6)'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '{NEI8^ @%6SSLVqw,+?8z}2&lw|]vR7az{ i07F2k-s16/jFx;6g~Y@|su5Nf)^s'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'Z|sc:rrk=]lIk6.y`5_3y-* /rPHd|-.E>9) u%iZ=z5e+w{H1!H:Ayk+gt?B^mn'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'EX&Zh[o? l4D;Toq[7s-?!Z-k/^CY)ayt+)}^;];AFnF#bp,V99I`Y.z27NnckIo'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'b+n;Iv6V+d;.FJd4.;~?$}dxPZWOJq3ZV k!{R|uXdJK]Kk v#;Opl-a8mZ ;br,'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', '5Om>yxtCCVCx=:@hd|B3U.OD)hD(wrV+([i~u0q^IuupQ{E#)LeKs$wP`|18Ok5s'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '%YHEKi0g:1~$5_K-vlUx4i4W^n$HbRV-%H+k{DSm4!ceC^^zWbKO%?%S;FG]:/`R'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'qyE23<uU_ Ar7GlHCsalPYGT+)/G2-=PpSm+K!^#EW_+7gF[]}xPDKK2nkG6`+l}'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'hotel_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

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

