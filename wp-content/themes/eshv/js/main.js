const b = document.body;
const masthead = document.getElementById('masthead');
const subnav = document.getElementById('subnav');
const mainNav = document.getElementById('header-nav');
const mainNavLinks = mainNav.getElementsByTagName('a');
const subnavLinks = document.querySelectorAll('.subnav-links');
const burger = document.getElementById('hamburger');
const hero = document.querySelector('.hero');
const modal = document.querySelector('.modal');
const triggerModal = document.getElementById('join-us');
const inlineTriggerModal = document.querySelectorAll('.trigger-modal');

window.addEventListener('scroll', () => {
  if (window.scrollY >= 120) {
    subnav.classList.add('sticky-nav');
  } else {
    subnav.classList.remove('sticky-nav');
  }
});

masthead.addEventListener('mouseleave', () => {
  for (let i = 0; i < mainNavLinks.length; i += 1) {
    mainNavLinks[i].classList.remove('hovered');
  }
  for (let j = 0; j < subnavLinks.length; j += 1) {
    if (subnavLinks[j].classList.contains('active')) {
      subnavLinks[j].style.display = 'block';
    } else {
      subnavLinks[j].style.display = 'none';
    }
  }
});

const toggleHovered = link => {
  for (let i = 0; i < mainNavLinks.length; i += 1) {
    mainNavLinks[i].classList.remove('hovered');
  }
  link.classList.add('hovered');
};

const handleMouseover = e => {
  e.stopPropagation();

  toggleHovered(e.currentTarget);
  for (let j = 0; j < subnavLinks.length; j += 1) {
    subnavLinks[j].style.display = 'none';
  }
  const id = e.currentTarget.id.replace('nav-', '');
  const current = document.getElementById(`subnav-${id}`);
  current.style.display = 'block';
};

for (let i = 0; i < mainNavLinks.length; i += 1) {
  const link = mainNavLinks[i];
  const id = link.id.replace('nav-', '');
  const hasLinks = document.getElementById(`subnav-${id}`);
  if (hasLinks) {
    link.addEventListener('mouseover', handleMouseover);
  }
}

const subnavItems = document.querySelectorAll('.subnav-links a');

// eslint-disable-next-line
const handleClick = id => e => {
  if (!e.currentTarget.parentNode.classList.contains('active')) {
    return true;
  }
  e.preventDefault();

  for (let i = 0; i < subnavItems.length; i += 1) {
    subnavItems[i].classList.remove('active');
  }

  e.currentTarget.classList.add('active');

  const d = document.documentElement;
  const item = document.getElementById(id);
  const dest = item.offsetTop - 50;
  const durationLength = 600;
  let difference;
  if (dest > window.scrollY) {
    difference = dest - window.scrollY;
  } else {
    difference = window.scrollY - dest;
  }
  const move = duration => {
    setTimeout(() => {
      const offset = d.scrollTop + window.innerHeight;
      const height = d.offsetHeight;
      if ((durationLength !== duration && offset === height) || window.scrollY === dest) {
        return;
      }

      let to = dest;
      const delta = difference / duration * 10;
      if (dest > window.scrollY) {
        to = Math.min(window.scrollY + delta, dest);
      } else {
        to = Math.max(window.scrollY - delta, dest);
      }

      window.scrollTo(0, to);
      move(duration - 10);
    }, 10);
  };
  move(durationLength);
};

for (let i = 0; i < subnavItems.length; i += 1) {
  const subnavLink = subnavItems[i];
  const [, id] = subnavLink.href.split('#');
  subnavLink.addEventListener('click', handleClick(id));
}

const navOpenClass = 'navOpen';

const toggleMenu = e => {
  e.stopPropagation();

  if (b.classList.contains(navOpenClass)) {
    b.classList.remove(navOpenClass);
  } else {
    b.classList.add(navOpenClass);
  }
};

b.onclick = e => {
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

    const clickHandler = e => {
      e.preventDefault();

      bindForm();
      modal.style.display = 'block';
      modal.classList.add('simple-modal');
    };

    triggerModal.onclick = clickHandler;
    inlineTriggerModal.forEach(item => {
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
