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

/**
 * Save the uploaded course image.
 *
 * @param int $draftitemid
 * @param context_course $context
 * @return int Number of files stored.
 */
function local_courseimage_save_image(
    int $draftitemid,
    context_course $context
): int {

    file_save_draft_area_files(
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

    $filestorage = get_file_storage();

    $files = $filestorage->get_area_files(
        $context->id,
        'course',
        'overviewfiles',
        0,
        'filename',
        false
    );

    $filecount = count($files);

    return $filecount;
}