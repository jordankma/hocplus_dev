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