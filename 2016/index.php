<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
set_time_limit(10800);
ini_set('memory_limit', '3072M');
ini_set('xdebug.max_nesting_level', 50000);

echo "\n".strtoupper('adventofcode.com 2016')."\n\n";

$bench = bench();

function show_answers($a = ''){
  list($day, $part) = explode('.', $a);

  $func = 'day'.$day.'_'.$part;
  if ($day && $part && function_exists($func))
    print_answer($a, call_user_func($func));
}

show_answers($argv[1]);

function print_answer($day, $answer){
  global $bench;

  echo $day.' : '.$answer.bench_print()."\n";

  $bench = bench();
}

function bench($calc = FALSE, $start = FALSE, $end = FALSE){
  if ($calc && count($start) == 2 && count($end) == 2)
    return ($end[0] - $start[0]) + bcsub($end[1], $start[1], 5);
  else{
    $mtime = explode(' ', microtime());
    $msec = (double)$mtime[0];
    $sec = (double)$mtime[1];

    return array($sec, $msec);
  }
}

function bench_print(){
  global $bench;

  return ' ['.round(bench(TRUE, $bench, bench()), 2).'s]';
}
function day1_blocks($part){
  $file = file_get_contents('day1.txt');
  $data = explode(', ', $file);

  $face = 'n';
  $x = $y = 0;
  $visited = array($x.'|'.$y);

  foreach ($data as $i){
  	$direction = $i{0};
  	$blocks = preg_replace('/\D/', '', $i);

    switch ($direction){
      case 'R' :
      	switch ($face){
      		case 'n' : $face = 'e'; break;
      		case 'e' : $face = 's'; break;
      		case 's' : $face = 'w'; break;
      		case 'w' : $face = 'n'; break;
      	}
      	break;

      case 'L' :
      	switch ($face){
      		case 'n' : $face = 'w'; break;
      		case 'e' : $face = 'n'; break;
      		case 's' : $face = 'e'; break;
      		case 'w' : $face = 's'; break;
      	}
      	break;
    }

    for ($c = 0; $c < $blocks; $c++){
	  	switch ($face){
	  		case 'n' : $y++; break;
	  		case 'e' : $x++; break;
	  		case 's' : $y--; break;
	  		case 'w' : $x--; break;
	  	}

	  	if ($part == 2){
	  		if (in_array($x.'|'.$y, $visited))
	  			return abs($x) + abs($y);

	  		$visited[] = $x.'|'.$y;
	  	}
	  }
  }

  return abs($x) + abs($y);
}

function day1_1(){
  return day1_blocks(1);
}

function day1_2(){
  return day1_blocks(2);
}

function day2_code($keypad, $x, $y){
  $file = file_get_contents('day2.txt');
  $datas = explode("\r\n", $file);

  $code = '';

  foreach ($datas as $data){
  	$instructions = str_split($data);

  	foreach ($instructions as $i){
  		$x_new = $x;
  		$y_new = $y;

  		switch ($i){
  			case 'U' : $x_new--; break;
  			case 'D' : $x_new++; break;
  			case 'L' : $y_new--; break;
  			case 'R' : $y_new++; break;
  		}

  		if ($keypad[$x_new][$y_new]){
  			$x = $x_new;
  			$y = $y_new;
  		}
  	}

  	$code .= $keypad[$x][$y];
  }

  return $code;
}

function day2_1(){
  $keypad = array(
  	array(1, 2, 3),
  	array(4, 5, 6),
  	array(7, 8, 9),
  );

  $x = $y = 1;

  return day2_code($keypad, $x, $y);
}

function day2_2(){
  $keypad = array(
  	array(false, false, 1, false, false),
  	array(false, 2, 3, 4, false),
  	array(5, 6, 7, 8, 9),
  	array(false, 'A', 'B', 'C', false),
  	array(false, false, 'D', false, false),
  );

  $x = 2;
  $y = 0;

  return day2_code($keypad, $x, $y);
}

