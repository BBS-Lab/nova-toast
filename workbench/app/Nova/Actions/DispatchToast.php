<?php

declare(strict_types=1);

namespace Workbench\App\Nova\Actions;

use BBSLab\NovaToast\Toast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Actions\ActionResponse;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

/**
 * Workbench-only action to try nova-toast live: pick a message + level, flash a
 * toast, then hard-redirect so the reload consumes the flash and fires the
 * toast — the same flash + redirect flow a middleware would use in production.
 */
class DispatchToast extends Action
{
    /**
     * Runnable from the index without selecting a row.
     *
     * @var bool
     */
    public $standalone = true;

    /**
     * @param  Collection<int, Model>  $models
     */
    public function handle(ActionFields $fields, Collection $models): ActionResponse
    {
        $message = (string) $fields->message;

        match ($fields->level) {
            'success' => Toast::success($message),
            'warning' => Toast::warning($message),
            'error' => Toast::error($message),
            default => Toast::info($message),
        };

        // Hard redirect (window.location) back to the index: a full page load is
        // what re-runs Nova.booting() so toast.js can read the flashed toast.
        // A client-side visit() would not re-boot Nova, so the toast never shows.
        return ActionResponse::redirect(rtrim(Nova::path(), '/').'/resources/users');
    }

    /**
     * @return array<int, Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Text::make('Message')
                ->rules('required'),

            Select::make('Level')
                ->options([
                    'success' => 'Success',
                    'warning' => 'Warning',
                    'error' => 'Error',
                    'info' => 'Info',
                ])
                ->default('info')
                ->displayUsingLabels()
                ->rules('required'),
        ];
    }
}
