<?php
// This file is part of Moodle - http://moodle.org/
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
 * Block for displaying todo list
 *
 * @package    block_check_list
 * @copyright  Joytun joytunsultana09171@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');
require_login();

global $DB, $USER;

$task = required_param('task', PARAM_TEXT);
$sesskey = required_param('sesskey', PARAM_RAW);

// Security check.
if (!confirm_sesskey($sesskey)) {
    throw new moodle_exception('invalidsesskey', 'error');
}

if ($task) {
    $record = new stdClass();
    $record->userid = $USER->id;
    $record->task = $task;
    $record->completed = 0;
    $record->timecreated = time();
    $record->timemodified = time();

    $DB->insert_record('block_check_list_tasks', $record);
    redirect($CFG->wwwroot . '/course/view.php?id=2');

} else {
    echo json_encode(['success' => false, 'message' => 'Task name is required!']);
}


exit;