function day3_1(){
  $file = file_get_contents('day3.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $data){
  	$triangle = preg_split('/\s+/', trim($data));

  	sort($triangle, SORT_NUMERIC);

  	if ($triangle[0] + $triangle[1] > $triangle[2])
  		$valid++;
  }

  return $valid;
}

function day3_2(){
  $file = file_get_contents('day3.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $data){
  	$sides[] = preg_split('/\s+/', trim($data));
  }

  for ($i = 0; $i < count($sides[0]); $i++){
  	$column = array_column($sides, $i);

  	do {
	  	$triangle = array();
	  	for ($j = 0; $j < 3; $j++){
	  		$triangle[] = current($column);
	  		next($column);
	  	}

	  	sort($triangle, SORT_NUMERIC);

	  	if ($triangle[0] + $triangle[1] > $triangle[2])
	  		$valid++;
	  } while (current($column));
  }

  return $valid;
}

function day4_real(){
	global $real_rooms;

	$file = file_get_contents('day4.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $data){
  	if (preg_match('/^([\w\-]+)\-(\d+)\[(\w+)\]$/', $data, $parts)){
	  	list($foo, $name, $sector, $checksum) = $parts;

	  	$chars = count_chars(str_replace('-', '', $name));
	  	arsort($chars);

	  	$count = array();
	  	foreach ($chars as $c => $n){
	  		$count[$n][] = chr($c);
	  	}

	  	$checksum_name = '';
	  	foreach ($count as $chars){
	  		sort($chars);
	  		foreach ($chars as $char)
	  			$checksum_name .= $char;
	  	}

	  	if (substr($checksum_name, 0, 5) == $checksum){
	  		$real_rooms[$name] = $sector;
	  		$sum += $sector;
	  	}
	  }
  }

  return $sum;
}

function day4_1(){
	return day4_real();
}

function day4_2(){
	global $real_rooms;

	day4_real();

	foreach ($real_rooms as $name => $sector){
		$name = str_split($name);

		foreach ($name as $key => $char){
			for ($i = 0; $i < $sector; $i++){
				switch ($char){
					case '-' : $char = ' '; break;
					case ' ' : $char = ' '; break;
					case 'z' : $char = 'a'; break;
					default : $char = chr(ord($char) + 1);
				}
			}

			$name[$key] = $char;
		}

		if (strpos(implode('', $name), 'north') !== false)
			return $sector;
	}
}

function day5_1(){
	$input = file_get_contents('day5.txt');

	$length = 8;
	$index = 0;

	for ($i = 0; $i < $length; $i++){
		$char = false;

		do {
			$hash = md5($input.$index++);

			if (substr($hash, 0, 5) === '00000')
				$char = $hash{5};
		} while (!$char);

		$pass .= $char;
	}

	return $pass;
}

function day5_2(){
	$input = file_get_contents('day5.txt');

	$index = 0;
	$pass = '________';

	do {
		$char = false;

		do {
			$hash = md5($input.$index++);
			$position = $hash{5};

			if (substr($hash, 0, 5) === '00000' && preg_match('/[0-7]/', $position) && $pass{$position} == '_'){
				$char = $hash{6};
			}
		} while ($char === false);

		$pass{$position} = $char;

		echo $pass.PHP_EOL;
	} while (strpos($pass, '_') !== false);

	return $pass;
}

function day6_arrange(){
	$file = file_get_contents('day6.txt');
  $datas = explode("\r\n", $file);

  $chars = array();

  foreach ($datas as $data){
  	foreach (str_split($data) as $position => $char){
  		$chars[$position] .= $char;
  	}
  }

  return $chars;
}

function day6_1(){
  foreach (day6_arrange() as $position => $string){
  	$count = count_chars($string, 1);
		asort($count);

		$count = array_flip($count);
		$message .= chr(array_pop($count));
  }

  return $message;
}

