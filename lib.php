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

defined('MOODLE_INTERNAL') || die();
require_once("$CFG->dirroot/blocks/check_list/classes/form/add_list_form.php");


/**
 * Summary of display_tasks_for_user
 * @return void
 */
function display_tasks_for_user($userid) {
    global $DB;

    $tasks = $DB->get_records('block_check_list_tasks', ['userid' => $userid]);
    $output = '<div class="check-list-tasks">';
    foreach ($tasks as $task) {
        $checked = $task->completed ? 'checked' : '';
        $output .= '<div>';
        $output .= '<input type="checkbox" class="task-checkbox" data-task-id="' . $task->id . '" ' . $checked . '>';
        $output .= ' ' . htmlspecialchars($task->task);
        $output .= '</div>';
    }
    $output .= '</div>';
    return $output;
}
/**
 * Summary of render_add_task_form
 * @return void
 */
function render_add_task_form() {
    global $CFG;

    $html = '<form id="add-task-form" method="post" action="' . $CFG->wwwroot . '/blocks/check_list/add_task.php">';
    $html .= '<label for="task">Add Task:</label>';
    $html .= '<input type="text" name="task" id="id_task" required>';
    $html .= '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
    $html .= '<button type="submit">Add Task</button>';
    $html .= '</form>';

    return $html;
}
