<?php

wp_deregister_script( 'jquery' );
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() { return true; }

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array(
	'primary'   => __( 'Top Menu', 'blank' ),
	'secondary' => __( 'Left Sidebar Menu', 'blank' ),
	'tertiary'  => __( 'Practice Areas Menu', 'blank')
) );

function print_wp_nav_menu ($menu, $params=array()) {
/**
       * 
       * Wraps iterated wp_get_nav_menu_items output in customizable HTML
       *
       * @author Aaron John Schlosser <aaron@aaronschlosser.com>
       * @link https://gist.github.com/ajschlosser/daf17648f0f42d1597ec#file-acf_make_two_columns
       * @copyright Copyright 2014 Aaron John Schlosser
       * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2
       * @param array $params  Array containing all other parameters (optional)
       * @return null
       */
	if (!$params || gettype($params) != "array") {
		$params = array();
		$params["menu_class"] = "menu";
		$params["submenu_class"] = "dropdown";
		$params["first_item_class"] = "first";
		$params["last_item_class"] = "last";
		$params["every_item_class"] = "menuizer";
		$params["every_submenu_item_class"] = "menuizer-submenu";
		$params["parent_item_class"] = "has-dropdown";
		$params["parent_item_end"] = "<span class='drop-arrow'></span>";
		$params["close_tag"] = "</li>";
		$params["framework"] = "foundation";
		$params["items_per_column"] = "0";
		$params["column_class"] = "small-12 large-12 columns";
	}
	if ($params && gettype($params) === "array") {
		if (!$params["menu_class"]) $params["menu_class"] = "menu";
		if (!$params["submenu_class"]) $params["submenu_class"] = "dropdown";
		if (!$params["first_item_class"]) $params["first_item_class"] = "first";
		if (!$params["last_item_class"]) $params["last_item_class"] = "last";
		if (!$params["every_item_class"]) $params["every_item_class"] = "menuizer";
		if (!$params["every_submenu_item_class"]) $params["every_submenu_item_class"] = "menuizer-submenu";
		if (!$params["parent_item_class"]) $params["parent_item_class"] = "has-dropdown";
		if (!$params["close_tag"]) $params["close_tag"] = "</li>";
		if (!$params["framework"]) $params["framework"] = "foundation";
		if (!$params["items_per_column"]) $params["items_per_column"] = "0";
		if (!$params["column_class"]) $params["column_class"] = "small-12 large-12 columns";
	}
	$items = wp_get_nav_menu_items($menu);
	$l = count($items);
	$menu_class = $params["menu_class"];
	$submenu_class = $params["submenu_class"];
	$first_item = true;
	$first_child = true;
	$parent_item_class = "";
	$parent_item_end = "";
	$close_tag = $params["close_tag"];
	$every_item_class = "" . $params["every_item_class"];
	$every_submenu_item_class = "" . $params["every_submenu_item_class"];
	$first_item_class = " " . $params["first_item_class"];
	$last_item_class = " " . $params["last_item_class"];
	$items_per_column = $params["items_per_column"];
	$column_class = $params["column_class"];
	echo "<!--Begin Automatically Generated Menu--><ul class='".$menu_class."'><div class='row'>";
	for ($i = 0; $i < $l; $i++) {

		// Check to see if the next item is a child.
		// If the next item is a child, then this one is the parent
		if ($i < $l-1 && $items[$i+1]->menu_item_parent > 0) {
			$parent_item_class = $params["parent_item_class"];
			$parent_item_end = $params["parent_item_end"];
			$close_tag = "";
		} else {
			$parent_item_class = "";
			$parent_item_end = "";
			$close_tag = $params["close_tag"];
		}
		$item = $items[$i];

		// Do this if the item is in a submenu
		if ($item->menu_item_parent > 0) {

			// If it's the _first_ item in the submenu, start the new sub menu before it
			if ($first_child) {
				echo "<!--Begin Automatically Generated Sub Menu--><ul class='".$submenu_class."'>";
				$first_child = false;
			}

			// Otherwise, add it to the already-existing submenu
			echo "<li><a href='".$item->url."' class='".$every_submenu_item_class."'>".$item->title."</a>".$close_tag."";
		}

		// Do this if the item is not in a submenu
		else {

			// If it's the first item after a submenu, close the submenu here
			if (!$first_child) {
				echo "</ul><!--End Automatically Generated Sub Menu-->";
				$first_child = true;
			}

			// Do this if there are columns, and it is the end of a column
			if ($items_per_column > 0) {
				if ($i % $items_per_column === 0 && $i !== 0) {
					echo "</div><div class='".$column_class."'>";
				}
			}

			// Do this if it is the first item
			if ($i === 0) echo "<div class='".$column_class."'><li class='".$parent_item_class."'><a href='".$item->url."' class='".$every_item_class."".$first_item_class."'>".$item->title.$dropdown_code."</a>".$close_tag."";

			// Do this if it is the last item
			else if ($i === $l-1) echo "<li class='".$parent_item_class."'><a href='".$item->url."' class='".$every_item_class."".$last_item_class."'>".$item->title.$dropdown_code."</a>".$close_tag."</div>";

			// Otherwise, just add another item to the menu
			else {
				// But first, see if it isn't in a submenu
				if (!$parent_item_end) echo "<li class='".$parent_item_class."'><a href='".$item->url."' class='".$every_item_class."'>".$item->title.$parent_item_end."</a>".$close_tag."";
				// If it is, do this
				else echo "<li class='".$parent_item_class."'><a href='".$item->url."' class='".$every_item_class." ".$parent_item_class."'>".$item->title.$parent_item_end."</a>".$close_tag."";
			}
		}
	}
	echo "</div></ul><!--End Automatically Generated Menu-->";
	return null;
}