function day6_2(){
  foreach (day6_arrange() as $position => $string){
  	$count = count_chars($string, 1);
		asort($count);

		$count = array_flip($count);
		$message .= chr(array_shift($count));
  }

  return $message;
}

function day7_abba($string){
	for ($i = 0; $i <= strlen($string) - 4; $i++){
		$check = substr($string, $i, 4);

		if ($check{0}.$check{1} == $check{3}.$check{2} && $check{0} <> $check{1})
			return true;
	}

	return false;
}

function day7_aba($string){
	$abas = array();

	for ($i = 0; $i <= strlen($string) - 3; $i++){
		$check = substr($string, $i, 3);

		if ($check{0} == $check{2} && $check{0} <> $check{1})
			$abas[] = $check;
	}

	return $abas;
}

function day7_1(){
	$file = file_get_contents('day7.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $data){
  	$matches = preg_split('/[\[\]]/', $data);

  	$matches0 = $matches1 = array();
  	foreach ($matches as $key => $match){
  		if ($key % 2) // uneven
  			$matches0[] = $match;
  		else // even
  			$matches1[] = $match;
  	}

  	$flag_tls = false;
  	foreach ($matches1 as $match){
  		if (day7_abba($match))
  			$flag_tls = true;
  	}

  	foreach ($matches0 as $match){
  		if (day7_abba($match))
  			$flag_tls = false;
  	}

  	if ($flag_tls)
  		$tls++;
  }

  return $tls;
}

function day7_2(){
	$file = file_get_contents('day7.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $data){
  	$matches = preg_split('/[\[\]]/', $data);

  	$matches0 = $matches1 = array();
  	foreach ($matches as $key => $match){
  		if ($key % 2) // uneven
  			$matches0[] = $match;
  		else // even
  			$matches1[] = $match;
  	}

  	$flag_ssl = false;
  	$abas = array();

  	foreach ($matches1 as $match)
  		$abas = array_unique(array_merge(day7_aba($match), $abas));

  	foreach ($abas as $aba){
  		$bab = $aba{1}.$aba{0}.$aba{1};

  		foreach ($matches0 as $match){
  			if (strpos($match, $bab) !== false)
  				$flag_ssl = true;
  		}
  	}

  	if ($flag_ssl)
  		$ssl++;
  }

  return $ssl;
}

function day8_display(){
	global $display;

	array_walk_recursive($display, 'day8_walk');

	echo "\n";
}

function day8_walk($item, $key){
	global $x_max;

	echo $item.($key == $x_max - 1 ? "\n" : "");
}

function day8_rect($specs){
	global $display;

	list($x, $y) = explode('x', $specs);

	for ($i = 0; $i < $y; $i++){
		$display[$i] = array_replace($display[$i], array_fill(0, $x, '#'));
	}
}

function day8_rotate_row($direction, $pixels){
	global $display;

	list($foo, $row) = explode('=', $direction);

	for ($i = 0; $i < $pixels; $i++){
		$pixel = array_pop($display[$row]);
		array_unshift($display[$row], $pixel);
	}
}

function day8_rotate_column($direction, $pixels){
	global $display;

	list($foo, $column) = explode('=', $direction);

	for ($i = 0; $i < $pixels; $i++){
		for ($j = 0; $j < count($display); $j++)
			$pixel[$j] = $display[$j][$column];

		$pixel_pop = array_pop($pixel);
		array_unshift($pixel, $pixel_pop);

		for ($j = 0; $j < count($display); $j++)
			$display[$j][$column] = $pixel[$j];
	}
}

