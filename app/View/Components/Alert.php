<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public string $type;
    public string $title;
    public string $message;

    public function __construct(string $type, string $title, string $message)
    {
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
    }

    public function getClassByType()
    {
        $classByType = [
            'success' => 'bg-green-100 border-green-500 text-green-700',
            'warning' => 'bg-orange-100 border-orange-500 text-orange-700',
            'error' => 'bg-red-100 border-red-500 text-red-700'
        ];

        return $classByType[$this->type];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
