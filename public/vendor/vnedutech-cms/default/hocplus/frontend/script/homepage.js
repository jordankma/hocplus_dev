function filterCourseComming() {
    var e = document.getElementById("group-course-filter-classes");
    var classes_selected = e.options[e.selectedIndex].value;

    var e = document.getElementById("group-course-filter-subject");
    var subject_selected = e.options[e.selectedIndex].value;

    if (classes_selected !== 0 || subject_selected !== 0) {
        $.get( routeApigetCourse, { classes_id: classes_selected, subject_id: subject_selected } )
            .done(function( data ) {
                document.getElementById("boxCourseGroupComming").innerHTML = data;
            });
    }

}

function filterCourseRunning() {
    var e = document.getElementById("group-course-run-filter-classes");
    var classes_selected = e.options[e.selectedIndex].value;

    var e = document.getElementById("group-course-run-filter-subject");
    var subject_selected = e.options[e.selectedIndex].value;

    if (classes_selected !== 0 || subject_selected !== 0) {
        $.get( routeApigetCourseRun, { classes_id: classes_selected, subject_id: subject_selected } )
            .done(function( data ) {
                document.getElementById("boxCourseGroupRunning").innerHTML = data;
            });
    }

}