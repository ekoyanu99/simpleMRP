<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderDetailsCard extends Component
{
    public $orderMstr;
    public $details;
    public $items;

    public $title;
    public $addRoute;
    public $updateRoute;
    public $destroyRoute;
    public $getDescUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $orderMstr,
        $details,
        $items,
        $title,
        $addRoute,
        $updateRoute,
        $destroyRoute,
        $getDescUrl
    ) {
        $this->orderMstr = $orderMstr;
        $this->details = $details;
        $this->items = $items;
        $this->title = $title;
        $this->addRoute = $addRoute;
        $this->updateRoute = $updateRoute;
        $this->destroyRoute = $destroyRoute;
        $this->getDescUrl = $getDescUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-details-card');
    }
}
