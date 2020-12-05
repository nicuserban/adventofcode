<?php

$file = 'adv_day_7.txt';

$circuit = emulate_circuit($file);

echo '<pre>';
var_dump($circuit);
echo '</pre>';

echo '<pre>';
var_dump($circuit['a']);
echo '</pre>';

function emulate_circuit($file)
{
    $handle = fopen($file, 'r');
    $instruction_set = array();
    $circuit = array();
    while ($string = fgets($handle)) {
        if (!empty($string)) {
            $instruction_arr = explode('->', $string);
            if (count($instruction_arr) == 2) {
                $instruction = trim($instruction_arr[0]);
                $output_wire = trim($instruction_arr[1]);
                $instruction_set[$output_wire] = $instruction;
                $circuit[$output_wire] = null;
            }
        }
    }

    $max = pow(2, 16) - 1;

    /*
    **Loop through instruction set. If the signal value has not been calculated 
    **for the current wire, try to get it through a recursive function, 
    **which will also assign values to wires as it gets them, but will return the new value either way.
    */
    foreach ($instruction_set as $output_wire => $instruction) {
        if (!isset($circuit[$output_wire]))
            $circuit[$output_wire] = get_wire_signal($circuit, $instruction_set, $output_wire, $instruction, $max);
    }

    return $circuit;
}

function get_wire_signal(&$circuit, $instruction_set, $output_wire, $instruction, $max)
{
    if (isset($circuit[$output_wire]) && is_numeric($circuit[$output_wire]))
        return intval($circuit[$output_wire]);

    if (substr_count($instruction, 'AND')) {
        $inputs_arr = explode('AND', $instruction);
        if (count($inputs_arr) == 2) {
            $input_1 = $inputs_arr[0];
            $input_2 = $inputs_arr[1];
            $input_1 = validate_input($circuit, $instruction_set, $input_1, $max);
            $input_2 = validate_input($circuit, $instruction_set, $input_2, $max);


            if (isset($input_1) && isset($input_2)) {
                $val = $input_1 & $input_2;
                $circuit[$output_wire] = $val;
                return $val;
            }
        }
        return null;
    } elseif (substr_count($instruction, 'OR')) {
        $inputs_arr = explode('OR', $instruction);
        if (count($inputs_arr) == 2) {
            $input_1 = $inputs_arr[0];
            $input_2 = $inputs_arr[1];
            $input_1 = validate_input($circuit, $instruction_set, $input_1, $max);
            $input_2 = validate_input($circuit, $instruction_set, $input_2, $max);

            if (isset($input_1) && isset($input_2)) {
                $val = $input_1 | $input_2;
                $circuit[$output_wire] = $val;
                return $val;
            }
        }
        return null;
    } elseif (substr_count($instruction, 'NOT')) {
        $input = str_replace('NOT ', '', $instruction);
        $input = validate_input($circuit, $instruction_set, $input, $max);
        if (isset($input)) {
            $val = ~$input;
            $val = $max + $val + 1;
            $circuit[$output_wire] = $val;
            return $val;
        }
        return null;
    } elseif (substr_count($instruction, 'LSHIFT')) {
        $inputs_arr = explode('LSHIFT', $instruction);
        if (count($inputs_arr) == 2) {
            $input = $inputs_arr[0];
            $input = validate_input($circuit, $instruction_set, $input, $max);
            $shift_val = intval(trim($inputs_arr[1]));
            if (isset($input)) {
                $val = $input << $shift_val;
                $circuit[$output_wire] = $val;
                return $val;
            }
        }
        return null;
    } elseif (substr_count($instruction, 'RSHIFT')) {
        $inputs_arr = explode('RSHIFT', $instruction);
        if (count($inputs_arr) == 2) {
            $input = $inputs_arr[0];
            $input = validate_input($circuit, $instruction_set, $input, $max);
            $shift_val = intval(trim($inputs_arr[1]));
            if (isset($input)) {
                $val = $input >> $shift_val;
                $circuit[$output_wire] = $val;
                return $val;
            }
        }
        return null;
    } else {
        if (is_numeric($instruction))
            return $instruction;
        elseif (isset($instruction_set[$instruction]))
            return get_wire_signal($circuit, $instruction_set, $instruction, $instruction_set[$instruction], $max);

        return null;
    }

    return null;
}

function validate_input(&$circuit, $instruction_set, $input, $max)
{
    $input = trim($input);
    if (is_numeric($input))
        return intval($input);
    elseif (isset($instruction_set[$input]))
        return get_wire_signal($circuit, $instruction_set, $input, $instruction_set[$input], $max);
    else
        return null;
}