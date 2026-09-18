<?php

declare(strict_types=1);

namespace BBSLab\NovaToast;

class Toast
{
    public const SESSION_KEY = 'nova-toast';

    public static function success(string $message): void
    {
        self::flash('success', $message);
    }

    public static function warning(string $message): void
    {
        self::flash('warning', $message);
    }

    public static function error(string $message): void
    {
        self::flash('error', $message);
    }

    public static function info(string $message): void
    {
        self::flash('info', $message);
    }

    protected static function flash(string $type, string $message): void
    {
        session()->flash(self::SESSION_KEY, compact('type', 'message'));
    }
}
