<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class CustomPanelLayout extends Component
{
    protected string $view = 'forms.components.custom-panel-layout';

    public function __construct(protected string | \Closure $heading) {}

    public static function make(string | \Closure $heading): static
    {
        return app(static::class, ['heading' => $heading]);
    }

    public function getHeading()
    {
        return $this->evaluate($this->heading);
    }
}
