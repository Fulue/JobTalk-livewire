import './bootstrap';
import 'preline'
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'

Alpine.plugin(Clipboard)

Livewire.start()


Livewire.on('scrollToTop', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
