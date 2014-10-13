<?php

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
 * External Web Service for Working with Assignments 
 *
 * @package    localwsassign
 * @copyright  2014 Artem Pelenitsyn
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->libdir . "/externallib.php");

class local_ws_assign_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function update_description_parameters() {
        return new external_function_parameters(
            array(
                'assignment_id'   =>
                    new external_value(
                        PARAM_INT, 
                        'Id of the assignment to be updated'),
                'assignment_text' => 
                    new external_value(
                        PARAM_RAW, 
                        'New text for the assignment')
            )
        );
    }

    /**
     * Returns true or false depending on wether update succed or not
     * @return boolean success
     */
    public static function update_description($assignment_id, $assignment_text) {
        global $USER, $CFG, $DB;
        require_once($CFG->dirroot . '/mod/assign/locallib.php');

        //Parameter validation
        //REQUIRED
        $params = self::validate_parameters(
                        self::update_description_parameters(),
                        array(
                            'assignment_id'   => $assignment_id,
                            'assignment_text' => $assignment_text));

        //Context validation
        //OPTIONAL but in most web service it should present
        //$context = get_context_instance(CONTEXT_USER, $USER->id);
        //self::validate_context($context);

        //Capability checking
        //OPTIONAL but in most web service it should present
        //if (!has_capability('moodle/user:viewdetails', $context)) {
            //throw new moodle_exception('cannotviewprofile');
        //}
        
        $cm = get_coursemodule_from_id('assign', $assignment_id, 
                                        0, false, MUST_EXIST);
        $course = $DB->get_record(
            'course', array('id' => $cm->course), '*', MUST_EXIST);
        $asgn = new assign($context, $cm, $course);
        $assignment_instance = $asgn->get_instance();
        $assignment_instance->intro = $assignment_text;
		$asgn->update_calendar($cm);
        
        return $DB->update_record('assign', $assignment_instance);
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function update_description_returns() {
        return new external_value(PARAM_TEXT, 'Returns true or false depending on wether update succed or not');
    }
}
