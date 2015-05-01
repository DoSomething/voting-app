<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use SettingsRepository;

class SettingsComposer
{

    /**
     * The settings repository.
     *
     * @var SettingsRepository
     */
    protected $settings;

    /**
     * Create a new profile composer.
     * @param SettingsRepository $settingsRepository
     */
    public function __construct(SettingsRepository $settingsRepository)
    {
        // Dependencies automatically resolved by service container...
        $this->settingsRepository = $settingsRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     */
    public function compose(View $view)
    {
        $settings = $this->settingsRepository->all();
        $view->with('settings', $settings);
    }
}
