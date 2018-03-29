<?php

$version = 70;

return new  Detectors\DetectVersionSet($version, [
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_FUNC_DECL) {
        return false;
      }
      // @todo improve
      return isset($node->children['returnType']);
    }, 
    'Return type declaration'
  ),
  new Detectors\DetectByFeature($version, 
    function ($node) {
      if ($node->kind !== ast\AST_BINARY_OP) {
        return false;
      }
      return ($node->flags === ast\flags\BINARY_COALESCE);
    }, 
    'Coallese operator'
  ),
  new Detectors\DetectByFeature($version, 
      function($node) {
        return ($node->flags === ast\flags\BINARY_SPACESHIP);
      },
      'Spaceship operator'
  ),
  new Detectors\DetectByFeature($version, 
    function ($node) {
      return ($node->kind === ast\AST_GROUP_USE);
    },
    'Group use namespace'
  ),
  new Detectors\DetectByFeature($version, 
    function($node) {
      if ($node->kind !== ast\AST_NEW) {
        return false;
      }

      return ($node->children['class']->flags === ast\flags\CLASS_ANONYMOUS);
    },
    'Uses anonymous classes'
  ),
  new Detectors\DetectByFunction($version, [
    'random_bytes',
    'random_int',
    'error_clear_last',
    'gmp_random_seed',
    'intdiv',
    'preg_replace_callback_array',
    'gc_mem_caches',
    'get_resources',
    'posix_setrlimit',
    'inflate_add',
    'deflate_add',
    'inflate_init',
    'deflate_init',
  ]),
  new Detectors\DetectByClass($version, [
    'IntlChar',
    'ReflectionGenerator',
    'ReflectionType',
    'SessionUpdateTimestampHandlerInterface',
    'Throwable',
    'Error',
    'TypeError',
    'ParseError',
    'AssertionError',
    'ArithmeticError',
    'DivisionByZeroError',
 ]),
  new Detectors\DetectByConst($version, [
    'PHP_INT_MIN',
    'IMG_WEBP',
    'JSON_ERROR_INVALID_PROPERTY_NAME',
    'JSON_ERROR_UTF16',
    'LIBXML_BIGLINES',
    'PREG_JIT_STACKLIMIT_ERROR',
    'POSIX_RLIMIT_AS',
    'POSIX_RLIMIT_CORE',
    'POSIX_RLIMIT_CPU',
    'POSIX_RLIMIT_DATA',
    'POSIX_RLIMIT_FSIZE',
    'POSIX_RLIMIT_LOCKS',
    'POSIX_RLIMIT_MEMLOCK',
    'POSIX_RLIMIT_MSGQUEUE',
    'POSIX_RLIMIT_NICE',
    'POSIX_RLIMIT_NOFILE',
    'POSIX_RLIMIT_NPROC',
    'POSIX_RLIMIT_RSS',
    'POSIX_RLIMIT_RTPRIO',
    'POSIX_RLIMIT_RTTIME',
    'POSIX_RLIMIT_SIGPENDING',
    'POSIX_RLIMIT_STACK',
    'POSIX_RLIMIT_INFINITY',
    'ZLIB_ENCODING_RAW',
    'ZLIB_ENCODING_DEFLATE',
    'ZLIB_ENCODING_GZIP',
    'ZLIB_FILTERED',
    'ZLIB_HUFFMAN_ONLY',
    'ZLIB_FIXED',
    'ZLIB_RLE',
    'ZLIB_DEFAULT_STRATEGY',
    'ZLIB_BLOCK',
    'ZLIB_FINISH',
    'ZLIB_FULL_FLUSH',
    'ZLIB_NO_FLUSH',
    'ZLIB_PARTIAL_FLUSH',
    'ZLIB_SYNC_FLUSH',
  ]),
  ]);