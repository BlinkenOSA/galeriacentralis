import $ from './select';
import debounce from './debounce';
// import throttle from './throttle';
// const Scroller = require('./scroller');
// import Parallax from './parallax';
import lazyLoad from './lazyLoad';
const baguetteBox = require('baguettebox.js');
import breakPoint from './breakPoint';
import bodyScroll from './bodyScroll';
import Siema from 'siema';

/**
 * Years
 */

if ($('.events__toggle')) {
  const years = (() => {
    let toggles = document.querySelectorAll('.events__toggle');
    let visibleYears = document.querySelectorAll('.events__year--visible');
    for (let i = 0; i < toggles.length; i++) {
      let toggle = toggles[i];
      toggle.addEventListener('click', e => {
        if (toggle.parentNode.classList.contains('events__year--visible')) {
          toggle.nextElementSibling.style.height = '0px';
          toggle.parentNode.classList.remove('events__year--visible');
        } else {
          toggle.nextElementSibling.style.height = toggle.nextElementSibling.firstElementChild.offsetHeight + 'px';
          toggle.parentNode.classList.add('events__year--visible');
        }
      });
    }
    window.addEventListener('load', e => {
      for (let i = 0; i < visibleYears.length; i++) {
        const year = visibleYears[i];
        console.log(year.lastElementChild.firstElementChild.offsetHeight);
        year.lastElementChild.style.height = year.lastElementChild.firstElementChild.offsetHeight + 'px';
      }
    });
  })();
}

/**
 * Info-break
 */

if ($('.info')) {
  const infoBreak = (() => {
    let self = {};
    let container = $('.info__columns');
    let datas = $('.info__datas');
    let about = $('.info__about');
    let impressum = $('.info__impressum');
    let placeholder = $('.info__placeholder');

    self.calcHeight = () => {
      console.log(breakPoint.get());
      if (window.getComputedStyle(about).order == 3) {
        let rightHeight = about.offsetHeight + impressum.offsetHeight;
        let leftHeight = datas.offsetHeight;
        placeholder.style.height = (rightHeight - leftHeight) + 'px';
        container.style.height = 1.1 * rightHeight + 'px';
      } else {
        container.style.height = '';
      }
    }

    window.addEventListener('load', e => {
      self.calcHeight();
    });

    var handleResize = debounce(self.calcHeight, 300);

    window.addEventListener('resize', handleResize);
  })();
}

/**
 * Data-break
 */

if ($('.data')) {
  const dataBreak = (() => {
    let self = {};
    let container = $('.data');
    let datas = $('.data__datas');
    let related = $('.data__related');
    let summary = $('.data__summary');

    self.calcHeight = () => {
      if (window.getComputedStyle(related).order == 2) {
        let leftHeight = datas.offsetHeight + related.offsetHeight;
        let rightHeight = summary.offsetHeight;
        container.style.height = leftHeight > rightHeight ? leftHeight + 'px' : rightHeight + 'px';
      } else {
        container.style.height = '';
      }
    }

    window.addEventListener('load', e => {
      self.calcHeight();
    });

    var handleResize = debounce(self.calcHeight, 300);

    window.addEventListener('resize', handleResize);
  })();
}

/**
 * Search
 */

const search = (() =>{
  let button = $('.header__search');
  let modal = $('.search');
  if (button) {
    button.addEventListener('click', e => {
      modal.classList.toggle('search--visible');
    });
  }
})();

/**
 * Slider
 */

if ($('.gallery')) {
  window.addEventListener('load', e => {
  // window.onload = function() {
    const slider = (() => {
      var gallery = {
        navs: document.querySelectorAll('.gallery__nav-item'),
        slides: document.querySelectorAll('.gallery__figure'),
        caption: $('.gallery__meta'),
        defaults: {
          selector: '.gallery__items',
          onChange: onChange,
          onInit: onInit,
          slider: {},
        },
      };
  
      function onInit() {
        if ($('.gallery__items--early')) {
          $('.gallery__items--early').classList.remove('gallery__items--early');
        }
        if ($('.gallery__items')) {
          let height = $('.gallery__items').offsetHeight;
          let images = $('.gallery__items').querySelectorAll('.gallery__image');
          for (let i = 0; i < images.length; i++) {
            const image = images[i];
            image.style.minHeight = height + 'px';
          }
        }
      }

      function onChange() {
        $('.gallery__nav-item--active').classList.remove('gallery__nav-item--active');
        gallery.navs[gallery.slider.currentSlide].classList.add('gallery__nav-item--active');
        gallery.caption.innerHTML = gallery.slides[gallery.slider.currentSlide].lastElementChild.innerHTML;
      }
      gallery.slider = new Siema(gallery.defaults);
      for (let i = 0; i < gallery.navs.length; i++) {
        gallery.navs[i].addEventListener('click', e => {
          gallery.slider.goTo(i);
        });
      }
  
      var handleResize = debounce(function() {
        gallery.slider.destroy(true);
        let images = $('.gallery__items').querySelectorAll('.gallery__image');
        for (let i = 0; i < images.length; i++) {
          const image = images[i];
          image.style.minHeight = '0px';
        }
        setTimeout(function() {
          gallery.slider = new Siema(gallery.defaults);
        }, 150);
      }, 150);

      // var handleResize = throttle(function() {
      //   gallery.slider.destroy(true);
      //   gallery.slider = new Siema(gallery.defaults);
      //   console.log('rebuilt');
      // }, 300);

      window.addEventListener('resize', handleResize);
    })();
  });
}