function day8_1(){
  global $display, $x_max;

	$file = file_get_contents('day8.txt');
  $datas = explode("\r\n", $file);

  $x_max = 50;
  $y_max = 6;

  $display = array();
  for ($i = 0; $i < $y_max; $i++)
  	$display[] = array_fill(0, $x_max, '.');

  foreach ($datas as $key => $data){
  	list($operation, $specs) = explode(' ', $data, 2);
  	switch ($operation){
  		case 'rect' : day8_rect($specs); break;

  		case 'rotate' :
  			list($axis, $direction, $by, $pixels) = explode(' ', $specs, 4);
  			switch ($axis){
  				case 'row' : day8_rotate_row($direction, $pixels); break;
  				case 'column' : day8_rotate_column($direction, $pixels); break;
  			}
  			break;
  	}
  }

  foreach ($display as $row){
		$values = array_count_values($row);

		$count += $values['#'];
  }

	return $count;
}

function day8_2(){
	day8_1();

	day8_display();
}

function day9_1(){
	$input = file_get_contents('day9.txt');

	$offset = 0;

	do {
		$offset = strpos($input, '(', $offset);

		if ($offset !== false){
			preg_match('/^\((\d+)x(\d+)\)/', substr($input, $offset), $matches);

			list($marker, $chars, $repeat) = $matches;

			$sequence = substr($input, $offset + strlen($marker), $chars);

			$decompressed = '';
			for ($i = 0; $i < $repeat; $i++)
				$decompressed .= $sequence;

			$input = str_replace($marker.$sequence, $decompressed, $input);

			$offset += strlen($decompressed);
		}
	} while ($offset);

	return strlen($input);
}

function day9_2(){
	$input = file_get_contents('day9.txt');

	$offset = 0;

	do {
		$offset = strpos($input, '(', $offset);

		if ($offset !== false){
			preg_match('/^\((\d+)x(\d+)\)/', substr($input, $offset), $matches);

			list($marker, $chars, $repeat) = $matches;

			$sequence = substr($input, $offset + strlen($marker), $chars);

			$decompressed = '';
			for ($i = 0; $i < $repeat; $i++)
				$decompressed .= $sequence;

			$input = str_replace($marker.$sequence, $decompressed, $input);

			#$offset += strlen($decompressed);
		}
	} while ($offset !== false);

	#var_dump($input);

	return strlen($input);
}

function day10_two_chips($bots){
  foreach ($bots as $bot => $instructions){
    if (count($instructions['chips']) == 2)
      return true;
  }

  return false;
}

function day10_instruction($bot){
  global $bots, $output, $compare, $n;

  $instructions = $bots[$bot];

  if (count($instructions['chips']) == 2){
    list($chip1, $chip2) = $instructions['chips'];

    $low = min($chip1, $chip2);
    $high = max($chip1, $chip2);

    if ($low == $compare['low'] && $high == $compare['high']){
      return $bot;
    }

    $bots[$bot]['chips'] = array();

    list($to, $number) = explode(' ', $instructions['low']);
    #var_dump(++$n.') bot '.$bot.' low '.$low.' to '.$to.' '.$number);
    switch ($to){
      case 'bot' : $bots[$number]['chips'][] = $low; break;
      case 'output' : $output[$number] = $low; break;
    }

    list($to, $number) = explode(' ', $instructions['high']);
    #var_dump(++$n.') bot '.$bot.' high '.$high.' to '.$to.' '.$number);
    switch ($to){
      case 'bot' : $bots[$number]['chips'][] = $high; break;
      case 'output' : $output[$number] = $high; break;
    }
  }
}

function day10_input(){
  global $bots, $output, $compare;

  $file = file_get_contents('day10.txt');
  $datas = explode("\r\n", $file);

  $bots = $output = array();

  foreach ($datas as $instruction){
    if (preg_match('/^value (\d+) goes to bot (\d+)$/', $instruction, $matches)){
      list($foo, $value, $bot) = $matches;

      $bots[$bot]['chips'][] = $value;
    }elseif (preg_match('/^bot (\d+) gives low to (\w+ \d+) and high to (\w+ \d+)$/', $instruction, $matches)){
      list($foo, $bot, $low, $high) = $matches;

      $bots[$bot]['low'] = $low;
      $bots[$bot]['high'] = $high;
    }
  }
}

