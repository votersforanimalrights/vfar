import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';

function setAgenda(agendaItems) {
  const modal = document.getElementById('agenda-modal');
  const container = modal.querySelector('section');
  const close = modal.querySelector('.modal-close');

  const agendaClick = e => {
    e.preventDefault();

    container.innerHTML = e.currentTarget.querySelector('section').innerHTML;

    modal.style.display = 'block';
    disableBodyScroll(container.querySelector('article'));
  };

  for (let i = 0; i < agendaItems.length; i += 1) {
    agendaItems[i].onclick = agendaClick;
  }

  close.onclick = () => {
    modal.style.display = 'none';
    enableBodyScroll(container.querySelector('article'));
  };
}

function setBios(bios) {
  const modal = document.getElementById('bio-modal');
  const container = modal.querySelector('section');
  const close = modal.querySelector('.modal-close');

  const bioClick = e => {
    e.preventDefault();

    container.innerHTML = e.target.parentNode.parentNode.innerHTML.replace(/<br[ \\/]*?>/g, ' ');

    modal.style.display = 'block';
    disableBodyScroll(container.querySelector('article'));
  };

  for (let i = 0; i < bios.length; i += 1) {
    bios[i].onclick = bioClick;
  }

  close.onclick = () => {
    modal.style.display = 'none';
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
