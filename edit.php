<?php
// This file is part of a 3rd party created plugin for Moodle - http://moodle.org/.
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version.
 *
 * @package local_courseimage
 * @copyright  2026 CONCORDIA UNIVERSITY
 * @author      Francisco Berrizbeitia using Claude OPUS
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('../../config.php');
require_once($CFG->libdir . '/filelib.php');
require_once(__DIR__ . '/classes/form/course_image_form.php');
require_once(__DIR__ . '/locallib.php');

$courseid = required_param('id', PARAM_INT);

$course = get_course($courseid);

require_login($course);

$context = context_course::instance($course->id);

require_capability(
    'local/courseimage:manage',
    $context
);

$PAGE->set_context($context);
$PAGE->set_course($course);
$PAGE->set_url(
    new moodle_url(
        '/local/courseimage/edit.php',
        ['id' => $course->id]
    )
);

$PAGE->set_title(
    get_string('courseimage', 'local_courseimage')
);

$PAGE->set_heading(
    format_string($course->fullname)
);

/**
 * Prepare draft area for the existing overview image.
 */
$draftitemid = file_get_submitted_draft_itemid('overviewfiles');

file_prepare_draft_area(
    $draftitemid,
    $context->id,
    'course',
    'overviewfiles',
    0,
    [
        'subdirs' => 0,
        'maxfiles' => 1
    ]
);

$formdata = new stdClass();
$formdata->id = $course->id;
$formdata->overviewfiles = $draftitemid;

$mform = new \local_courseimage\form\course_image_form(
    null,
    [
        'course' => $course
    ]
);



$mform->set_data($formdata);

/**
 * Cancel.
 */
if ($mform->is_cancelled()) {

    redirect(
        new moodle_url(
            '/course/view.php',
            ['id' => $course->id]
        )
    );
}

/**
 * Save.
 */
if ($data = $mform->get_data()) {

    require_sesskey();

    local_courseimage_save_image(
        $data->overviewfiles,
        $context
    );

    redirect(
        new moodle_url(
            '/course/view.php',
            ['id' => $course->id]
        ),
        get_string(
            'changessaved'
        )
    );
}

echo $OUTPUT->header();

echo $OUTPUT->heading(
    get_string(
        'courseimage',
        'local_courseimage'
    )
);

$mform->display();

echo $OUTPUT->footer();
