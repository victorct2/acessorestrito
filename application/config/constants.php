<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/*
 Constantes de URLS de Imagens e vídeos do webservice
 -- Elom Waizmam
*/
defined('IMAGEM_VIDEO')        OR define('IMAGEM_VIDEO', 'https://intranet.canalsaude.fiocruz.br/assets/img/videos/'); // no errors
defined('URL_VIDEO')        OR define('URL_VIDEO', 'https://intranet.canalsaude.fiocruz.br/streaming/'); // no errors
defined('IMAGEM_PROGRAMA')        OR define('IMAGEM_PROGRAMA', 'https://intranet.canalsaude.fiocruz.br/assets/img/programas/'); // no errors
defined('IMAGEM_PARCEIRO')        OR define('IMAGEM_PARCEIRO', 'https://intranet.canalsaude.fiocruz.br/assets/img/parceiros/'); // no errors
defined('IMAGEM_PROGRAMA_PARCEIRO')        OR define('IMAGEM_PROGRAMA_PARCEIRO', 'https://intranet.canalsaude.fiocruz.br/assets/img/parceiros/programas/'); // no errors
defined('IMAGEM_SLIDESHOW')        OR define('IMAGEM_SLIDESHOW', 'https://intranet.canalsaude.fiocruz.br/assets/img/slideshow/'); // no errors
defined('IMAGEM_FIGURINO')        OR define('IMAGEM_FIGURINO', 'https://intranet.canalsaude.fiocruz.br/assets/img/figurino/'); // no errors
defined('IMAGEM_TESTEIRA')        OR define('IMAGEM_TESTEIRA', 'https://intranet.canalsaude.fiocruz.br/assets/img/testeiras/'); // no errors
defined('IMAGEM_BANNER')        OR define('IMAGEM_BANNER', 'https://intranet.canalsaude.fiocruz.br/assets/img/banners/'); // no errors
defined('IMAGEM_IMAGENS')        OR define('IMAGEM_IMAGENS', 'https://intranet.canalsaude.fiocruz.br/assets/img/imagens/'); // no errors
defined('SEM_IMAGEM')        OR define('SEM_IMAGEM', 'https://intranet.canalsaude.fiocruz.br/assets/img/sem_imagem.png'); // no errors
defined('IMAGEM_PARCEIROS')        OR define('IMAGEM_PARCEIROS', 'https://intranet.canalsaude.fiocruz.br/assets/img/programas/parceiros-mini.jpg'); // no errors
defined('IMAGEM_NOTICIA')        OR define('IMAGEM_NOTICIA', 'http://localhost/acessorestrito/assets/img/noticias/'); // no errors
defined('IMAGEM_PARCEIRO_INST')        OR define('IMAGEM_PARCEIRO_INST', 'https://intranet.canalsaude.fiocruz.br/assets/img/parceirosInstitucionais/'); // no errors
defined('IMAGEM_AVATAR')        OR define('IMAGEM_AVATAR', 'https://intranet.canalsaude.fiocruz.br/assets/img/avatar/'); // no errors
defined('IMAGEM_PODCAST')        OR define('IMAGEM_PODCAST', 'https://intranet.canalsaude.fiocruz.br/assets/img/podcast/');
defined('URL_PODCAST_DOWNLOAD')        OR define('URL_PODCAST_DOWNLOAD', 'https://intranet.canalsaude.fiocruz.br/assets/podcast/');
defined('CLOSED_CAPTION')        OR define('CLOSED_CAPTION', 'https://intranet.canalsaude.fiocruz.br/assets/closedCaption/');
defined('RESTRITO_UPLOAD')        OR define('RESTRITO_UPLOAD', 'assets/arquivos/restrito/');
defined('IMAGEM_NOTICIA_SITE')        OR define('IMAGEM_NOTICIA_SITE', 'http://157.86.124.178/acessorestrito/assets/img/noticias/');
