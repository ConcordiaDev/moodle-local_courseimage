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

namespace local_courseimage\form;
defined('MOODLE_INTERNAL') || die();
require_once($GLOBALS['CFG']->libdir . '/formslib.php');

class course_image_form extends \moodleform {

    public function definition() {

        $mform = $this->_form;

        $mform->addElement(
            'filemanager',
            'overviewfiles',
            get_string(
                'courseimage',
                'local_courseimage'
            ),
            null,
            [
                'subdirs' => 0,
                'maxfiles' => 1,
                'accepted_types' => [
                    '.jpg',
                    '.jpeg',
                    '.png',
                    '.gif',
                    '.webp'
                ]
            ]
        );

        $mform->addElement(
            'hidden',
            'id'
        );

        $mform->setType(
            'id',
            PARAM_INT
        );

        $this->add_action_buttons();
    }
}