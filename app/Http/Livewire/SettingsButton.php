<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class SettingsButton extends Component
{
    public $settings = [
        'dark' => false,
        'api' => User::SETTING_API_MAINNET,
    ];

    protected $rules = [
        'settings.dark' => 'required|boolean',
        'settings.api' => 'string|in:' . User::SETTING_API_MAINNET . ',' . User::SETTING_API_DEVNET,
    ];

    public function mount()
    {
        if ($user = auth()->user()) {
            $this->settings = $user->getSettings();
        } else {
            $this->settings['api'] = guess_api_from_session();
        }
    }

    public function saveSettings()
    {
        $settings = $this->validate()['settings'];

        if ($user = auth()->user()) {
            $user->update($settings);
        } else {
            set_api_for_session($settings['api']);
        }

        session()->flash('mainSuccess', 'Settings succesfully updated!');

        $this->emit('settingsUpdated', $settings);
    }

    public function render()
    {
        return view('livewire.settings-button');
    }
}
