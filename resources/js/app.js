require('./bootstrap');

Livewire.on('settingsUpdated', (settings) => {
  localStorage.setItem('settings', JSON.stringify(settings));
  if (!window.settings || (settings.api !== window.settings.api)) {
    window.location.href="/"
  } else {
    window.location.reload()
  }
})