function day10_1(){
  global $bots, $output, $compare;

  $compare = array('low' => 17, 'high' => 61);
  day10_input();

  do {
    foreach ($bots as $bot => $instructions){
      if ($answer = day10_instruction($bot))
        return $answer;
    }
  } while (day10_two_chips($bots));
}


function day10_2(){
  global $bots, $output, $compare;

  $compare = array();
  day10_input();

  do {
    foreach ($bots as $bot => $instructions)
      day10_instruction($bot);
  } while (day10_two_chips($bots));

  ksort($output);
  return array_product(array_slice($output, 0, 3));
}

function day11_assemble(){
  global $floors;

  for ($i = 1; $i <= count($floors) - 1; $i++){
    if (count($floors[$i]['microchip']) || count($floors[$i]['generator']))
      return false;
  }

  return true;
}

function day11_test($object, $floor){

}

function day11_1(){
  global $floors;

  $file = file_get_contents('day11test.txt');
  $datas = explode("\r\n", $file);

  $elevator = array(
    'floor' => 1,
    'contents' => array(),
  );

  foreach ($datas as $floor => $data){
    preg_match('/^The \w+ floor contains (.*)./', $data, $matches);

    $objects = preg_split('/, and |, | and /', $matches[1]);

    foreach ($objects as $object){
      if (substr($object, 0, 2) == 'a '){
        list($foo, $element, $type) = explode(' ', $object);

        $floors[$floor + 1][$type][] = str_replace('-compatible', '', $element);
      }
    }
  }

  do {
    $objects = $floors[$elevator['floor']];


  } while (!day11_assemble());

  var_dump($floors);
}

function day12_interpreter($data, &$register){
  list($instruction, $value, $to) = explode(' ', $data);

  /*$debug = ++$n.') '.str_pad($data, 10, ' ', STR_PAD_RIGHT)."\t".key($datas);
  $d = $register['d'];*/

  switch ($instruction){
    case 'cpy' :
      if (preg_match('/\D/', $value))
        $value = $register[$value];

      $register[$to] += $value;
      next($datas);
      break;

    case 'inc' :
      $register[$value]++;
      next($datas);
      break;

    case 'dec' :
      $register[$value]--;
      next($datas);
      break;

    case 'jnz' :
      if (preg_match('/\D/', $value))
        $value = $register[$value];

      if ($value <> 0){
        for ($i = 0; $i < abs($to); $i++)
          $to < 0 ? prev($datas) : next($datas);
      }else
        next($datas);
      break;
  }

  /*$debug .= ' > '.key($datas)."\t".' [ a = '.str_pad($register['a'], 10, ' ', STR_PAD_LEFT).' / b = '.str_pad($register['b'], 10, ' ', STR_PAD_LEFT).' / c = '.str_pad($register['c'], 10, ' ', STR_PAD_LEFT).' / d = '.str_pad($register['d'], 10, ' ', STR_PAD_LEFT).' ]'."\n";

  if ($register['d'] <> $d)
    echo $debug;*/
}

function day12_1(){
  $file = file_get_contents('day12.txt');
  $datas = explode("\r\n", $file);

  $register = array(
    'a' => 0,
    'b' => 0,
    'c' => 0,
    'd' => 0,
  );

  while ($data = current($datas)){
    day12_interpreter($data, $register);
  }

  var_dump($register);
}

function day14_keys($keys_total, $stretches, $lookahead){
  global $hashes;

  $input = file_get_contents('day14.txt');

  $keys = $hashes = array();
  $index = 0;

  do {
    $md5 = day14_md5_stretch($input, $index, $stretches);

    if (preg_match('/(.)\\1{2}/', $md5, $matches)){
      $match = $matches[0];
      for ($i = 1; $i <= $lookahead; $i++){
        $md52 = day14_md5_stretch($input, $index + $i, $stretches);

        if (preg_match('/('.$match{0}.')\\1{4}/', $md52)){
          if (!in_array($md5, $keys)){
            $keys[] = $md5;
            echo '#'.count($keys).' : '.$md5.' ['.$index.' & '.($index + $i).']'.PHP_EOL;

            break;
          }
        }
      }
    }

    $index++;
  } while (count($keys) < $keys_total);

  echo PHP_EOL;

  return $index - 1;
}

