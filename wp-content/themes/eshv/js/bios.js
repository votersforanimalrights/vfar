const modal = document.getElementById('bio-modal');
const container = modal.querySelector('section');
const close = modal.querySelector('.modal-close');
const bios = document.querySelectorAll('.vfar-bios a');

function bioClick(e) {
  e.preventDefault();

  container.innerHTML = e.target.parentNode.parentNode.innerHTML.replace(/<br[ \\/]*?>/g, ' ');

  modal.style.display = 'block';
}

export default () => {
  if (bios && bios.length > 0) {
    for (let i = 0; i < bios.length; i += 1) {
      bios[i].onclick = bioClick;
    }

    close.onclick = () => {
      modal.style.display = 'none';
    };
  }
};
