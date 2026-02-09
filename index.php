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
 * An example of a React app loaded in a Moodle page, with the React code
 * using Moodle's AJAX library.
 *
 * @package    local_reactdemo
 * @copyright  2026 Catalyst.NET Ltd
 * @author     Aaron Wells <aaronw@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');

require_login();

$url = new moodle_url('/local/reactdemo/index.php', []);
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());

// Because the default build chain adds a random hash to the files after each build,
// I have to use a manifest file to find out the current name of each file.
$manifest = json_decode(file_get_contents('./react/dist/manifest.json'));

$PAGE->set_heading($SITE->fullname);

// Quick and dirty way to load Moodle libraries as dependencies of our React app.
//
// If you can set up a build chain that compiles the React app to AMD modules
// (or possibly to CommonJS modules) then you could probably instead load it
// with the recommended call to $PAGE->requires->js_call_amd()
$PAGE->requires->js('/local/reactdemo/react/dist/' . $manifest->{'index.html'}->file);
$PAGE->requires->js_amd_inline(<<<JS
    require(
        ['core/ajax'], // import Moodle modules
        (ajax) => {
            local_reactdemo_init(ajax);
        }
    );
JS);
// foreach ($manifest->{'index.html'}->css as $css) {
//     $PAGE->requires->css('/local/reactdemo/react/dist/' . $css);
// }
echo $OUTPUT->header();
// TODO: replace this with a Moodle mustache template?
echo '<div id="root"></div>';
echo $OUTPUT->footer();
