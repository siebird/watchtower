<?php
namespace siebird\WatchTower\services;

use craft\base\Component;

class App extends Component
{
	public $settings;

	public function init(): void
    {
        $this->settings = new Settings();
    }
}