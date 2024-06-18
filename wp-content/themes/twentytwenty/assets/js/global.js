const handleMobileNav = () => {
  if (window.innerWidth > 990) return;

  const navBtn = document.querySelector('#nav-btn');
  const headerContainer = document.querySelector('header');
  const navClose = document.querySelector('#nav-close');

  navClose.addEventListener('click', () => {
    headerContainer.classList.toggle('active')
  });

  navBtn.addEventListener('click', () => {
    headerContainer.classList.toggle('active')
  })
};

const togleProgram = () => {
  const coursesItems = document.querySelector('.courses--items');

  if (!coursesItems) return;

  coursesItems.addEventListener('click', evt => {
    const element = evt.target;

    if (!element.classList.contains('courses--item_btn')) return;

    heightProgram(element);
  })
}

const heightProgram = (btn) => {
  const container = btn.closest('.courses--item');
  const coursesItemDesc = container.querySelector('.courses--item_desc');
  const items = container.closest('.courses--items');
  const itemsHeight = items.clientHeight;

  coursesItemDesc.classList.toggle('active');

  if (coursesItemDesc.classList.contains('active')) {
    coursesItemDesc.style = `height: ${coursesItemDesc.scrollHeight + 24}px`;
    items.style = `height: ${itemsHeight + coursesItemDesc.scrollHeight + 24}px`
    btn.innerText = '- сховати'
  } else {
    coursesItemDesc.style = `height: 0px`;
    items.style = `height: ${itemsHeight - coursesItemDesc.scrollHeight}px`
    btn.innerText = '+ більше'
  }
};

const handleProgramHeaight = () => {
  const coursesItems = document.querySelector('.courses--items');

  if (!coursesItems) return;

  const items = coursesItems.querySelectorAll('.courses--item');
  const compileHeight = items[0].clientHeight + items[1].clientHeight + items[2].clientHeight + 64;

  coursesItems.style = `height: ${compileHeight}px`
};

const showingPrograms = () => {
  const showAll = document.querySelector('#show-all');
  const coursesItems = document.querySelector('.courses--items');

  if (!coursesItems || !showAll) return;

  showAll.addEventListener('click', () => {
    const itemsAllHeight = coursesItems.scrollHeight;

    coursesItems.classList.toggle('active');

    if (coursesItems.classList.contains('active')) {
      coursesItems.style = `height: ${itemsAllHeight - 8}px`;
      setTimeout(() => { coursesItems.style = `height: max-content`; }, 600)
    } else {
      coursesItems.style = `height: ${itemsAllHeight - 8}px`;

      handleProgramHeaight();
    }

  })
};

const openPopupForm = () => {
  const btns = document.querySelectorAll('.btn[data-id]');
  const mainForm = document.querySelector('#popup_registation');
  const mailToForm = document.querySelector('#popup_mailto');
  const mailToBtn = document.querySelector('#mail_to_btn');

  btns.forEach(btn => {
    btn.addEventListener('click', () => {
      mainForm.classList.add('active');
    })
  });

  mailToBtn.addEventListener('click', (evt) => {
    evt.preventDefault();

    mailToForm.classList.add('active');
  });

  closePopupForm(mailToForm);
  closePopupForm(mainForm);
};

const closePopupForm = (mainForm) => {
  mainForm && mainForm.addEventListener('click', evt => {
    const element = evt.target;

    if (!element.closest('.close_popup')) return;

    mainForm.classList.remove('active')
  })
};

const scrollToBlock = () => {
  const headerMenu = document.querySelector('.header_container--nav');
  const footerMenu = document.querySelector('.footer_menu--list');

  const scroll = (evt) => {
    evt.preventDefault();

    const element = evt.target;

    if (!element.matches('a') && !element.classList.contains('scroll')) return;

    const idTarget = "#" + element.dataset.id;
    const blockTarget = document.querySelector(idTarget);
    const headerContainer = document.querySelector('header');

    if (window.innerWidth > 768) {
      blockTarget.scrollIntoView({ behavior: "smooth", block: "center" });
    } else {
      blockTarget.scrollIntoView({ behavior: "smooth", block: "start" });
      setTimeout(() => {
        headerContainer.classList.remove('active');
      }, 200)
    }
  }

  headerMenu.addEventListener('click', evt => {
    scroll(evt);
  });

  footerMenu.addEventListener('click', evt => {
    scroll(evt);
  })
};

const closePopup = () => {
  document.addEventListener('click', evt => {
    const element = evt.target;

    if (element.closest('.form-main') || element.closest('[data-id="form-main"]') || element.closest('a[data-id="mail_to_btn"]')) return;

    const popup = document.querySelector('.popup_registration.active');

    if (!popup) return;

    popup.classList.remove('active');
  })
};

const closeMenuMobile = () => {
  if (window.innerWidth > 990) return;

  document.addEventListener('click', evt => {
    const element = evt.target;

    if (element.closest('.header_container.desctop.container') || element.closest('#nav-btn')) return;

    const headerContainer = document.querySelector('header');

    if (!headerContainer.classList.contains('active')) return;

    headerContainer.classList.remove('active');
  })
}

const openSocial = () => {
  const socialDropdown = document.querySelector('.social_dropdown');
  const socialDropdownBtn = socialDropdown.querySelector('.social_bropdown_btn');

  socialDropdownBtn.addEventListener('click', () => {
    socialDropdown.classList.toggle('active');
  })
};

const successedMessage = (event) => {
  const form = document.querySelector(`#${event.detail.unitTag}`);

  const wpcf7ResponseOutput = form.querySelector('.wpcf7-response-output');
  const a1 = document.createElement('a');
  const a2 = document.createElement('a');

  a1.href = "https://handmade-hub.ua/pro-handmade-hub/";
  a1.innerText = "дізнатися більше про компанію Handmade-Hub UA";

  a2.href = "https://s22.q4cdn.com/941741262/files/doc_financials/2024/q1/Exhibit-99-1-Q1-2024.pdf";
  a2.innerText = "статистику платформи Etsy";

  const allMessage = `Дякуємо за реєстрацію для проходження курсу!
                      Незабаром з вами зв’яжеться наш менеджер по роботі з клієнтами
                      та надасть усю необхідну інформацію.
                      З нетерпінням чекаємо на зустріч із вами на заняттях,
                      а поки пропонуємо вам ${a1.outerHTML},
                      на базі якої розроблено курс, адже всі знання, якими ми ділимось,
                      засновані на нашому досвіді. 
                      До вашої уваги також пропонуємо ${a2.outerHTML},
                      з якою ми навчаємо працювати, за І квартал 2024 року.

                      До зв’язку та до зустрічі!`;

  wpcf7ResponseOutput.innerHTML = allMessage;
};

document.addEventListener('wpcf7mailsent', function (event) {
  setTimeout(() => {
    successedMessage(event);
  }, 300)
}, false);


document.addEventListener('DOMContentLoaded', () => {
  handleMobileNav(); // activate mobile togler
  togleProgram(); // activete togler on programs
  handleProgramHeaight(); // handle for 3 items show
  showingPrograms(); // togle showing all programs

  // initiate scroll
  openPopupForm();
  scrollToBlock();

  // watch clicks on all document and close when click over popup
  closePopup();
  closeMenuMobile();

  openSocial();
});