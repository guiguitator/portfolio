import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['menu'];

    openMenu() {
        document.body.style.overflow = 'hidden';
        this.menuTarget.classList.add('visible');
    }

    closeMenu() {
        document.body.style.overflow = 'auto'; 
        this.menuTarget.classList.remove('visible');
    }
}
