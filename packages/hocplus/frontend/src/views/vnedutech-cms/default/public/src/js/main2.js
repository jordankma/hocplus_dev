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
  const formNewPassword = $('.js-user .form-new-password');
  const formNewPassword1 = $('.js-user .form-new-password-1');
  const formNewPassword2 = $('.js-user .form-new-password-2');
  const btnForgotPassword = $('.js-user .btn-forgot-password');
  const other = $('.js-user .other');
  const btnRemove = $('.js-user .closed');
  const btnHidden = $('.js-user .hiddenLabel');

  const tabParentsStudent = $('.js-user .tabs .tabs-parents-student');
  const tabTeacher = $('.js-user .tabs .tabs-teacher');
  const parentsStudent = $('.js-user .parents-student');
  const teacher = $('.js-user .teacher');
  const ACTIVE_TAB_CLASS = 'tabs-active';

  if (resetToken !== '') {
      body.addClass(ACTIVE_CLASS);
      form.removeClass(SHOW_CLASS);
      if (resetToken === '1') {
          formNewPassword1.addClass(SHOW_CLASS);
          setTimeout(function () {
              window.location.href = "/";
          }, 5000);
      } else if (resetToken === '2') {
          formNewPassword2.addClass(SHOW_CLASS);
          setTimeout(function () {
              window.location.href = "/";
          }, 5000);
      } else {
          formNewPassword.addClass(SHOW_CLASS);
      }
      other.removeClass(SHOW_CLASS);
  }

  tabParentsStudent.on('click', function () {
    tabTeacher.removeClass(ACTIVE_TAB_CLASS);
    $(this).addClass(ACTIVE_TAB_CLASS);
    parentsStudent.addClass(SHOW_CLASS);
    teacher.removeClass(SHOW_CLASS);
    other.addClass(SHOW_CLASS);
  });
  tabTeacher.on('click', function () {
    tabParentsStudent.removeClass(ACTIVE_TAB_CLASS);
    $(this).addClass(ACTIVE_TAB_CLASS);
    teacher.addClass(SHOW_CLASS);
    parentsStudent.removeClass(SHOW_CLASS);
    other.removeClass(SHOW_CLASS);
  });

  btnRemove.on('click', function () {
    $(this).parent().remove();
  });
  btnHidden.on('click', function () {
    $(this).parent().css('display', 'none');
  });

  btnRegistration.on('click', function () {
    body.addClass(ACTIVE_CLASS);
    form.removeClass(SHOW_CLASS);
    formLogIn.addClass(SHOW_CLASS);
    tabTeacher.removeClass(ACTIVE_TAB_CLASS);
    tabParentsStudent.addClass(ACTIVE_TAB_CLASS);
    parentsStudent.addClass(SHOW_CLASS);
    teacher.removeClass(SHOW_CLASS);
    other.addClass(SHOW_CLASS);
  });

  btnRegisterActive.on('click', function () {
    contentRegister.addClass(SHOW_CLASS);
    contentLogIn.removeClass(SHOW_CLASS);
    form.removeClass(SHOW_CLASS);
    formLogIn.addClass(SHOW_CLASS);
    other.addClass(SHOW_CLASS);
    tabTeacher.removeClass(ACTIVE_TAB_CLASS);
    tabParentsStudent.addClass(ACTIVE_TAB_CLASS);
    parentsStudent.addClass(SHOW_CLASS);
    teacher.removeClass(SHOW_CLASS);
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

const carouselAboutLecturers = $('.js-about-lecturers');

if (carouselAboutLecturers) {

  const carousel = carouselAboutLecturers;

  carousel.slick({
    dots: true,
    infinite: true,
    speed: 300,
    fade: true,
    cssEase: 'linear',
    arrows: false,
    autoplay: true,
    autoplaySpeed: 2500
  });

}

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

//-------------------------- Tweezer
class Tweezer {
  constructor(opts = {}) {
    this.duration = opts.duration || 1000;
    this.ease = opts.easing || this._defaultEase;
    this.start = opts.start;
    this.end = opts.end;

    this.frame = null;
    this.next = null;
    this.isRunning = false;
    this.events = {};
    this.direction = this.start < this.end ? 'up' : 'down';
  }

  begin() {
    if (!this.isRunning && this.next !== this.end) {
      this.frame = window.requestAnimationFrame(this._tick.bind(this));
    }
    return this;
  }

  stop() {
    window.cancelAnimationFrame(this.frame);
    this.isRunning = false;
    this.frame = null;
    this.timeStart = null;
    this.next = null;
    return this;
  }

  on(name, handler) {
    this.events[name] = this.events[name] || [];
    this.events[name].push(handler);
    return this;
  }

  emit(name, val) {
    let e = this.events[name];
    e && e.forEach(handler => handler.call(this, val));
  }

  _tick(currentTime) {
    this.isRunning = true;

    let lastTick = this.next || this.start;

    if (!this.timeStart) this.timeStart = currentTime;
    this.timeElapsed = currentTime - this.timeStart;
    this.next = Math.round(this.ease(this.timeElapsed, this.start, this.end - this.start, this.duration));

    if (this._shouldTick(lastTick)) {
      this.emit('tick', this.next);
      this.frame = window.requestAnimationFrame(this._tick.bind(this));
    } else {
      this.emit('tick', this.end);
      this.emit('done', null);
    }
  }

  _shouldTick(lastTick) {
    return {
      up: this.next < this.end && lastTick <= this.next,
      down: this.next > this.end && lastTick >= this.next
    } [this.direction];
  }

  _defaultEase(t, b, c, d) {
    if ((t /= d / 2) < 1) return c / 2 * t * t + b;
    return -c / 2 * ((--t) * (t - 2) - 1) + b;
  }
}

//----------------------- Tweezer end;

const elements = document.querySelectorAll('[data-scroll]');

if (elements) {
  for (let i = 0; i < elements.length; i++) {

    const button = elements[i];
    const targetValues = elements[i].getAttribute('data-scroll');
    const targets = document.querySelectorAll(targetValues);
    if (targets) {
      for (let i = 0; i < targets.length; i++) {
        button.addEventListener('click', () => {
          const scrollTop = (window.scrollY || window.pageYOffset || document.documentElement.scrollTop);
          new Tweezer({
              start: scrollTop,
              end: targets[i].getBoundingClientRect().top + scrollTop,
            })
            .on('tick', v => window.scrollTo(0, v))
            .begin();
        });
      }
    } else {
      console.log('wrong id');
    }
  }
}

const mlTable = $('.js-ml-list');

if (mlTable) {
  const action = $('.js-ml-list .action');
  if (action) {
    action.parent().css('vertical-align', 'middle');
  }
}

const pay = $('js-pay');

if (pay) {
  const elements = document.querySelectorAll('[data-pay]');

  for (let i = 0; i < elements.length; i++) {
    const button = elements[i];
    const CLASS_TAB_ACTIVE = 'species-active';
    const CLASS_ACTIVE = 'pay-active';

    $(button).on('click', function () {
      $(this).addClass(CLASS_TAB_ACTIVE).siblings().removeClass(CLASS_TAB_ACTIVE);
      const item = button.getAttribute('data-pay');
      $(item).addClass(CLASS_ACTIVE).siblings().removeClass(CLASS_ACTIVE);
    });
  }

  const tabs = document.querySelectorAll('[data-tab]');
  if (tabs) {
    for (let i = 0; i < tabs.length; i++) {
      const button = tabs[i];
      const CLASS_TAB_ACTIVE = 'tabs-active';
      const CLASS_ACTIVE = 'bank-card-active';

      $(button).on('click', function () {
        $(this).addClass(CLASS_TAB_ACTIVE).siblings().removeClass(CLASS_TAB_ACTIVE);
        const item = button.getAttribute('data-tab');
        $(item).addClass(CLASS_ACTIVE).siblings().removeClass(CLASS_ACTIVE);
      });
    }
  }
}

const templateSetting = $('.js-setting');
if (templateSetting) {

  if ($('#exampleInputTemplateResult').length > 0) {
    CKEDITOR.replace('exampleInputTemplateResult');
  }
  if ($('#exampleInputTemplateTarget').length > 0) {
    CKEDITOR.replace('exampleInputTemplateTarget');
  }
  if ($('#exampleInputTemplateRequest').length > 0) {
    CKEDITOR.replace('exampleInputTemplateRequest');
  }


  const availableItem = $('.js-setting .template-available .item');
  if (availableItem) {
    const ACTIVE_CLASS = 'active';
    availableItem.on('click', function () {
      $(this).toggleClass(ACTIVE_CLASS).siblings().removeClass(ACTIVE_CLASS);
    });
  }

  const tabs = document.querySelectorAll('[data-choose]');
  if (tabs) {
    for (let i = 0; i < tabs.length; i++) {
      const button = tabs[i];
      const CLASS_TAB_ACTIVE = 'menu-active';
      const CLASS_ACTIVE = 'template-active';

      $(button).on('click', function () {
        $(this).addClass(CLASS_TAB_ACTIVE).siblings().removeClass(CLASS_TAB_ACTIVE);
        const item = button.getAttribute('data-choose');
        $(item).addClass(CLASS_ACTIVE).siblings().removeClass(CLASS_ACTIVE);
      });
    }
  }

  const posts = $('.js-setting .template-new .posts');
  if (posts) {
    const container = $('.js-setting .template-new .posts .posts-list');
    const button = $('.js-setting .template-new .posts .btn-new');
    let postsID = 1;
    button.on('click', function () {
      let ID = postsID++;
      container.append(`
      <div class="posts-item">
        <div class="grid inner">
          <div class="grid-left">
            <div class="title">Bài ${ID} *</div>
          </div>
          <div class="grid-right">
            <textarea id="posts-${ID}" name="posts-${ID}"></textarea>
          </div>
        </div>
      </div>
      `);
      CKEDITOR.replace("posts-" + ID);
    });
  }

  const dateSetting = $('.js-setting .js-date');
  if (dateSetting) {
    const container = $('.js-setting .js-date .group');
    const button = $('.js-setting .js-date .btn-new');
    let dateID = 1;
    button.on('click', function () {
      let ID = dateID++;
      container.append(`
      <div class="grid form-group">
        <div class="grid-left">
          <label for="exampleInputTemplateDateStart">Buổi ${ID} *</label>
        </div>
        <div class="grid-right">
          <div class="grid grid-mg15">
            <div class="grid-50 grid-p15">
              <div class="grid grid-mg7">
                <div class="grid-60 grid-p7">
                  <input class="form-control" type="date" id="exampleInputTemplateDateStart-${ID}" name="exampleInputTemplateDateStart-${ID}" value="2019-01-01">
                </div>
                <div class="grid-40 grid-p7">
                  <input class="form-control" type="time" id="exampleInputTemplateTimeStart-${ID}" name="exampleInputTemplateTimeStart-${ID}" value="00:00">
                </div>
              </div>
            </div>
            <div class="grid-50 grid-p15">
              <div class="grid grid-mg7">
                <div class="grid-60 grid-p7">
                  <input class="form-control" type="date" id="exampleInputTemplateDateEnd-${ID}" name="exampleInputTemplateDateEnd-${ID}" value="2019-01-01">
                </div>
                <div class="grid-40 grid-p7">
                  <input class="form-control" type="time" id="exampleInputTemplateTimeEnd-${ID}" name="exampleInputTemplateTimeEnd-${ID}" value="00:00">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      `);
    });
  }
}

// file navbar
const fileNavbar = $('.js-file-navbar');

if (fileNavbar) {

  const SUB_MENU_CLASS = 'sub-menu';
  const DROPDOWN_CLASS = 'dropdown';
  const ACTIVE_CLASS = 'active';

  const subMenu = $('.js-file-navbar>.nav>li ul');
  subMenu.addClass(SUB_MENU_CLASS);
  subMenu.parent().addClass(DROPDOWN_CLASS);

  const dropdown = $('.js-file-navbar .dropdown');
  const dropdownButton = $('.js-file-navbar .dropdown>a');

  dropdownButton.on('click', function () {
    $(this).parent().toggleClass(ACTIVE_CLASS).siblings().removeClass(ACTIVE_CLASS);
    return false;
  });
}