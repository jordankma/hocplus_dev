// function
let today = function (e) {
  let today = new Date().toISOString().substr(0, 10);
  e.value = today;
  e.valueAsDate = new Date();
};

// Video Youtube
const $allVideos = $("iframe[src*='youtube']"),
  $fluidEl = $("iframe[src*='youtube']").parent().addClass("youtube-iframe-wrap");
$allVideos.each(function () {
  $(this)
    .data('aspectRatio', this.height / this.width)
    .removeAttr('height')
    .removeAttr('width');
});
$(window).resize(function () {
  var newWidth = $fluidEl.width();
  $allVideos.each(function () {
    var $el = $(this);
    $el
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'));
  });
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

  const tabParentsStudent = $('.js-user .tabs .tabs-parents-student');
  const tabTeacher = $('.js-user .tabs .tabs-teacher');
  const parentsStudent = $('.js-user .parents-student');
  const teacher = $('.js-user .teacher');
  const ACTIVE_TAB_CLASS = 'tabs-active';

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
  btnRegistration.on('click', function () {
    body.addClass(ACTIVE_CLASS);
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

// pay
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

// setting
const templateSetting = $('.js-setting');
if (templateSetting) {

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

    const input = $('#exampleInputTemplateSession');
    input.on('change', function () {
      const item = $('.js-setting .template-new .posts .posts-item');
      item.remove();
      const value = $(this).val();
      if (value < 101) {
        for (let i = 0; i < value; i++) {
          let ID = i + 1;
          container.append(`
            <div class="posts-item">
              <div class="grid inner">
                <div class="grid-left">
                  <div class="title">Bài ${ID} *</div>
                </div>
                <div class="grid-right">
                  <textarea class="form-control" rows="6" id="posts-${ID}" name="posts-${ID}"></textarea>
                </div>
              </div>
            </div>
          `);
        }
      } else {
        alert('Số buổi tối đa là 100');
      }
    });
  }

  const dateSetting = $('.js-setting .js-date');
  if (dateSetting) {

    const dateStart = document.querySelector('#exampleInputTemplateDateStart');
    if (dateStart) {
      today(dateStart);
    }
    const dateEnd = document.querySelector('#exampleInputTemplateDateEnd');
    if (dateEnd) {
      today(dateEnd);
    }

    const container = $('.js-setting .js-date .group');
    if (typeof numberLesson != "undefined") {
      for (let i = 0; i < numberLesson; i++) {
        let ID = i + 1;
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
                      <input class="form-control" type="date" id="exampleInputTemplateDateStart-${ID}" name="exampleInputTemplateDateStart-${ID}">
                    </div>
                    <div class="grid-40 grid-p7">
                      <input class="form-control" type="time" id="exampleInputTemplateTimeStart-${ID}" name="exampleInputTemplateTimeStart-${ID}" value="00:00">
                    </div>
                  </div>
                </div>
                <div class="grid-50 grid-p15">
                  <div class="grid grid-mg7">
                    <div class="grid-60 grid-p7">
                      <input class="form-control" type="date" id="exampleInputTemplateDateEnd-${ID}" name="exampleInputTemplateDateEnd-${ID}">
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
        const dateStart = document.querySelector('#exampleInputTemplateDateStart-' + ID);
        const dateEnd = document.querySelector('#exampleInputTemplateDateEnd-' + ID);
        today(dateStart);
        today(dateEnd);
      }
    }
  }
}

const questionNew = $('.js-question-new');
if (questionNew) {

  const container = $('.js-question-new .questions');
  const button = $('.js-question-new .btn-blue');
  let dateID = 1;
  button.on('click', function () {
    let ID = dateID++;
    container.append(`
      <div class="grid form-group">
        <div class="grid-66">
          <textarea class="form-control" rows="4" id="exampleInputQuestionNewAnswerContent-${ID}" name="exampleInputQuestionNewAnswerContent-${ID}"></textarea>
        </div>
        <div class="grid-33">
          <div class="function">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleInputQuestionNewAnswerCheck-${ID}">
              <label class="form-check-label" for="exampleInputQuestionNewAnswerCheck-${ID}">Đáp án đúng</label>
            </div>
            <span class="btn-trash" id="btn-trash-${ID}"><i class="fa fa-trash"></i> Xóa</span>
          </div>
        </div>
      </div>
      `);
    const trash = $('.btn-trash');
    $(trash).on('click', function () {
      $(this).parent().parent().parent().remove();
    });
  });
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

  const dropdownButton = $('.js-file-navbar .dropdown>a');

  dropdownButton.on('click', function () {
    $(this).parent().toggleClass(ACTIVE_CLASS).siblings().removeClass(ACTIVE_CLASS);
    return false;
  });
}

// question
const question = $('.question');
if (question) {
  const btnSearch = $('.js-question .question-inner .btn-search');
  const btnClosed = $('.js-question .question-search .closed');
  const body = $('body');
  const overBody = $('.over-body');

  const QUESTION_ACTIVE_CLASS = 'question-search-active';
  btnSearch.on('click', function () {
    body.addClass(QUESTION_ACTIVE_CLASS);
  });
  overBody.on('click', function () {
    body.removeClass(QUESTION_ACTIVE_CLASS);
  });
  btnClosed.on('click', function () {
    body.removeClass(QUESTION_ACTIVE_CLASS);
  });
}


$(".js-question .table tbody").sortable({
  connectWith: ".js-question .table tbody"
}).disableSelection();


// Btton delete
const btnDelete = $('.js-btn-delete');
if (btnDelete) {

  const btnDelete = $('.js-btn-delete');
  const btnNo = $('.notification-delete .btn-no');
  const body = $('body');
  const ACTIVE_CLASS = 'notification-delete-active';
  btnDelete.on('click', function () {
    body.addClass(ACTIVE_CLASS);
    return false;
  });
  btnNo.on('click', function () {
    body.removeClass(ACTIVE_CLASS);
    return false;
  });
}

// multiselect
// const multiselect = $('.multiselect');
// if (multiselect) {
//   multiselect.multiselect({
//     columns: 4,
//     placeholder: 'Bộ môn giảng dạy, Giảng dạy các lớp',
//     search: true,
//     searchOptions: {
//       'default': 'Tìm kiếm'
//     }
//   });
// }