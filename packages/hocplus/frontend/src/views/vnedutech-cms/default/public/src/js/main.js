// Video Youtube
// Find all YouTube videos
var $allVideos = $("iframe[src*='youtube']"),
  // The element that is fluid width
  $fluidEl = $("iframe[src*='youtube']").parent().addClass("youtube-iframe-wrap");
// Figure out and save aspect ratio for each video
$allVideos.each(function () {
  $(this)
    .data('aspectRatio', this.height / this.width)
    // and remove the hard coded width/height
    .removeAttr('height')
    .removeAttr('width');

});
// When the window is resized
$(window).resize(function () {
  var newWidth = $fluidEl.width();
  // Resize all videos according to their own aspect ratio
  $allVideos.each(function () {
    var $el = $(this);
    $el
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'));
  });
  // Kick off one resize to fix all videos on page load
}).resize();

// navbar tab
const navbarTab = $('.js-navbar-tab');
if (navbarTab) {
  const tabButtonItems = $('.js-navbar-tab .tab-button .item');
  const tabBodyItems = $('.js-navbar-tab .tab-body .item');
  for (let i = 0; i < tabButtonItems.length; i++) {
    const tabButtonItem = tabButtonItems[i];
    const tabBodyItem = tabBodyItems[i];
    $(tabButtonItem).on('mouseover', function () {
      $(this).addClass('active').siblings().removeClass('active');
      $(tabBodyItem).addClass('active').siblings().removeClass('active');
    });
  }
}

// fix top
const fixed = document.querySelector('.js-fixed');
const ACTIVE_CLASS = 'fixed-top';

const addClass = () => fixed.classList.add(ACTIVE_CLASS);
const removeClass = () => fixed.classList.remove(ACTIVE_CLASS);

if (fixed) {
  window.addEventListener('scroll', () => {
    const windowHeight = this.window.pageYOffset ||
      this.document.documentElement.scrollTop ||
      this.document.body.scrollTop || 0;

    (windowHeight > fixed.offsetTop) ? addClass(): removeClass();
  });
}

// manage
const userManage = $('.js-user');
if (userManage) {
  const ACTIVE_CLASS = 'user-anage-active';
  const SHOW_CLASS = 'show';
  const btnRegistration = $('.btn-user');
  const body = $('body');
  const overBody = $('.js-user .over-body');
  const exit = $('.js-user .exit');
  const btnRegisterActive = $('.js-user .content-log-in .btn');
  const btnLogInActive = $('.js-user .content-register .btn');
  const contentRegister = $('.js-user .content-register');
  const contentLogIn = $('.js-user .content-log-in');
  const form = $('.js-user .form');
  const formLogIn = $('.js-user .form-log-in');
  const formRegister = $('.js-user .form-register');
  const formRegisterPassword = $('.js-user .form-restore-password');
  const btnForgotPassword = $('.js-user .btn-forgot-password');
  const other = $('.js-user .other');
  const btnRemove = $('.js-user .closed');

  btnRemove.on('click', function () {
    $(this).parent().remove();
  });
  btnRegistration.on('click', function () {
    body.addClass(ACTIVE_CLASS);
  });
  btnRegisterActive.on('click', function () {
    contentRegister.addClass(SHOW_CLASS);
    contentLogIn.removeClass(SHOW_CLASS);
    form.removeClass(SHOW_CLASS);
    formLogIn.addClass(SHOW_CLASS);
    other.addClass(SHOW_CLASS);
  });
  btnLogInActive.on('click', function () {
    contentRegister.removeClass(SHOW_CLASS);
    contentLogIn.addClass(SHOW_CLASS);
    form.removeClass(SHOW_CLASS);
    formRegister.addClass(SHOW_CLASS);
    other.addClass(SHOW_CLASS);
  });
  btnForgotPassword.on('click', function () {
    form.removeClass(SHOW_CLASS);
    formRegisterPassword.addClass(SHOW_CLASS);
    other.removeClass(SHOW_CLASS);
  });
  overBody.on('click', function () {
    body.removeClass(ACTIVE_CLASS);
  });
  exit.on('click', function () {
    body.removeClass(ACTIVE_CLASS);
  });
}

// carousel
// const carouselCourseItems = $('.c-course-group .group');
// if (carouselCourseItems) {
//   for (let i = 0; i < carouselCourseItems.length; i++) {
//     const carouselCourseItem = carouselCourseItems[i];
//     $(carouselCourseItem).slick({
//       speed: 300,
//       slidesToShow: 4,
//       slidesToScroll: 1,
//       autoplay: true,
//       autoplaySpeed: 2000,
//       responsive: [{
//           breakpoint: 1024,
//           settings: {
//             slidesToShow: 3,
//             arrows: false
//           }
//         },
//         {
//           breakpoint: 600,
//           settings: {
//             slidesToShow: 2,
//             arrows: false

//           }
//         },
//         {
//           breakpoint: 480,
//           settings: {
//             slidesToShow: 1,
//             arrows: false
//           }
//         }
//       ]
//     });

//   }
// }
const carouselCertificateItems = $('.c-lecturers-group .group');
if (carouselCertificateItems) {
  for (let i = 0; i < carouselCertificateItems.length; i++) {
    const carouselCertificateItem = carouselCertificateItems[i];
    $(carouselCertificateItem).slick({
      speed: 300,
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      responsive: [{
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            arrows: false
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            arrows: false
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            arrows: false
          }
        }
      ]
    });
  }
}
const carouselItems = $('.c-carousel .inner');
if (carouselItems) {
  for (let i = 0; i < carouselItems.length; i++) {
    const carouselItem = carouselItems[i];
    $(carouselItem).slick({
      arrows: false,
      dots: true,
      speed: 300,
      autoplay: true,
      autoplaySpeed: 2000,
    });
  }
}
const carouselLibrary = $('.c-library .carousel .inner');
if (carouselLibrary) {
  carouselLibrary.slick({
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 1,
    centerMode: true,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          centerMode: false,
          arrows: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          centerMode: false,
          arrows: false
        }
      }
    ]
  });
}



// slideout
const slideout = $('.js-slideout');
if (slideout) {
  const rightTopbar = $('.c-topbar .right');
  const body = $('body');

  rightTopbar.append(`
    <div class="nav-trigger">
			<span class="bar"></span>
			<span class="bar"></span>
			<span class="bar"></span>
		</div>
  `);

  const toogleSlidout = $('.nav-trigger');
  const overBody = $('.over-body');
  const ACTIVE_CLASS = 'slideout-active';
  toogleSlidout.on('click', function () {
    body.toggleClass(ACTIVE_CLASS);
  });

  overBody.on('click', function () {
    body.removeClass(ACTIVE_CLASS);
  });

  const slideoutSubMenu = $('.js-slideout .nav>li ul');
  const SUB_MENU_CLASS = 'sub-menu';
  const DROPDOWN_CLASS = 'dropdown';
  ACTIVE_DROPDOWN_CLASS = 'active';
  slideoutSubMenu.addClass(SUB_MENU_CLASS);
  slideoutSubMenu.parent().addClass(DROPDOWN_CLASS);

  const dropdownButton = $('.js-slideout .dropdown>.nav-link');

  dropdownButton.on('click', function () {
    $(this).parent().toggleClass(ACTIVE_DROPDOWN_CLASS).siblings().removeClass(ACTIVE_DROPDOWN_CLASS);
    return false;
  });

}

// 