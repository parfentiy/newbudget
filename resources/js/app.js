import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

setTimeout(function(){ window.location.reload(); }, 15*60*1000)
