<?php

class DotEnv
{
    /**
     * The directory where the .env file can be located.
     *
     * @var string
     */
    protected static $path;


    public function __construct()
    {
        self::$path = './.env';
    }

    private static function load(): void
    {
        self::$path = $_SERVER['HTTP_HOST'] === 'localhost' ? "./.env.local" : './.env';;
        if (!is_readable(self::$path)) {
            throw new \RuntimeException(sprintf('%s file is not readable', self::$path));
        }

        $lines = file(self::$path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {

            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }

    static public function find($item): string | int
    {
        self::load();
        return getEnv($item);
    }

}
