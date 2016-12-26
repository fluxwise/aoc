<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
set_time_limit(10800);
ini_set('memory_limit', '3072M');
ini_set('xdebug.max_nesting_level', 50000);

echo "\n".strtoupper('adventofcode.com 2016')."\n\n";

$bench = bench();

function show_answers($a = ''){
  if (!$a || $a == '1.1') print_answer('1.1', day1(1));
  if (!$a || $a == '1.2') print_answer('1.2', day1(2));

  if (!$a || $a == '2.1') print_answer('2.1', day2_1());
  if (!$a || $a == '2.2') print_answer('2.2', day2_2());

  if (!$a || $a == '3.1') print_answer('3.1', day3_1());
  if (!$a || $a == '3.2') print_answer('3.2', day3_2());

  if (!$a || $a == '4.1') print_answer('4.1', day4_1());
  if (!$a || $a == '4.2') print_answer('4.2', day4_2());

  if (!$a || $a == '5.1') print_answer('5.1', day5_1());
  if (!$a || $a == '5.2') print_answer('5.2', day5_2());

  if (!$a || $a == '6.1') print_answer('6.1', day6_1());
  if (!$a || $a == '6.2') print_answer('6.2', day6_2());

  if (!$a || $a == '7.1') print_answer('7.1', day7_1());
  if (!$a || $a == '7.2') print_answer('7.2', day7_2());

  if (!$a || $a == '8.1') print_answer('8.1', day8_1());
  if (!$a || $a == '8.2') print_answer('8.2', day8_2());

  if (!$a || $a == '9.1') print_answer('9.1', day9_1());
  if (!$a || $a == '9.2') print_answer('9.2', day9_2());

  if (!$a || $a == '10.1') print_answer('10.1', day10_1());
  if (!$a || $a == '10.2') print_answer('10.2', day10_2());

  if (!$a || $a == '11.1') print_answer('11.1', day11_1());
  if (!$a || $a == '11.2') print_answer('11.2', day11_2());

  if (!$a || $a == '12.1') print_answer('12.1', day12_1());
  if (!$a || $a == '12.2') print_answer('12.2', day12_2());

  if (!$a || $a == '13.1') print_answer('13.1', day13_1());
  if (!$a || $a == '13.2') print_answer('13.2', day13_2());

  if (!$a || $a == '14.1') print_answer('14.1', day14_1());
  if (!$a || $a == '14.2') print_answer('14.2', day14_2());

  if (!$a || $a == '15.1') print_answer('15.1', day15_1());
  if (!$a || $a == '15.2') print_answer('15.2', day15_2());

  if (!$a || $a == '16.1') print_answer('16.1', day16_1());
  if (!$a || $a == '16.2') print_answer('16.2', day16_2());

  if (!$a || $a == '17.1') print_answer('17.1', day17_1());

  if (!$a || $a == '18.1') print_answer('18.1', day18_1());
  if (!$a || $a == '18.2') print_answer('18.2', day18_2());

  if (!$a || $a == '19.1') print_answer('19.1', day19_1());

  if (!$a || $a == '20.1') print_answer('20.1', day20_1());

  if (!$a || $a == '21.1') print_answer('21.1', day21(1));
  if (!$a || $a == '21.2') print_answer('21.2', day21(2));

  if (!$a || $a == '22.1') print_answer('22.1', day22_1());

  if (!$a || $a == '23.1') print_answer('23.1', day23(0));
  if (!$a || $a == '23.2') print_answer('23.2', day23(1));

  if (!$a || $a == '24.1') print_answer('24.1', day24());

  if (!$a || $a == '25.1') print_answer('25.1', day25(3010, 3019));
}

show_answers($argv[1]);

function print_answer($day, $answer){
  global $bench;

  echo $day.' : '.$answer.' ['.round(bench(TRUE, $bench, bench()), 2).'s]'."\n";

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

function day1($part = 1){
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

  var_dump($visited); exit;

  return abs($x) + abs($y);
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