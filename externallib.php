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
require_once("$CFG->libdir/externallib.php");

/**
 * Summary of block_check_list_external
 * @return void
 */
class block_check_list_external extends external_api {

    /**
     * Summary of update_task_status_parameters
     * @return void
     */
    public static function update_task_status_parameters() {
        return new external_function_parameters(
            [
                'taskid' => new external_value(PARAM_INT, 'Task ID'),
                'completed' => new external_value(PARAM_BOOL, 'Completion status'),
            ]
        );
    }
    /**
     * Summary of update_task_status
     * @return void
     */
    public static function update_task_status($taskid, $completed) {
        global $DB, $USER;

        $params = self::validate_parameters(self::update_task_status_parameters(),
        ['taskid' => $taskid, 'completed' => $completed]);

        $task = $DB->get_record('block_check_list_tasks', ['id' => $taskid, 'userid' => $USER->id], '*', MUST_EXIST);
        $task->completed = $completed;
        $DB->update_record('block_check_list_tasks', $task);

        return ['status' => 'Task marked as complete'];
    }
    /**
     * Summary of update_task_status_returns
     * @return void
     */
    public static function update_task_status_returns() {
        return new external_single_structure(
            ['status' => new external_value(PARAM_TEXT, 'Result message')]
        );
    }



    /**
     * Summary of add_task_parameters
     * @return void
     */
    public static function add_task_parameters() {
        return new external_function_parameters([
            'task' => new external_value(PARAM_TEXT, 'Task description'),
        ]);
    }
    /**
     * Summary of add_task
     * @return void
     */
    public static function add_task($task) {
        return block_check_list_add_task($task);
    }
    /**
     * Summary of add_task_returns
     * @return void
     */
    public static function add_task_returns() {
        return new external_single_structure([
            'taskid' => new external_value(PARAM_INT, 'Task ID'),
            'task' => new external_value(PARAM_TEXT, 'Task description'),
        ]);
    }

}