/**
 * Lazyload
 */

lazyLoad.init();

/**
 * Parallax
 */

// var parallax = new Parallax('[data-parallax]');

/**
 * Nav
 */

const navigation = (() => {
  var navigation = {};
  navigation.header = $('.header');
  navigation.toggle = $('.header__toggle');
  navigation.navs = $('.header__navs');
  navigation.buttons = document.querySelectorAll('.primary__button');
  var page = $('.wrapper');

  navigation.handleResize = () => {
    let size = breakPoint.get();
    if (size == "large" || size == "extra-large") {
      navigation.close();
    }
  };

  navigation.open = () => {
    bodyScroll.lock();
    window.addEventListener('resize', navigation.handleResize);
    navigation.header.classList.add('header--nav');
    navigation.navs.classList.add('header__navs--visible');
    page.classList.add('wrapper--nav');
    
  };

  navigation.close = () => {
    bodyScroll.unlock();
    window.removeEventListener('resize', navigation.handleResize);
    if ($('.search').classList.contains('search--visible')) {
      $('.search').classList.remove('search--visible');
    }
    navigation.header.classList.remove('header--nav');
    navigation.navs.classList.remove('header__navs--visible');
    page.classList.remove('wrapper--nav');
  };

  if (navigation.toggle) {
    navigation.toggle.addEventListener('click', (e) => {
      if (navigation.header.classList.contains('header--nav')) {
        navigation.close();
      } else {
        navigation.open();
      }
    });
  }


  document.body.addEventListener('click', (e) => {
    if (e.target == $('.wrapper--nav')) {
      navigation.close();
    }
  });

  window.addEventListener('keyup', (e) => {
    if (e.key === 'Escape' && navigation.header.classList.contains('header--nav')) {
      navigation.close();
    }
  });

  for (let i = 0; i < navigation.buttons.length; i++) {
    let button = navigation.buttons[i];
    button.addEventListener('click', e => {
      let title = button.parentNode;
      if (title.parentNode.classList.contains('primary__column--visible')) {
        title.parentNode.classList.remove('primary__column--visible');
        title.nextElementSibling.style.height = "0px";
      } else {
        let height = title.nextElementSibling.firstElementChild.offsetHeight * 4;
        title.parentNode.classList.add('primary__column--visible');
        title.nextElementSibling.style.height = height + 'px';
      }
    });
  }

  return navigation;
})();

/**
 * Scrollers
 */

// const scrollers = (() => {
//   const items = document.querySelectorAll('.scroller__item > a, [data-scroller]');
//   let duration = 800;
//   let navHeight = $('.header').offsetHeight - 2;
//   if (window.location.hash) {
//     window.addEventListener('load', () => {
//       window.scrollTo(0, $(window.location.hash).offsetTop - navHeight);
//     });
//   }
//   if (items) {
//     for (let i = 0; i < items.length; i++) {
//       items[i].addEventListener('click', (e) => {
//         e.preventDefault();
//         if ($('.primary').classList.contains('primary--visible')) {
//           window.navigation.close();
//         }
//         if ($(items[i].getAttribute('href'))) {
//           Scroller.scroll($(items[i].getAttribute('href')).offsetTop - navHeight, duration)
//         } else if ($(`#${items[i].getAttribute('data-scroller')}`)) {
//           Scroller.scroll($(`#${items[i].getAttribute('data-scroller')}`).offsetTop - navHeight, duration);
//         } else {
//           window.location.href = window.location.origin + items[i].getAttribute('href');
//         }
//       });
//     }
//   }
// })();


/**
 * Cookie consent
 */

const cookieConsent = (() => {
  const cookie = 'cookies_accept';
  const modal = $('.cookie');
  const button = $('.cookie__button');
  if (button) {
    button.addEventListener('click', (e) => {
      accept();
    });
  }
  const accept = () => {
    fetch('/async/accept-cookies', {
      method: 'post',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').getAttribute('content')
      },
      credentials: 'same-origin'
    }).then(res => {
      if (res.status == 200) {
        modal.classList.remove('cookie--visible');
        bodyScroll.unlock();
      }
    }).catch(err => {
      console.log(err)
    });
  };
})();