function day14_md5_stretch($input, $index, $stretches){
  global $hashes;

  if ($hashes[$index])
    return $hashes[$index];

  $string = md5($input.$index);

  for ($i = 0; $i < $stretches; $i++)
    $string = md5($string);

  $hashes[$index] = $string;

  return $string;
}

function day14_1(){
  $keys_total = 64;
  $stretches = 0;
  $lookahead = 1000;

  return day14_keys($keys_total, $stretches, $lookahead);
}

function day14_2(){
  $keys_total = 64;
  $stretches = 2016;
  $lookahead = 1000;

  return day14_keys($keys_total, $stretches, $lookahead);
}

function day15_discs(){
  $file = file_get_contents('day15.txt');
  $datas = explode("\r\n", $file);

  $discs = array();
  foreach ($datas as $data){
    preg_match('/Disc #(\d+) has (\d+) positions; at time=0, it is at position (\d+)./', $data, $matches);

    $discs[$matches[1]] = array('positions' => intval($matches[2]), 'start' => intval($matches[3]));
  }

  return $discs;
}

function day15_capsule($discs){
  $time = 0;

  do {
    $tick = $time++;

    foreach ($discs as $disc => $prop){
      $aligned = false;

      if (($prop['start'] + ++$tick) % $prop['positions'] != 0)
        break;

      $aligned = true;
    }
  } while (!$aligned);

  return $time - 1;
}

function day15_1(){
  $discs = day15_discs();

  return day15_capsule($discs);
}

function day15_2(){
  $discs = day15_discs();
  $discs[] = array('positions' => 11, 'start' => 0);

  return day15_capsule($discs);
}

function day16_checksum($length){
  $input = file_get_contents('day16.txt');

  $a = $input;
  do {
    $a .= '0'.strtr(strrev($a), array(0 => 1, 1 => 0));
  } while (strlen($a) < $length);

  $data = substr($a, 0, $length);

  do {
    $checksum = '';

    for ($i = 0; $i < strlen($data); $i += 2){
      $pair = substr($data, $i, 2);

      $checksum .= $pair{0} == $pair{1} ? 1 : 0;
    }

    $data = $checksum;
  } while (strlen($checksum) % 2 == 0);

  return $checksum;
}

function day16_1(){
  $length = 272;

  return day16_checksum($length);
}

function day16_2(){
  $length = 35651584;

  return day16_checksum($length);
}

function day18_calc($rows){
  $input = file_get_contents('day18.txt');

  $tiles = array(0 => $input);
  $cols = strlen($input);

  for ($r = 1; $r < $rows; $r++){
    $row = '';

    for ($c = 0; $c < $cols; $c++){
      $safe = true;

      $left = $tiles[$r - 1][$c - 1] ?: '.';
      $center = $tiles[$r - 1][$c] ?: '.';
      $right = $tiles[$r - 1][$c + 1] ?: '.';

      $pattern = $left.$center.$right;

      if ($pattern == '^^.' || $pattern == '.^^' || $pattern == '^..' || $pattern == '..^')
        $safe = false;

      $row .= $safe ? '.' : '^';
    }

    $tiles[] = $row;
  }

  $chars = count_chars(implode('', $tiles));

  return $chars[ord('.')];
}

function day18_1(){
  $rows = 40;

  return day18_calc($rows);
}

function day18_2(){
  $rows = 400000;

  return day18_calc($rows);
}

