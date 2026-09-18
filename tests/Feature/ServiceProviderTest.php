<?php

declare(strict_types=1);

use BBSLab\NovaToast\Toast;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

it('provides the flashed toast to Nova scripts when serving', function (): void {
    Toast::warning('Heads up');

    // Nova::serving() registers via Event::listen(ServingNova::class), so firing
    // the event runs the package provider callback (registers the script + var).
    // Resolve the event from the container so its constructor is autowired for
    // whichever Nova major is installed — Nova 4 takes (Request), Nova 5 takes
    // (Application, Request).
    event(app(ServingNova::class));

    expect(Nova::jsonVariables(request()))
        ->toHaveKey('novaToast')
        ->and(Nova::jsonVariables(request())['novaToast'])
        ->toBe(['type' => 'warning', 'message' => 'Heads up']);

    $script = collect(Nova::allScripts())->first(
        static fn ($asset): bool => $asset->name() === 'nova-toast'
    );

    expect($script)->not->toBeNull()
        ->and($script->path())->toEndWith('resources/js/toast.js')
        // Absolute path to a real file — kills the "drop __DIR__" mutant, which
        // would leave a root-relative path that resolves to nothing on disk.
        ->and(file_exists($script->path()))->toBeTrue();
});

it('provides a null toast variable when nothing was flashed', function (): void {
    event(app(ServingNova::class));

    expect(Nova::jsonVariables(request()))
        ->toHaveKey('novaToast')
        ->and(Nova::jsonVariables(request())['novaToast'])
        ->toBeNull();
});
