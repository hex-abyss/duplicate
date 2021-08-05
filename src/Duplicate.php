<?php

namespace hexAbyss;

/**
 * To check is duplicate process
 *
 * @package hexAbyss
 */
class Duplicate
{
    private static $pid;
    private static $pidFile;
    private static $instance;

    /**
     * Duplicate constructor.
     * @param string $processPrefix
     */
    private function __construct($processPrefix = '')
    {
        self::$pid = getmypid();
        self::$pidFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $processPrefix . '_process.pid';

        if ($this->createPidFile()) {
            register_shutdown_function([$this, 'removePidFile']);
        }
    }

    /**
     * @param string $processPrefix
     * @return self
     */
    public static function getInstance($processPrefix = '')
    {
        if (null === self::$instance) {
            self::$instance = new self($processPrefix);
        }

        return self::$instance;
    }

    /**
     * @param string $message
     * @return void
     */
    public static function isExit($message = '')
    {
        if (self::isStopProcess()) {
            exit($message);
        }
    }

    /**
     * @return bool
     */
    public static function isStopProcess()
    {
        if (null === self::$instance) {
            self::getInstance();
        }

        if (file_exists(self::$pidFile)) {
            return ((int)file_get_contents(self::$pidFile)) !== self::$pid;
        }

        return true;
    }

    /**
     * @return bool
     */
    public static function removePidFile()
    {
        return file_exists(self::$pidFile) && !self::isStopProcess() && unlink(self::$pidFile);
    }

    /**
     * @return false|int
     */
    private function createPidFile()
    {
        return file_put_contents(self::$pidFile, self::$pid, LOCK_EX);
    }
}
