<?php
/**
 * Yonna Response
 * @author hunzsig
 */

namespace Yonna\Response;

/**
 * Class Response
 * @package Core\Core
 */
class Response
{

    /**
     * safety debug backtrace
     * @param int $safeLv 安全等级，数字越高安全性越高
     * @param null $trace
     * @return array
     */
    private static function debug_backtrace($safeLv = 0, $trace = null)
    {
        $path = realpath(__DIR__ . '/../../../..');
        if (empty($trace)) $trace = debug_backtrace();
        foreach ($trace as $tk => $t) {
            if ($safeLv >= 3) {
                if (isset($t['line'])) unset($trace[$tk]['line']);
            }
            if ($safeLv >= 2) {
                if (isset($t['type'])) unset($trace[$tk]['type']);
            }
            if ($safeLv >= 1) {
                if (isset($t['object'])) unset($trace[$tk]['object']);
                if (isset($t['args'])) unset($trace[$tk]['args']);
                if (!empty($t['file'])) {
                    $trace[$tk]['file'] = str_replace($path, '#:Yonna', str_replace(
                        'vendor' . DIRECTORY_SEPARATOR . 'yonna' . DIRECTORY_SEPARATOR,
                        '',
                        $t['file']
                    ));
                }
            }
        }
        return $trace;
    }

    /**
     * @param $Collector
     * @return false|string
     */
    public static function handle(Collector $Collector)
    {
        return $Collector->response();
    }

    public static function success(string $msg = 'success', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::SUCCESS)
            ->setMsg($msg)
            ->setData($data);
        return $HandleCollector;
    }

    public static function broadcast(string $msg = 'broadcast', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::BROADCAST)
            ->setMsg($msg)
            ->setData($data);
        return $HandleCollector;
    }

    public static function goon(string $msg = 'goon', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::GOON)
            ->setMsg($msg)
            ->setData($data);
        return $HandleCollector;
    }

    public static function error(string $msg = 'error', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::ERROR)
            ->setMsg($msg)
            ->setData($data);
        return $HandleCollector;
    }

    public static function exception(string $msg = 'exception', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::EXCEPTION)
            ->setMsg($msg)
            ->setData($data)
            ->setExtra(array('debug_backtrace' => getenv('IS_DEBUG') === 'true'
                ? static::debug_backtrace(0, $data) : static::debug_backtrace(1, $data),
            ));
        return $HandleCollector;
    }

    public static function abort(string $msg = 'abort', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::ABORT)
            ->setMsg($msg)
            ->setExtra(array('debug_backtrace' => getenv('IS_DEBUG') === 'true'
                ? static::debug_backtrace(1, $data) : static::debug_backtrace(2, $data),
            ));
        return $HandleCollector;
    }

    public static function notPermission(string $msg = 'not permission', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::NOT_PERMISSION)
            ->setMsg($msg)
            ->setData($data)
            ->setExtra(array('debug_backtrace' => getenv('IS_DEBUG') === 'true'
                ? static::debug_backtrace(2, $data) : static::debug_backtrace(3, $data),
            ));
        return $HandleCollector;
    }

    public static function notFound(string $msg = 'not found', array $data = array(), $type = 'json', $charset = 'utf-8')
    {
        $HandleCollector = new Collector();
        $HandleCollector
            ->setResponseDataType($type)
            ->setCharset($charset)
            ->setCode(Code::NOT_FOUND)
            ->setMsg($msg)
            ->setExtra(array('debug_backtrace' => getenv('IS_DEBUG') === 'true'
                ? static::debug_backtrace(2, $data) : static::debug_backtrace(3, $data),
            ));
        return $HandleCollector;
    }

}