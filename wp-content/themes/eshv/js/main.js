const b = document.body;
const burger = document.getElementById('hamburger');
const hero = document.querySelector('.hero');
const modal = document.querySelector('.modal');
const triggerModal = document.getElementById('join-the-pack');
const inlineTriggerModal = document.querySelectorAll('.trigger-modal');

const navOpenClass = 'navOpen';

const toggleMenu = (e) => {
  e.stopPropagation();

  if (b.classList.contains(navOpenClass)) {
    b.classList.remove(navOpenClass);
  } else {
    b.classList.add(navOpenClass);
  }
};

b.onclick = (e) => {
  if (b.classList.contains(navOpenClass)) {
    toggleMenu(e);
  }
};
burger.onclick = toggleMenu;

if (hero && b.classList.contains('home')) {
  const p = hero.querySelector('p');
  if (p) {
    setTimeout(() => p.classList.add('loaded'), 500);
  }
}

if (modal) {
  const modalClose = document.querySelector('.modal-close');
  modalClose.onclick = () => {
    modal.style.display = 'none';
  };
  document.cookie = 'splash=1; path=/;';

  if (triggerModal) {
    let form;
    const bindForm = () => {
      if (form) {
        return form;
      }
      form = document.querySelector('#modal-form-id #new_answer');
      form.onsubmit = () => {
        modal.style.display = 'none';
      };
      return form;
    };

    const clickHandler = (e) => {
      e.preventDefault();

      bindForm();
      modal.style.display = 'block';
      modal.classList.add('simple-modal');
    };

    triggerModal.onclick = clickHandler;
    inlineTriggerModal.forEach((item) => {
      item.addEventListener('click', clickHandler);
    });
  }
}

window.onload = () => {
  setTimeout(() => {
    const welcomeMessage = document.getElementById('action_welcome_message');
    if (welcomeMessage) {
      b.classList.add('action-logged-in');
    }
  }, 0);
};
