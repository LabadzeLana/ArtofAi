/**
 * Mobile Hamburger Menu Handler
 */
document.addEventListener('DOMContentLoaded', () => {
  const toggleBtn = document.getElementById('hamburger-toggle');
  const overlay = document.getElementById('mobile-menu-overlay');
  const closeBtn = document.getElementById('mobile-menu-close');
  const drawer = document.getElementById('mobile-menu-drawer');
  const menuLinks = document.querySelectorAll('.mobile-nav-links a');

  if (!toggleBtn || !overlay) return;

  const openMenu = () => {
    toggleBtn.classList.add('is-active');
    toggleBtn.setAttribute('aria-expanded', 'true');
    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
    document.body.classList.add('mobile-menu-open');
  };

  const closeMenu = () => {
    toggleBtn.classList.remove('is-active');
    toggleBtn.setAttribute('aria-expanded', 'false');
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('mobile-menu-open');
  };

  const toggleMenu = () => {
    const isOpen = overlay.classList.contains('is-open');
    if (isOpen) {
      closeMenu();
    } else {
      openMenu();
    }
  };

  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    toggleMenu();
  });

  if (closeBtn) {
    closeBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      closeMenu();
    });
  }

  // Tap-outside-to-close behavior (click on backdrop overlay)
  overlay.addEventListener('click', (e) => {
    if (drawer && !drawer.contains(e.target)) {
      closeMenu();
    }
  });

  // ESC key to close
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
      closeMenu();
    }
  });

  // Close menu on link click
  menuLinks.forEach((link) => {
    link.addEventListener('click', (e) => {
      closeMenu();
      const href = link.getAttribute('href');

      // Smooth scroll if link is an internal anchor on the current page
      if (href && href.startsWith('#')) {
        const targetElement = document.querySelector(href);
        if (targetElement) {
          e.preventDefault();
          targetElement.scrollIntoView({ behavior: 'smooth' });
        }
      }
    });
  });
});
