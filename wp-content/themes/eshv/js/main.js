import modals from './modals';
import nav from './nav';
import './splash';

const hero = document.querySelector('.hero');

if (hero && document.body.classList.contains('home')) {
  const p = hero.querySelector('p');
  if (p) {
    setTimeout(() => p.classList.add('loaded'), 500);
  }
}

modals();
nav();

window.onload = () => {
  setTimeout(() => {
    const welcomeMessage = document.getElementById('action_welcome_message');
    if (welcomeMessage) {
      document.body.classList.add('action-logged-in');
    }
  }, 0);
};
