<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;

class CustomSelect extends Component
{
    protected string $view = 'forms.components.custom-select';

    protected array | \Closure | null $options = null;

    public function __construct(protected string | \Closure $heading) {}

    public static function make(string | \Closure $heading): static
    {
        return app(static::class, ['heading' => $heading]);
    }

    public function getHeading()
    {
        return $this->evaluate($this->heading);
    }

    public function options(array | \Closure | null $options): static
    {
        $this->options = $options;
        return $this;
    }

    public function getOptions()
    {
        return $this->evaluate($this->options);
    }
}
