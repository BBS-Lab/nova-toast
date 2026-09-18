<?php

declare(strict_types=1);

use BBSLab\NovaToast\Toast;

it('has no toast flashed before anything runs', function () {
    expect(session(Toast::SESSION_KEY))->toBeNull();
});

it('flashes the message under the toast session key', function (string $method, string $type) {
    Toast::{$method}('some message');

    expect(session(Toast::SESSION_KEY))->toBe([
        'type' => $type,
        'message' => 'some message',
    ]);
})->with([
    'success' => ['success', 'success'],
    'warning' => ['warning', 'warning'],
    'error' => ['error', 'error'],
    'info' => ['info', 'info'],
]);
