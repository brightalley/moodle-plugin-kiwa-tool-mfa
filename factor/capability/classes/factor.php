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

namespace factor_capability;

use tool_mfa\local\factor\object_factor_base;

/**
 * User capability factor class.
 *
 * @package     factor_capability
 * @author      Peter Burnett <peterburnett@catalyst-au.net>
 * @copyright   Catalyst IT
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class factor extends object_factor_base {

    /**
     * User capability implementation.
     * This factor is a singleton, return single instance.
     *
     * @param stdClass $user the user to check against.
     * @return array
     */
    public function get_all_user_factors($user) {
        return $this->get_singleton_user_factor($user);
    }

    /**
     * User capability implementation.
     * Factor has no input
     *
     * {@inheritDoc}
     */
    public function has_input() {
        return false;
    }

    /**
     * User capability implementation.
     * Checks whether user has the negative capability.
     *
     * {@inheritDoc}
     */
    public function get_state() {
        global $USER;
        $adminpass = (bool) get_config('factor_capability', 'adminpasses');

        // Do anything check is controlled from factor config.
        if (!has_capability('factor/capability:cannotpassfactor', \context_system::instance(), $USER, $adminpass)) {
            return \tool_mfa\plugininfo\factor::STATE_PASS;
        } else {
            return \tool_mfa\plugininfo\factor::STATE_NEUTRAL;
        }
    }

    /**
     * User Capability implementation.
     * Cannot set state, return true.
     *
     * @param mixed $state the state constant to set
     * @return bool
     */
    public function set_state($state) {
        return true;
    }

    /**
     * User capability implementation.
     * Possible states are either neutral or pass.
     *
     * @param \stdClass $user
     */
    public function possible_states($user) {
        return [
            \tool_mfa\plugininfo\factor::STATE_PASS,
            \tool_mfa\plugininfo\factor::STATE_NEUTRAL,
        ];
    }
}
