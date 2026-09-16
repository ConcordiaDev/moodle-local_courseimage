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


defined('MOODLE_INTERNAL') || die();
require_once(__DIR__ . '/locallib.php');

function local_courseimage_extend_settings_navigation(
    settings_navigation $settingsnav,
    context $context
) {

    global $PAGE;

    if ($context->contextlevel != CONTEXT_COURSE) {
        return;
    }


    if (!has_capability(
        'local/courseimage:manage',
        $context
    )) {
        return;

    }

    $courseid = $PAGE->course->id;

    $url = new moodle_url(
        '/local/courseimage/edit.php',
        ['id' => $courseid]
    );

   $coursenode = $settingsnav->find(
    'courseadmin',
    navigation_node::TYPE_COURSE
    );

    if ($coursenode) {
        $coursenode->add(
            get_string('courseimage', 'local_courseimage'),
            $url,
            navigation_node::TYPE_SETTING
        );
    }
    }


