<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/**
 * CONSTANTES
 */
defined('APP_NAME')             or define('APP_NAME', 'Glosoft');
defined('APP_FAVICON')          or define('APP_FAVICON', 'assets/favicon');
defined('APP_IMG')              or define('APP_IMG', 'assets/img');

// ASSETS
defined('ADMIN_CSS')            or define('ADMIN_CSS', 'assets/admin/css');
defined('ADMIN_JS')             or define('ADMIN_JS', 'assets/admin/js');
defined('ADMIN_FONTS')          or define('ADMIN_FONTS', 'assets/admin/fonts');
defined('ADMIN_PLUGINS')        or define('ADMIN_PLUGINS', 'assets/admin/plugins');

defined('UPLOADS')              or define('UPLOADS', 'assets/uploads');

// RUTAS ADMIN
defined('ADMIN_PATH')           or define('ADMIN_PATH', 'admin');
defined('DASHBOARD_PATH')       or define('DASHBOARD_PATH', ADMIN_PATH . '/dashboard');
defined('PERFIL_PATH')          or define('PERFIL_PATH', ADMIN_PATH . '/perfil');
defined('USUARIOS_PATH')        or define('USUARIOS_PATH', ADMIN_PATH . '/usuarios');
defined('EXPEDIENTES_PATH')     or define('EXPEDIENTES_PATH', ADMIN_PATH . '/expedientes');
defined('INSPECCIONES_PATH')    or define('INSPECCIONES_PATH', ADMIN_PATH . '/inspecciones');
defined('AFILIACIONES_PATH')       or define('AFILIACIONES_PATH', ADMIN_PATH . '/afiliados');
define('INSPECTORES_PATH', ADMIN_PATH . '/inspectores');
define('VERIFICADORES_PATH', ADMIN_PATH . '/verificadores');
define('LIQUIDADORES_PATH', ADMIN_PATH . '/liquidadores');
define('USERS_ELIMINADOS_PATH', ADMIN_PATH . '/userseliminados');

// LOGIN
define('LOGIN_PATH', ADMIN_PATH . '/login');

// MODEL
//defined('USUARIO_MODEL')        OR define('USUARIO_MODEL', 'Usuario_model');
define('USUARIOS_MODEL', ADMIN_PATH . '/Usuarios_model');
define('USUARIOS_TIPO_MODEL', ADMIN_PATH . '/Usuarios_tipo_model');
define('AFILIACIONES_MODEL', ADMIN_PATH . '/Afiliaciones_model');
define('EMPLEADORES_MODEL', ADMIN_PATH . '/Empleadores_model');
define('INSPECCIONES_MODEL', ADMIN_PATH . '/Inspecciones_model');
define('EXPEDIENTES_MODEL', ADMIN_PATH . '/Expedientes_model');
define('TRABAJADORES_ENCONTRADOS_MODEL', ADMIN_PATH . '/Trabajadores_encontrados_model');
define('AUDIOS_MODEL', ADMIN_PATH . '/Audios_model');
define('DOCUMENTOS_MODEL', ADMIN_PATH . '/Documentos_model');

// IMAGEN DEFAULTS
defined('IMG_DEFAULT_USUARIOS') or define('IMG_DEFAULT_USUARIOS', 'nofoto.png');
