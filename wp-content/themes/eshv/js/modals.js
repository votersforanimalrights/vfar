import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';

const DELAY_MS = 50;
const TRANSITION_MS = 600;

function setAgenda(agendaItems) {
  const modal = document.getElementById('agenda-modal');
  const container = modal.querySelector('section');
  const close = modal.querySelector('.modal-close');
  const wrapper = modal.querySelector('.modal-wrapper');

  const agendaClick = e => {
    e.preventDefault();

    container.innerHTML = e.currentTarget.querySelector('section').innerHTML;

    modal.style.display = 'block';
    setTimeout(() => {
      wrapper.classList.add('animated-wrapper');
    }, DELAY_MS);
    disableBodyScroll(container.querySelector('article'));
  };

  for (let i = 0; i < agendaItems.length; i += 1) {
    agendaItems[i].onclick = agendaClick;
  }

  close.onclick = () => {
    wrapper.classList.remove('animated-wrapper');
    setTimeout(() => {
      modal.style.display = 'none';
    }, TRANSITION_MS);
    enableBodyScroll(container.querySelector('article'));
  };
}

function setBios(bios) {
  const modal = document.getElementById('bio-modal');
  const container = modal.querySelector('section');
  const close = modal.querySelector('.modal-close');
  const wrapper = modal.querySelector('.modal-wrapper');

  const bioClick = e => {
    e.preventDefault();

    container.innerHTML = e.target.parentNode.parentNode.innerHTML.replace(/<br[ \\/]*?>/g, ' ');

    modal.style.display = 'block';
    setTimeout(() => {
      wrapper.classList.add('animated-wrapper');
    }, DELAY_MS);
    disableBodyScroll(container.querySelector('article'));
  };

  for (let i = 0; i < bios.length; i += 1) {
    bios[i].onclick = bioClick;
  }

  close.onclick = () => {
    wrapper.classList.remove('animated-wrapper');
    setTimeout(() => {
      modal.style.display = 'none';
    }, TRANSITION_MS);
    enableBodyScroll(container.querySelector('article'));
  };
}

export default () => {
  const bios = document.querySelectorAll('.vfar-bios a');
  if (bios && bios.length > 0) {
    setBios(bios);
  }

  const agendaItems = document.querySelectorAll('.agenda-content li');
  if (agendaItems && agendaItems.length > 0) {
    setAgenda(agendaItems);
  }
};
