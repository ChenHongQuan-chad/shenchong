<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage ELECTROSERV
 * @since ELECTROSERV 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('electroserv_storage_get')) {
	function electroserv_storage_get($var_name, $default='') {
		global $ELECTROSERV_STORAGE;
		return isset($ELECTROSERV_STORAGE[$var_name]) ? $ELECTROSERV_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('electroserv_storage_set')) {
	function electroserv_storage_set($var_name, $value) {
		global $ELECTROSERV_STORAGE;
		$ELECTROSERV_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('electroserv_storage_empty')) {
	function electroserv_storage_empty($var_name, $key='', $key2='') {
		global $ELECTROSERV_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($ELECTROSERV_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($ELECTROSERV_STORAGE[$var_name][$key]);
		else
			return empty($ELECTROSERV_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('electroserv_storage_isset')) {
	function electroserv_storage_isset($var_name, $key='', $key2='') {
		global $ELECTROSERV_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($ELECTROSERV_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($ELECTROSERV_STORAGE[$var_name][$key]);
		else
			return isset($ELECTROSERV_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('electroserv_storage_inc')) {
	function electroserv_storage_inc($var_name, $value=1) {
		global $ELECTROSERV_STORAGE;
		if (empty($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = 0;
		$ELECTROSERV_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('electroserv_storage_concat')) {
	function electroserv_storage_concat($var_name, $value) {
		global $ELECTROSERV_STORAGE;
		if (empty($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = '';
		$ELECTROSERV_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('electroserv_storage_get_array')) {
	function electroserv_storage_get_array($var_name, $key, $key2='', $default='') {
		global $ELECTROSERV_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($ELECTROSERV_STORAGE[$var_name][$key]) ? $ELECTROSERV_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($ELECTROSERV_STORAGE[$var_name][$key][$key2]) ? $ELECTROSERV_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('electroserv_storage_set_array')) {
	function electroserv_storage_set_array($var_name, $key, $value) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if ($key==='')
			$ELECTROSERV_STORAGE[$var_name][] = $value;
		else
			$ELECTROSERV_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('electroserv_storage_set_array2')) {
	function electroserv_storage_set_array2($var_name, $key, $key2, $value) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if (!isset($ELECTROSERV_STORAGE[$var_name][$key])) $ELECTROSERV_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$ELECTROSERV_STORAGE[$var_name][$key][] = $value;
		else
			$ELECTROSERV_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('electroserv_storage_merge_array')) {
	function electroserv_storage_merge_array($var_name, $key, $value) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if ($key==='')
			$ELECTROSERV_STORAGE[$var_name] = array_merge($ELECTROSERV_STORAGE[$var_name], $value);
		else
			$ELECTROSERV_STORAGE[$var_name][$key] = array_merge($ELECTROSERV_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('electroserv_storage_set_array_after')) {
	function electroserv_storage_set_array_after($var_name, $after, $key, $value='') {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if (is_array($key))
			electroserv_array_insert_after($ELECTROSERV_STORAGE[$var_name], $after, $key);
		else
			electroserv_array_insert_after($ELECTROSERV_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('electroserv_storage_set_array_before')) {
	function electroserv_storage_set_array_before($var_name, $before, $key, $value='') {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if (is_array($key))
			electroserv_array_insert_before($ELECTROSERV_STORAGE[$var_name], $before, $key);
		else
			electroserv_array_insert_before($ELECTROSERV_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('electroserv_storage_push_array')) {
	function electroserv_storage_push_array($var_name, $key, $value) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($ELECTROSERV_STORAGE[$var_name], $value);
		else {
			if (!isset($ELECTROSERV_STORAGE[$var_name][$key])) $ELECTROSERV_STORAGE[$var_name][$key] = array();
			array_push($ELECTROSERV_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('electroserv_storage_pop_array')) {
	function electroserv_storage_pop_array($var_name, $key='', $defa='') {
		global $ELECTROSERV_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($ELECTROSERV_STORAGE[$var_name]) && is_array($ELECTROSERV_STORAGE[$var_name]) && count($ELECTROSERV_STORAGE[$var_name]) > 0) 
				$rez = array_pop($ELECTROSERV_STORAGE[$var_name]);
		} else {
			if (isset($ELECTROSERV_STORAGE[$var_name][$key]) && is_array($ELECTROSERV_STORAGE[$var_name][$key]) && count($ELECTROSERV_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($ELECTROSERV_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('electroserv_storage_inc_array')) {
	function electroserv_storage_inc_array($var_name, $key, $value=1) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if (empty($ELECTROSERV_STORAGE[$var_name][$key])) $ELECTROSERV_STORAGE[$var_name][$key] = 0;
		$ELECTROSERV_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('electroserv_storage_concat_array')) {
	function electroserv_storage_concat_array($var_name, $key, $value) {
		global $ELECTROSERV_STORAGE;
		if (!isset($ELECTROSERV_STORAGE[$var_name])) $ELECTROSERV_STORAGE[$var_name] = array();
		if (empty($ELECTROSERV_STORAGE[$var_name][$key])) $ELECTROSERV_STORAGE[$var_name][$key] = '';
		$ELECTROSERV_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('electroserv_storage_call_obj_method')) {
	function electroserv_storage_call_obj_method($var_name, $method, $param=null) {
		global $ELECTROSERV_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($ELECTROSERV_STORAGE[$var_name]) ? $ELECTROSERV_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($ELECTROSERV_STORAGE[$var_name]) ? $ELECTROSERV_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('electroserv_storage_get_obj_property')) {
	function electroserv_storage_get_obj_property($var_name, $prop, $default='') {
		global $ELECTROSERV_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($ELECTROSERV_STORAGE[$var_name]->$prop) ? $ELECTROSERV_STORAGE[$var_name]->$prop : $default;
	}
}
?>