function day19_1(){
  $elves = 3005290;

  $presents = array_fill(1, $elves, 1);

  reset($presents);
  do {
    key($presents) ?: reset($presents);
    next($presents) ?: reset($presents);

    unset($presents[key($presents)]);
  } while (count($presents) > 1);

  reset($presents);
  return key($presents);
}

function day19_2(){
  $elves = 3005290;
  $elves = 5;

  $presents = range(1, $elves);

  $key = 0;
  do {
    $steal = floor(count($presents) / 2) % count($presents);
    unset($presents[$steal + $key - 1]);
    #array_slice($presents, $steal - 1, 1, false);
    #var_dump($presents);

    if (++$key >= count($presents)) $key = 0;
    reset($presents);

    if (++$n % 1000 == 0) echo bench_print()."\n";
  } while (count($presents) > 1);

  reset($presents);
  return current($presents);
}

function day20_1(){
  $file = file_get_contents('day20.txt');
  $datas = explode("\r\n", $file);

  $blocks = array();
  foreach ($datas as $data){
    list($start, $end) = explode('-', $data);

    $blocks[$start] = $end;
  }

  ksort($blocks);

  $lowest = 0;
  while (list($start, $end) = each($blocks)){
    if ($lowest < $start)
      return $lowest;

    if ($lowest < $end)
      $lowest = $end + 1;
  }
}

function day20_2(){
  $file = file_get_contents('day20.txt');
  $datas = explode("\r\n", $file);

  $blocks = array();
  foreach ($datas as $data){
    list($start, $end) = explode('-', $data);

    $blocks[$start] = $end;
  }

  ksort($blocks);

  $lowest = $allowed = 0;
  while (list($start, $end) = each($blocks)){
    if ($lowest < $start)
      $allowed += $start - $lowest;

    if ($lowest < $end)
      $lowest = $end + 1;
  }

  return $allowed;
}

function day21_1(){
  $file = file_get_contents('day21.txt');
  $datas = explode("\r\n", $file);

  $password = 'abcdefgh';

  foreach ($datas as $data){
    $password_prev = $password;

    if (preg_match('/^swap position (\d+) with position (\d+)$/', $data, $matches)){
      list($foo, $x, $y) = $matches;

      $letter_x = $password{$x};
      $letter_y = $password{$y};

      $password{$x} = $letter_y;
      $password{$y} = $letter_x;
    }elseif (preg_match('/^swap letter (\w+) with letter (\w+)$/', $data, $matches)){
      list($foo, $x, $y) = $matches;

      $password = str_replace($x, '%x', $password);
      $password = str_replace($y, '%y', $password);

      $password = str_replace('%x', $y, $password);
      $password = str_replace('%y', $x, $password);
    }elseif (preg_match('/^rotate (left|right) (\d+) step[s]?$/', $data, $matches)){
      list($foo, $direction, $steps) = $matches;

      switch ($direction){
        case 'left' :
          $string = substr($password, 0, $steps);
          $password = substr($password, $steps).$string;
          break;

        case 'right' :
          $string = substr($password, $steps * -1);
          $password = $string.substr($password, 0, $steps * -1);
          break;
      }
    }elseif (preg_match('/^rotate based on position of letter (\w+)$/', $data, $matches)){
      list($foo, $letter) = $matches;

      $index = (strpos($password, $letter) + 1) % (strlen($password) - 1);

      $string = substr($password, $index * -1);
      $password = $string.substr($password, 0, $index * -1);
    }elseif (preg_match('/^reverse positions (\d+) through (\d+)$/', $data, $matches)){
      list($foo, $x, $y) = $matches;

      $string = strrev(substr($password, $x, $y - $x + 1));

      $password = ($x > 0 ? substr($password, 0, $x) : '').$string.($y < strlen($password) ? substr($password, $y + 1, strlen($password) - $y - 1) : '');
    }elseif (preg_match('/^move position (\d+) to position (\d+)$/', $data, $matches)){
      list($foo, $x, $y) = $matches;

      $letter_x = $password{$x};
      $password = substr($password, 0, $x).substr($password, $x + 1);

      $password = substr($password, 0, $y).$letter_x.substr($password, $y);
    }

    var_dump($data, $password_prev.' > '.$password);
  }

  return $password;
}

