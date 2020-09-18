require('./bootstrap');

Livewire.on('settingsUpdated', () => {
  window.location.reload()
})
