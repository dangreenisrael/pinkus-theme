<?php

/**
 * Created by PhpStorm.
 * User: Dan
 * Date: 28/07/2016
 * Time: 19:29
 */
class List_Icons {


	/**
	 * Get the list of classes
	 *
	 * @author (original) Alessandro Gubitosi <gubi.ale@iod.io>
	 * @author (modifications) Dan Green-Leipciger <dan@trampolinedigital.com>
	 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
	 *
	 * @param $css_path string
	 * @param $class_prefix string
	 * @return array
	 */
	public static function get_class_list($css_path, $class_prefix) {
		function array_delete($array, $element) {
			return (is_array($element)) ? array_values(array_diff($array, $element)) : array_values(array_diff($array, array($element)));
		}
		$icons_file = get_template_directory()."/$css_path";
		$parsed_file = file_get_contents($icons_file);
		preg_match_all("/$class_prefix\-([a-zA-z0-9\-]+[^\:\.\,\s])/", $parsed_file, $matches);
		$exclude_icons = array("fa-lg", "fa-2x", "fa-3x", "fa-4x", "fa-5x", "fa-ul", "fa-li", "fa-fw", "fa-border", "fa-pulse", "fa-rotate-90", "fa-rotate-180", "fa-rotate-270", "fa-spin", "fa-flip-horizontal", "fa-flip-vertical", "fa-stack", "fa-stack-1x", "fa-stack-2x", "fa-inverse");
		$icons = array_delete($matches[0], $exclude_icons);
		return $icons;
	}

}