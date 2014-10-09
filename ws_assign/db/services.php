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
 * Web service local plugin for working with assignments 
 * external functions and service definitions.
 *
 * @package    localwsassign
 * @copyright  2014 Artem Pelenitsyn
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = array(
        'local_ws_assign_update_description' => array(
                'classname'   => 'local_ws_assign_external',
                'methodname'  => 'update_description',
                'classpath'   => 'local/ws_assign/externallib.php',
                'description' => 'Update description of the given (by id) assignment with given text',
                'type'        => 'write',
        )
);

// We define the services to install as pre-build services. A pre-build service is not editable by administrator.
$services = array(
        'My assignment service' => array(
                'functions' => array ('local_ws_assign_update_description'),
                'restrictedusers' => 1,
                'enabled' => 1,
        )
);
