const splash = document.querySelector('.splash-modal');
if (splash) {
  const triggerModal = document.getElementById('join-us');

  const modalClose = document.querySelector('.modal-close');
  modalClose.onclick = () => {
    splash.style.display = 'none';
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
        splash.style.display = 'none';
      };
      return form;
    };

    const clickHandler = e => {
      e.preventDefault();

      bindForm();
      splash.style.display = 'block';
      splash.classList.add('simple-modal');
    };

    triggerModal.onclick = clickHandler;

    const inlineTriggerModal = document.querySelectorAll('.trigger-modal');
    inlineTriggerModal.forEach(item => {
      item.addEventListener('click', clickHandler);
    });
  }
}
