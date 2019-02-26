// setting
const templateSetting = $('.js-setting');
if (templateSetting) {

    const availableItem = $('.js-setting .template-available .item');
    if (availableItem) {
        const ACTIVE_CLASS = 'active';
        availableItem.on('click', function () {
            let course_id = $(this).data('id');
            let course_href = $(this).data('href') + '?id=' + course_id;
            document.getElementById('btn-next1-create-course').setAttribute('data-course-id', course_id);
            document.getElementById('btn-next1-create-course').setAttribute('href', course_href);
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

function filterClasses() {
    var e = document.getElementById("exampleInputTemplateCategoriesSpecies");
    var subject_selected = e.options[e.selectedIndex].value;

    if (subject_selected !== 0) {
        $.get( route_name, { teacher_id: teacher_id, subject_id: subject_selected } )
            .done(function( data ) {
                $('#exampleInputTemplateCategoriesClass').empty();
                data.classes.forEach(item =>
                    $('#exampleInputTemplateCategoriesClass').append(`<option value="${item.id}">${item.name}</option>`)
                )
            });
    }
}

function filterSubject() {
    var e = document.getElementById("exampleInputTemplateCategoriesClass");
    var classes_selected = e.options[e.selectedIndex].value;

    if (classes_selected !== 0) {
        $.get( route_name, { teacher_id: teacher_id, classes_id: classes_selected } )
            .done(function( data ) {
                $('#exampleInputTemplateCategoriesSpecies').empty();
                data.subject.forEach(item =>
                    $('#exampleInputTemplateCategoriesSpecies').append(`<option value="${item.id}">${item.name}</option>`)
                )
            });
    }
}