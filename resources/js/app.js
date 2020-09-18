require('./bootstrap');

Livewire.on('settingsUpdated', (settings) => {
  localStorage.setItem('settings', JSON.stringify(settings));

  window.location.reload()
})
