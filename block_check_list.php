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
 * @copyright  [2024] [Joytun]
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/blocks/check_list/lib.php');
require_once($CFG->libdir . '/formslib.php');
require_once(__DIR__ . '/../../config.php');

global $PAGE, $CFG, $USER, $DB;

try {
    require_login();
} catch (Exception $exception) {
    print_r($exception);
}

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/blocks/check_list/block_check_list.php'));
/**
 * Summary of block_check_list
 */
class block_check_list extends block_base {
    /**
     * Summary of init
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_check_list');
    }
    /**
     * Summary of get_content
     * @return void
     */
    public function get_content() {
        global $USER;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = '';

        $this->page->requires->js_call_amd('block_check_list/check' , 'init');

        // Display tasks and render the form.
        $this->content->text .= display_tasks_for_user($USER->id);
        $this->content->text .= render_add_task_form();

        return $this->content;
    }
    /**
     * Summary of get_content
     * @return void
     */
    public function applicable_formats() {
        return ['site' => true, 'course' => true];
    }
}
