<?php

namespace app\composer;

use Composer\Script\Event;

class Installer
{
    public static function postInstall($event): void
    {
        static::runCommands($event, __METHOD__);
    }

    /**
     * @param Event  $event
     * @param string $extraKey
     *
     * @return void
     */
    protected static function runCommands(Event $event, string $extraKey): void
    {
        $params = $event->getComposer()->getPackage()->getExtra();
        if (isset($params[$extraKey]) && is_array($params[$extraKey])) {
            foreach ($params[$extraKey] as $method => $args) {
                call_user_func_array([static::class, $method], (array)$args);
            }
        }
    }

    public static function createDirectories(array $paths): void
    {
        foreach ($paths as $dir => $permissions) {
            /** @noinspection NotOptimalIfConditionsInspection */
            if (@mkdir($dir, \octdec($permissions), true) || @is_dir($dir)) {
                @chmod($dir, \octdec($permissions));
            } else {
                echo "Directory \"{$dir}\" was not created" . PHP_EOL;
            }
        }
    }
}