function day22_nodes(){
  $file = file_get_contents('day22.txt');
  $datas = explode("\r\n", $file);

  $nodes = array();
  foreach ($datas as $data){
    if (preg_match('|^/dev/grid/node-x(\d+)-y(\d+)\s+(\d+)T\s+(\d+)T\s+(\d+)T\s+\d+%$|', $data, $matches)){
      list($foo, $x, $y, $size, $used, $avail, $pct) = $matches;

      $nodes[$x.'.'.$y] = array('size' => $size, 'used' => $used, 'avail' => $avail);
    }
  }

  return $nodes;
}

function day22_print_grid($nodes, $goal){
  global $max_x, $max_y;

  echo str_pad("", 5, " ");

  // print nodes
  for ($y = -1; $y <= $max_y; $y++){
    for ($x = 0; $x <= $max_x; $x++){
      if ($y < 0)
        echo str_pad($x, 5, " ", STR_PAD_BOTH);
      else{
        if ($y >= 0 && $x == 0)
          echo str_pad($y, 3, " ", STR_PAD_LEFT)." ";

        $position = $x.'.'.$y;
        $node = $nodes[$position];

        $draw = '.';
        if ($position == $goal)
          $draw = 'G';
        elseif ($node['used'] == 0)
          $draw = '_';

        if ($position == '0.0')
          $draw = '('.$draw.')';

        echo str_pad($draw, 5, " ", STR_PAD_BOTH);
      }
    }

    echo "\n ";
  }

  echo "\n";

  sleep(3);
}

function day22_find($nodes, $goal){
  list($x, $y) = explode('.', $goal);

  // 1 left (x - 1, y)
  $position = --$x.'.'.$y;
  if (array_key_exists($position, $nodes) && day22_move($nodes, $goal, $position))
    return $position;

  // 2 down (x, y + 1)
  $position = $x.'.'.++$y;
  if (array_key_exists($position, $nodes) && day22_move($nodes, $goal, $position))
    return $position;

  // 3 up (x, y - 1)
  $position = $x.'.'.--$y;
  if (array_key_exists($position, $nodes) && day22_move($nodes, $goal, $position))
    return $position;

  // 4 right (x + 1, y)
  $position = ++$x.'.'.$y;
  if (array_key_exists($position, $nodes) && day22_move($nodes, $goal, $position))
    return $position;

  return false;
}

function day22_move($nodes, $from, $to){
  if ($nodes[$to]['avail'] >= $nodes[$from]['size']){
    $nodes[$to]['used'] += $nodes[$from]['used'];
    $nodes[$to]['avail'] -= $nodes[$from]['used'];

    $nodes[$from]['avail'] = $nodes[$from]['size'];
    $nodes[$from]['used'] = 0;

    return true;
  }

  return false;
}

function day22_1(){
  $nodes = day22_nodes();

  $pairs = 0;
  foreach ($nodes as $position => $node){
    foreach ($nodes as $position2 => $node2){
      if ($node['used'] > 0 && $position <> $position2 && $node['used'] < $node2['avail'])
        $pairs++;
    }
  }

  return $pairs;
}

function day22_2(){
  global $max_x, $max_y;

  $nodes = day22_nodes();

  $max_x = 0;
  foreach ($nodes as $position => $node){
    list($x, $y) = explode('.', $position);

    $max_x = $x > $max_x ? $x : $max_x;
    $max_y = $y > $max_y ? $y : $max_y;
  }

  $goal = $max_x.'.0';

  day22_print_grid($nodes, $goal);

  do {
    $goal = day22_find($nodes, $goal);

    day22_print_grid($nodes, $goal);
  } while ($goal <> '0.0');
}

function day23_1(){

}