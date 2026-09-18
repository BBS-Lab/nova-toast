# Changelog

All notable changes to `bbs-lab/nova-toast` will be documented in this file.

## v1.0.0 - 2026-09-18

First stable release of **Nova Toast** — flash a message from anywhere in your Laravel app and have it pop up as a Laravel Nova toast on the next page load, on **Nova 4 and Nova 5**.

### ✨ Features

- **Four static helpers** — `Toast::success()`, `Toast::warning()`, `Toast::error()`, `Toast::info()` map straight to Nova's own toasts.
- **Flash from anywhere** — controllers, observers, middleware, jobs, Nova actions. The toast shows on the next page load, so it pairs naturally with a redirect.
- **Zero configuration** — the service provider is auto-discovered; no config file, no assets to publish.
- **Tiny surface** — one class and one booting script, wired through `Nova::provideToScript`; flash data, so it shows once and clears.

### ✅ Quality

- **100% line coverage**, **100% MSI** mutation testing, PHPStan level 8, Pint.
- Verified in CI on **Nova 5** (Laravel 11/12/13, PHP 8.3/8.4/8.5) and **Nova 4** (Laravel 11, PHP 8.3/8.4).

### 📦 Requirements

PHP `^8.2` · Laravel Nova `^4.0 || ^5.0` · Laravel `^11.0 || ^12.0 || ^13.0`

> Nova 4 (through its Inertia dependency) tops out at PHP 8.4 and Laravel 11; on PHP 8.5 or Laravel 12+, use Nova 5.
