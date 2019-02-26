// version 01 - date 2/23/2019

// function
let today = function (e) {
  let today = new Date().toISOString().substr(0, 10);
  e.value = today;
  e.valueAsDate = new Date();
};

$(".js-question .table tbody").sortable({
  connectWith: ".js-question .table tbody"
}).disableSelection();

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

// setting
const templateSetting = $('.js-setting');
if (templateSetting) {

  const availableItem = $('.js-setting .template-available .item');
  if (availableItem) {
    const ACTIVE_CLASS = 'active';
    const DISABLE_CLASS = 'disable';
    const btnNext = $('.js-setting .template-available .btn-next');
    availableItem.on('click', function () {
      $(this).toggleClass(ACTIVE_CLASS).siblings().removeClass(ACTIVE_CLASS);
      btnNext.removeClass(DISABLE_CLASS);
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

// show content
const listCourse = $('.js-list-course');
if (listCourse) {
  const btnToogle = $('.js-list-course .btn-detail');
  const TOGGLE_CLASS = 'item-active';
  btnToogle.on('click', function () {
    $(this).parent().parent().parent().toggleClass(TOGGLE_CLASS).siblings().removeClass(TOGGLE_CLASS);
  });
}

// show hide content
const contentShowHide = $('.js-content-show-hide');
if (contentShowHide) {
  const btnToogle = $('.js-content-show-hide .js-btn-toggle');
  const content = $('.js-content-show-hide .js-content');
  const HIDE_CLASS = 'hide';
  btnToogle.on('click', function () {
    $(this).parent().toggleClass(HIDE_CLASS);
  });
}

// carousel
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

// user
const user = $('.js-user');
if (user) {
  const btnLogIn = $('.js-btn-log-in');
  const btnExit = $('.c-user .exit');
  const btnForgotPassword = $('.c-user .btn-forgot-password');
  const btnNotificationClosed = $('.c-user .notification .closed');
  const content = $('.c-user .user-inner .left .inner>.content');
  const formLogIn = $('.c-user .form-log-in');
  const formRestorePassword = $('.c-user .form-restore-password');
  const body = $('body');
  const overBody = $('.over-body');
  const CLASS_ACTIVE = 'user-popup-active';
  const CLASS_SHOW = 'show';
  btnLogIn.on('click', function () {
    body.addClass(CLASS_ACTIVE);
  });
  btnExit.on('click', function () {
    body.removeClass(CLASS_ACTIVE);
  });
  overBody.on('click', function () {
    body.removeClass(CLASS_ACTIVE);
  });
  btnForgotPassword.on('click', function () {
    content.removeClass(CLASS_SHOW);
    formLogIn.removeClass(CLASS_SHOW);
    formRestorePassword.addClass(CLASS_SHOW);
  });
  btnNotificationClosed.on('click', function () {
    $(this).parent().remove();
  });
}

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

// multiselect
const multiselect = $('.multiselect');
if (multiselect) {
  multiselect.multiselect({
    columns: 4,
    placeholder: 'Bộ môn giảng dạy, Giảng dạy các lớp',
    search: true,
    searchOptions: {
      'default': 'Tìm kiếm'
    }
  });
}