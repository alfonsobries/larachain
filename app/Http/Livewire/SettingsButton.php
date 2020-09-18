<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SettingsButton extends Component
{
    public $settings = [
        'dark' => false
    ];

    protected $rules = [
        'settings.dark' => 'required|boolean',
    ];

    public function mount()
    {
        if ($user = auth()->user()) {
            $this->settings = $user->getSettings();
        }
    }

    public function saveSettings()
    {
        $this->validate();

        if ($user = auth()->user()) {
            $user->update($this->settings);
        }

        session()->flash('mainSuccess', 'Settings succesfully updated!');

        $this->emit('settingsUpdated', $this->settings);
    }

    public function render()
    {
        return view('livewire.settings-button');
    }
}