// Advanced Custom Fields Fuctions
function convert_field_to_array ($f) { return explode("</p>", get_field($f)); }
function put_in_paragraph ($p) { return "<p>" . $p . "</p>"; }
function print_first_half ($a) { for($i = 0; $i < ceil(count($a)/2); $i++) { echo put_in_paragraph($a[$i]); } }
function print_second_half ($a) { for($i = ceil(count($a)/2); $i < count($a); $i++) { echo put_in_paragraph($a[$i]); } }
function convert_field_and_print_column ($field, $column="first") {
	$field = convert_field_to_array($field);
	if ($column == "first") print_first_half($field);
	else print_second_half($field);
}
/**
       * 
       * Breaks an ACF field into two divs of evenish columns
       *
       * @author Aaron John Schlosser <aaron@aaronschlosser.com>
       * @link https://gist.github.com/ajschlosser/daf17648f0f42d1597ec#file-acf_make_two_columns
       * @copyright Copyright 2014 Aaron John Schlosser
       * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2
       * @param string $field  The ACF field name (e.g., "about_content")
       * @param array $params  Array containing all other parameters (optional)
       * @param string $class  The desired class to be added to each of the column divs (optional)
       * @param string $delimiter  The delimiter used to break up ACF field content into an iterable array (optional)
       * @param string $tag  Which HTML tag to surround the new paragraphs in (optional)
       * @return null
       */
function acf_make_two_columns ($field, $params=null, $class="large-6 columns", $delimiter="<br />", $tag="p") {
	if ($params && count($params) > 0) {
		if ($params["class"]) $class = $params["class"];
		if ($params["delimiter"]) $delimiter = $params["delimiter"];
		if ($params["tag"]) $tag = $params["tag"];
	}
	$a = explode($delimiter, get_field($field));
	$l = count($a);
	$n = strpos($tag, " ");
	$open_tag = $tag;
	if ($n === false) {
		$n = strlen($tag);
		$close_tag = "</".substr($tag,1,$n-1);
	} else $close_tag = "</".substr($tag,1,$n-1).">";
	$total_length = 0;
	for($i = 1; $i <= $l; $i++) {
		$total_length += strlen($a[$i]);
	}
	$first_half_length = 0;
	$second_half_length = 0;
	$second_half_index = 0;
	$done = false;
	echo "<!--Begin Automatically Generated Columns. Attempting to divide ".$l." paragraphs into two columns each with a class of 'columnize ".$class."'.--><div class='columnize ".$class."'>".$open_tag.$a[0].$close_tag;
	for($i = 1; $i <= $l; $i++) {
		if (!$done) {
		$first_half_length += strlen($a[$i]);
		if ($first_half_length < ceil($total_length/2)) {
			echo $open_tag.$a[$i].$close_tag;
		}
		else {
			echo $open_tag.$a[$i].$close_tag;
			$done = true;
			$second_half_index = $i;
			$second_half_length = $total_length - $first_half_length;
		}
		}
	}
	echo "</div><div class='columnize large-6 columns'>";
	if ($second_half_index > 0) {
		for($i = $second_half_index; $i <= $l; $i++) {
			echo $open_tag.$a[$i].$close_tag;
		}
	} else {
		echo "There was a problem splitting the ACF field into two even columns. Sorry!";
	}
	echo "</div><!--End Automatically Generated Columns.-->";
	return null;
}

?>
