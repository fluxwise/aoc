<?php

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
set_time_limit(10800);
ini_set('memory_limit', '2048M');
ini_set('xdebug.max_nesting_level', 50000);

echo "\n".strtoupper('adventofcode.com 2015')."\n\n";

$bench = bench();

function show_answers($a = ''){
  if (!$a || $a == '1.1') print_answer('1.1', day1_1());
  if (!$a || $a == '1.2') print_answer('1.2', day1_2());

  if (!$a || $a == '2.1') print_answer('2.1', day2_1());
  if (!$a || $a == '2.2') print_answer('2.2', day2_2());

  if (!$a || $a == '3.1') print_answer('3.1', day3_1());
  if (!$a || $a == '3.2') print_answer('3.2', day3_2());

  if (!$a || $a == '4.1') print_answer('4.1', day4('00000'));
  if (!$a || $a == '4.2') print_answer('4.2', day4('000000'));

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

  if (!$a || $a == '10.1') print_answer('10.1', day10(40));
  if (!$a || $a == '10.2') print_answer('10.2', day10(50));

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

function day1_1(){
  $file = file_get_contents('day1.txt');
  $data = str_split($file);

  $floor = 0;
  foreach ($data as $c){
    switch ($c){
      case '(' : $floor++; break;
      case ')' : $floor--; break;
    }
  }

  return $floor;
}

function day1_2(){
  $file = file_get_contents('day1.txt');
  $data = str_split($file);

  $floor = $n = 0;
  foreach ($data as $c){
    $n++;

    switch ($c){
      case '(' : $floor++; break;
      case ')' : $floor--; break;
    }

    if ($floor < 0)
      return $n;
  }
}

function day2_1(){
  $file = file_get_contents('day2.txt');
  $datas = explode("\n", $file);

  $paper = 0;
  foreach ($datas as $data){
    $dim = explode("x", $data, 3);

    sort($dim, SORT_NUMERIC);

    $paper += (2 * ($dim[0] * $dim[1])) + (2 * ($dim[1] * $dim[2])) + (2 * ($dim[0] * $dim[2])) + ($dim[0] * $dim[1]);
  }

  return $paper;
}

function day2_2(){
  $file = file_get_contents('day2.txt');
  $datas = explode("\n", $file);

  $ribbon = 0;
  foreach ($datas as $data){
    $dim = explode("x", $data, 3);

    sort($dim, SORT_NUMERIC);

    $ribbon += ($dim[0] * 2) + ($dim[1] * 2) + ($dim[0] * $dim[1] * $dim[2]);
  }

  return $ribbon;
}

function day3_1(){
  $file = file_get_contents('day3.txt');
  $data = str_split($file);

  $houses = array('0|0');
  $x = $y = 0;
  foreach ($data as $d){
    switch ($d){
      case '^' : $x++; break; // north
      case '>' : $y++; break; // east
      case 'v' : $x--; break; // south
      case '<' : $y--; break; // west
    }

    $loc = $x.'|'.$y;

    if (!in_array($loc, $houses))
      $houses[] = $loc;
  }

  return count($houses);
}

function day3_2(){
  $file = file_get_contents('day3.txt');
  $data = str_split($file);

  $houses = array('0|0');
  $sx = $sy = $rx = $ry = 0;
  foreach ($data as $turn => $d){
    switch ($d){
      case '^' : ($turn % 2 ? $rx++ : $sx++); break; // north
      case '>' : ($turn % 2 ? $ry++ : $sy++); break; // east
      case 'v' : ($turn % 2 ? $rx-- : $sx--); break; // south
      case '<' : ($turn % 2 ? $ry-- : $sy--); break; // west
    }

    $loc = $sx.'|'.$sy;
    if (!in_array($loc, $houses))
      $houses[] = $loc;

    $loc = $rx.'|'.$ry;
    if (!in_array($loc, $houses))
      $houses[] = $loc;
  }

  return count($houses);
}

function day4($match){
  $key = file_get_contents('day4.txt');

  if (!$match)
    return false;

  $n = 0;
  do {
    $hash = md5($key.++$n);
  } while (substr($hash, 0, strlen($match)) !== $match);

  return $n;
}

function day5_1(){
  $file = file_get_contents('day5.txt');
  $datas = explode("\r\n", $file);

  $nice = 0;

  $str_vowels = 'aeiou';
  $str_naughty = array('ab', 'cd', 'pq', 'xy');

  foreach ($datas as $data){
    $flag_vowels = 0;
    $flag_double = $flag_naughty = false;

    $str = str_split($data);

    foreach ($str_naughty as $naughty){
      if (strpos($data, $naughty) !== false)
        $flag_naughty = true;
    }

    $c_prev = '';
    foreach ($str as $c){
      if (strpos($str_vowels, $c) !== false)
        $flag_vowels++;

      if ($c == $c_prev)
        $flag_double = true;

      $c_prev = $c;
    }

    if ($flag_vowels >= 3 && $flag_double && !$flag_naughty)
      $nice++;
  }

  return $nice;
}

function day5_2(){
  $file = file_get_contents('day5.txt');
  $datas = explode("\r\n", $file);

  $nice = 0;

  foreach ($datas as $data){
    $flag_pair = $flag_between = false;

    $str = str_split($data);
    foreach ($str as $key => $c){
      if (!empty($str[$key + 1])){
        if (substr_count($data, $c.$str[$key + 1]) > 1)
          $flag_pair = true;
      }

      if (!empty($str[$key + 2]) && $c == $str[$key + 2])
        $flag_between = true;
    }

    if ($flag_pair && $flag_between)
      $nice++;
  }

  return $nice;
}

function day6_1(){
  $file = file_get_contents('day6.txt');
  $datas = explode("\r\n", $file);

  $grid = array();
  for ($x = 0; $x < 1000; $x++){
    for ($y = 0; $y < 1000; $y++){
      $grid[$x.','.$y] = 0;
    }
  }

  foreach ($datas as $data){
    preg_match('/^(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $data, $matches);
    list($foo, $action, $x1, $y1, $x2, $y2) = $matches;

    for ($x = $x1; $x <= $x2; $x++){
      for ($y = $y1; $y <= $y2; $y++){
        switch ($action){
          case 'turn on' : $grid[$x.','.$y] = 1; break;
          case 'turn off' : $grid[$x.','.$y] = 0; break;
          case 'toggle' : $grid[$x.','.$y] = ($grid[$x.','.$y] == 1 ? 0 : 1); break;
        }
      }
    }
  }

  $counts = array_count_values($grid);
  return $counts[1];
}

function day6_2(){
  $file = file_get_contents('day6.txt');
  $datas = explode("\r\n", $file);

  $grid = array();
  for ($x = 0; $x < 1000; $x++){
    for ($y = 0; $y < 1000; $y++){
      $grid[$x.','.$y] = 0;
    }
  }

  foreach ($datas as $data){
    preg_match('/^(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $data, $matches);
    list($foo, $action, $x1, $y1, $x2, $y2) = $matches;

    for ($x = $x1; $x <= $x2; $x++){
      for ($y = $y1; $y <= $y2; $y++){
        switch ($action){
          case 'turn on' : $grid[$x.','.$y]++; break;
          case 'turn off' : if ($grid[$x.','.$y] >= 1) $grid[$x.','.$y]--; break;
          case 'toggle' : $grid[$x.','.$y] += 2; break;
        }
      }
    }
  }

  return array_sum($grid);
}

function day7_wire($wire, &$circuits){
  if (preg_match('/^\d+$/', $wire))
    return $wire;

  if (array_key_exists($wire, $circuits)){
    $action = key($circuits[$wire]);

    if (is_array($circuits[$wire][$action])){
      $arg1 = $circuits[$wire][$action][0];
      $arg2 = $circuits[$wire][$action][1];
    }else
      $arg1 = $circuits[$wire][$action];

    switch ($action){
      case '~' : $value = ~day7_wire($arg1, $circuits); break;
      case '=' : $value = day7_wire($arg1, $circuits); break;
      case '|' : $value = day7_wire($arg1, $circuits) | day7_wire($arg2, $circuits); break;
      case '&' : $value = day7_wire($arg1, $circuits) & day7_wire($arg2, $circuits); break;
      case '>>' : $value = day7_wire($arg1, $circuits) >> day7_wire($arg2, $circuits); break;
      case '<<' : $value = day7_wire($arg1, $circuits) << day7_wire($arg2, $circuits); break;
    }

    $value = (($value < 0 ? 65536 + $value : $value) % 65536);

    unset($circuits[$wire]);
    $circuits[$wire]['='] = $value;

    return $value;
  }
}

function day7_1(){
  $file = file_get_contents('day7.txt');
  $datas = explode("\r\n", $file);

  $circuits = array();
  foreach ($datas as $data){
    if (preg_match('/^NOT ([\w\d]+) -> (\w+)/', $data, $matches))
       $circuits[$matches[2]]['~'] = $matches[1];
    elseif (preg_match('/^(\d+) -> (\w+)/', $data, $matches))
      $circuits[$matches[2]]['='] = (int) $matches[1];
    elseif (preg_match('/^(\w+) -> (\w+)/', $data, $matches))
      $circuits[$matches[2]]['='] = $matches[1];
    elseif (preg_match('/^([\w\d]+) OR ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['|'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) AND ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['&'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) RSHIFT ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['>>'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) LSHIFT ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['<<'] = array($matches[1], $matches[2]);
  }

  return day7_wire('a', $circuits);
}

function day7_2(){
  $file = file_get_contents('day7.txt');
  $datas = explode("\r\n", $file);

  $circuits = array();
  foreach ($datas as $data){
    if (preg_match('/^NOT ([\w\d]+) -> (\w+)/', $data, $matches))
       $circuits[$matches[2]]['~'] = $matches[1];
    elseif (preg_match('/^(\d+) -> (\w+)/', $data, $matches))
      $circuits[$matches[2]]['='] = (int) $matches[1];
    elseif (preg_match('/^(\w+) -> (\w+)/', $data, $matches))
      $circuits[$matches[2]]['='] = $matches[1];
    elseif (preg_match('/^([\w\d]+) OR ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['|'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) AND ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['&'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) RSHIFT ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['>>'] = array($matches[1], $matches[2]);
    elseif (preg_match('/^([\w\d]+) LSHIFT ([\w\d]+) -> (\w+)/', $data, $matches))
      $circuits[$matches[3]]['<<'] = array($matches[1], $matches[2]);
  }

  $circuits_reset = $circuits;

  $circuits['b']['='] = day7_wire('a', $circuits_reset);

  return day7_wire('a', $circuits);
}

function day8_1(){
  $file = file_get_contents('day8.txt');
  $datas = explode("\r\n", $file);

  $str_code = $str_mem = 0;
  foreach ($datas as $data){
    $data = preg_replace('/\s+/', '', $data);

    $data_mem = substr($data, 1, -1);
    $data_mem = str_replace("\\\\", 'X', $data_mem);
    $data_mem = str_replace("\\\"", 'Y', $data_mem);
    $data_mem = preg_replace('/(\\\x[0-9a-f]{2})/', 'Z', $data_mem);

    $str_code += strlen($data);
    $str_mem += strlen($data_mem);
  }

  return $str_code - $str_mem;
}

function day8_2(){
  $file = file_get_contents('day8.txt');
  $datas = explode("\r\n", $file);

  $str_code = $str_mem = 0;
  foreach ($datas as $data){
    $data = preg_replace('/\s+/', '', $data);

    $str_code += strlen($data);
    $str_mem += strlen(addslashes($data)) + 2;
  }

  return $str_mem - $str_code;
}

function day9_parse(){
  global $routes;

  $file = file_get_contents('day9.txt');
  $datas = explode("\r\n", $file);

  $locations = $distances = $routes = $distance = array();
  foreach ($datas as $data){
    preg_match('/^(\w+) to (\w+) = (\d+)/', $data, $matches);

    $locations[] = $matches[1];
    $locations[] = $matches[2];

    $distances[$matches[1].'-'.$matches[2]] = $matches[3];
    $distances[$matches[2].'-'.$matches[1]] = $matches[3];
  }

  $locations = array_unique($locations);
  day9_routes($locations);

  if (count($routes)){
    foreach ($routes as $route){
      $distance[implode(' - ', $route)] = 0;

      foreach ($route as $key => $loc){
        if (array_key_exists($key + 1, $route)){
          $loc_next = $route[$key + 1];

          if (array_key_exists($loc.'-'.$loc_next, $distances))
            $distance[implode(' - ', $route)] += $distances[$loc.'-'.$loc_next];
        }
      }
    }
  }

  asort($distance);

  return $distance;
}

function day9_routes($locations, $route = array()){
  global $routes;

  if (empty($locations)){
    $routes[] = $route;
  }else{
    for ($i = count($locations) - 1; $i >= 0; $i--){
      $locations2 = $locations;
      $routes2 = $route;

      list($location) = array_splice($locations2, $i, 1);
      array_unshift($routes2, $location);

      day9_routes($locations2, $routes2);
    }
  }
}

function day9_1(){
  $distance = day9_parse();

  return array_shift($distance);
}

function day9_2(){
  $distance = day9_parse();

  return array_pop($distance);
}

function day10_process($input, $iterations){
  if (is_numeric($input) && $input > 0 && is_numeric($iterations) && $iterations > 0){
    for ($i = 1; $i <= $iterations; $i++){
      $inputs = str_split($input);

      $seqs = array(); $j = 0;
      foreach ($inputs as $k => $n){
        if ($k == 0 || $n <> $inputs[$k - 1])
          $seqs[$j][$n] = 1;
        else
          $seqs[$j][$n]++;

        if (array_key_exists($k + 1, $inputs) && $n <> $inputs[$k + 1])
          $j++;
      }

      if (count($seqs)){
        $input = '';
        foreach ($seqs as $seq){
          foreach ($seq as $say => $look)
            $input .= $look.$say;
        }
      }
    }

    return $input;
  }
}

function day10($iterations){
  $input = file_get_contents('day10.txt');
  $output = day10_process($input, $iterations);

  return strlen($output);
}

function day11_pass($input){
  global $letters;

  $req_len = 8;

  $letters = str_split('abcdefghijklmnopqrstuvwxyz');
  $pass = str_split($input);

  do {
    $pass = day11_increment($pass);
  } while (!day11_isvalid($pass));

  return implode($pass);
}

function day11_increment($pass, $i = 0){
  global $letters;

  if (!$i)
    $i = count($pass) - 1;

  $key = array_search($pass[$i], $letters);

  #var_dump($pass, $i, $pass[$i], $key);

  if (++$key == count($letters)){ // z
    $pass[$i] = $letters[0];
    $pass = day11_increment($pass, --$i);
  }else
    $pass[$i] = $letters[$key];

  return $pass;
}

function day11_isvalid($pass){
  global $letters;

  $illegal = str_split('iol');

  // condition 2
  foreach ($illegal as $char){
    if (in_array($char, $pass))
      return false;
  }

  // condition 3
  $pairs = 0;
  $str_pass = implode($pass);

  while (list($k, $c) = each($pass)){
    if (@substr_count($str_pass, $c.$c, $k, (strlen($str_pass) - $k > 3 ? 3 : strlen($str_pass) - $k))){
      next($pass);
      $pairs++;
    }
  }
  if ($pairs < 2)
    return false;

  // condition 1
  $flag_straight = false;
  reset($pass);
  foreach ($pass as $k => $c){
    $l1 = ord($c);

    if (array_key_exists($k + 1, $pass) && ord($pass[$k + 1]) == ord($c) + 1){
      if (array_key_exists($k + 2, $pass) && ord($pass[$k + 2]) == ord($c) + 2)
        return true;
    }
  }

  return false;
}

function day11_1(){
  $input = file_get_contents('day11.txt');

  return day11_pass($input);
}

function day11_2(){
  $input = day11_1();

  return day11_pass($input);
}

function day12_process($data, $sum = 0, $flag_red = false){
  if ($data){
    if (is_int($data))
      $sum += $data;
    elseif (is_object($data) && $flag_red){
      $flag_process = true;
      foreach ($data as $d){
        if (is_string($d) && $d == 'red')
          $flag_process = false;
      }

      if ($flag_process){
        foreach ($data as $d)
          $sum = day12_process($d, $sum, $flag_red);
      }
    }elseif (is_object($data)){
      foreach ($data as $d)
        $sum = day12_process($d, $sum, $flag_red);
    }elseif (is_array($data)){
      foreach ($data as $d)
        $sum = day12_process($d, $sum, $flag_red);
    }elseif (is_string($data)){
      preg_match('/(\d+)/', $data, $matches);

      foreach ($matches as $match)
        $sum = day12_process($match, $sum, $flag_red);
    }

  }

  return $sum;
}

function day12_1(){
  $input = file_get_contents('day12.txt');

  $data = json_decode($input);

  return day12_process($data);
}

function day12_2(){
  $input = file_get_contents('day12.txt');

  $data = json_decode($input);

  return day12_process($data, 0, true);
}

function day13_seating($people, $seat = array()){
  global $seatings;

  if (empty($people)){
    $seatings[] = $seat;
  }else{
    for ($i = count($people) - 1; $i >= 0; $i--){
      $people2 = $people;
      $seating2 = $seat;

      list($person) = array_splice($people2, $i, 1);
      array_unshift($seating2, $person);

      day13_seating($people2, $seating2);
    }
  }
}

function day13_parse($people, $happiness){
  global $seatings;

  $seatings = array();

  day13_seating($people);

  if (count($seatings)){
    foreach ($seatings as $seating){
      $arrangement[implode(' - ', $seating)] = 0;

      foreach ($seating as $key => $person1){
        $person2 = (array_key_exists($key + 1, $seating) ? $seating[$key + 1] : $seating[0]);

        if (array_key_exists($person1.'-'.$person2, $happiness))
          $arrangement[implode(' - ', $seating)] += $happiness[$person1.'-'.$person2];
        if (array_key_exists($person2.'-'.$person1, $happiness))
          $arrangement[implode(' - ', $seating)] += $happiness[$person2.'-'.$person1];
      }
    }
  }

  asort($arrangement);

  return array_pop($arrangement);
}

function day13_1(){
  $file = file_get_contents('day13.txt');
  $datas = explode("\r\n", $file);

  $people = $happiness = array();
  foreach ($datas as $data){
    preg_match('/^(\w+) would (gain|lose) (\d+) happiness units by sitting next to (\w+)/', $data, $matches);

    $people[] = $matches[1];
    $people[] = $matches[4];

    $happiness[$matches[1].'-'.$matches[4]] = ($matches[2] == "lose" ? -1 : 1) * $matches[3];
  }

  $people = array_unique($people);

  return day13_parse($people, $happiness);
}

function day13_2(){
  $file = file_get_contents('day13.txt');
  $datas = explode("\r\n", $file);

  $people = $happiness = array();
  foreach ($datas as $data){
    preg_match('/^(\w+) would (gain|lose) (\d+) happiness units by sitting next to (\w+)/', $data, $matches);

    $people[] = $matches[1];
    $people[] = $matches[4];

    $happiness[$matches[1].'-'.$matches[4]] = ($matches[2] == "lose" ? -1 : 1) * $matches[3];
  }

  $people = array_unique($people);

  foreach ($people as $person){
    $happiness['Me-'.$person] = 0;
    $happiness[$person.'-Me'] = 0;
  }

  $people[] = 'Me';

  return day13_parse($people, $happiness);
}

function day14_1(){
  $seconds = 2503;

  $file = file_get_contents('day14.txt');
  $datas = explode("\r\n", $file);

  $deers = array();
  foreach ($datas as $data){
    preg_match('/^(\w+) can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds./', $data, $matches);

    $deers[$matches[1]] = array(
      "speed" => $matches[2],
      "time" => $matches[3],
      "rest" => $matches[4],
      "flying" => true
    );
  }

  $distances = array();
  for ($i = 1; $i <= $seconds; $i++){
    foreach ($deers as $deer => $data){
      if ($i % ($data['rest'] + $data['time']) >= $data['time'])
        $deers[$deer]['flying'] = false;
      else
        $deers[$deer]['flying'] = true;

      if ($data['flying'])
        $distances[$deer] += $data['speed'];
    }
  }

  asort($distances);

  return array_pop($distances);
}

function day14_2(){
  $seconds = 2503;

  $file = file_get_contents('day14.txt');
  $datas = explode("\r\n", $file);

  $deers = array();
  foreach ($datas as $data){
    preg_match('/^(\w+) can fly (\d+) km\/s for (\d+) seconds, but then must rest for (\d+) seconds./', $data, $matches);

    $deers[$matches[1]] = array(
      "speed" => $matches[2],
      "time" => $matches[3],
      "rest" => $matches[4],
      "flying" => true
    );
  }

  $distances = $points = array();
  for ($i = 1; $i <= $seconds; $i++){
    foreach ($deers as $deer => $data){
      if ($i % ($data['rest'] + $data['time']) >= $data['time'])
        $deers[$deer]['flying'] = false;
      else
        $deers[$deer]['flying'] = true;

      if ($data['flying'])
        $distances[$deer] += $data['speed'];
    }

    $distances2 = $distances;
    rsort($distances2);
    $lead = $distances2[0];

    foreach ($distances as $deer => $distance){
      if ($distance == $lead)
        $points[$deer]++;
    }
  }

  asort($points);

  return array_pop($points);
}

function day15_data(){
  $total = 100;
  $match = 100;

  $file = file_get_contents('day15.txt');
  $datas = explode("\r\n", $file);

  $ingredients = $calories = $recipes = array();
  foreach ($datas as $data){
    preg_match('/^(\w+): capacity (\-?\d+), durability (\-?\d+), flavor (\-?\d+), texture (\-?\d+), calories (\-?\d+)/', $data, $matches);

    $ingredients[$matches[1]] = array(
      "capacity" => $matches[2],
      "durability" => $matches[3],
      "flavor" => $matches[4],
      "texture" => $matches[5],
    );

    $calories[$matches[1]] = $matches[6];
  }

  for ($i = 0; $i <= $total; $i++){
    for ($j = 0; $j <= $total; $j++){
      for ($k = 0; $k <= $total; $k++){
        $l = $match - $i - $j - $k;

        $recipes[] = array_combine(array_keys($ingredients), array($i, $j, $k, $l));
      }
    }
  }

  return array($ingredients, $calories, $recipes);
}

function day15_1(){
  list($ingredients, $calories, $recipes) = day15_data();

  $max_score = 0;
  foreach ($recipes as $key => $recipe){
    $score = array();

    foreach ($ingredients as $ingredient => $properties){
      foreach ($properties as $property => $property_score)
        $score[$property] += ($recipe[$ingredient] * $property_score);
    }

    foreach ($properties as $property => $property_score){
      if ($score[$property] < 0)
        continue(2);
    }

    $max_score = max($max_score, array_product($score));
  }

  return $max_score;
}

function day15_2(){
  $total_calories = 500;

  list($ingredients, $calories, $recipes) = day15_data();

  $max_score = 0;
  foreach ($recipes as $key => $recipe){
    $score = array();
    $score_calories = 0;

    foreach ($ingredients as $ingredient => $properties)
      $score_calories += $recipe[$ingredient] * $calories[$ingredient];

    if ($score_calories == $total_calories){
      foreach ($ingredients as $ingredient => $properties){
        foreach ($properties as $property => $property_score)
          $score[$property] += ($recipe[$ingredient] * $property_score);
      }

      foreach ($properties as $property => $property_score){
        if ($score[$property] < 0)
          continue(2);
      }

      $max_score = max($max_score, array_product($score));
    }
  }

  return $max_score;
}

function day16_1(){
  $file = file_get_contents('day16.txt');
  $datas = explode("\r\n", $file);

  $mfcsam = array(
    'children' => 3,
    'cats' => 7,
    'samoyeds' => 2,
    'pomeranians' => 3,
    'akitas' => 0,
    'vizslas' => 0,
    'goldfish' => 5,
    'trees' => 3,
    'cars' => 2,
    'perfumes' => 1,
  );

  $sues = array();
  foreach ($datas as $data){
    preg_match('/^Sue (\d+): (.*)$/', $data, $matches);

    $values = preg_split('/, /', $matches[2]);
    foreach ($values as $value){
      list($thing, $n) = preg_split('/: /', $value);

      $sues[$matches[1]][$thing] = $n;
    }
  }

  foreach ($sues as $sue => $things){
    $flag_sue = true;
    foreach ($things as $thing => $n){
      if (array_key_exists($thing, $mfcsam) && $mfcsam[$thing] <> $n)
        $flag_sue = false;
    }

    if ($flag_sue)
      return $sue;
  }
}

function day16_2(){
  $file = file_get_contents('day16.txt');
  $datas = explode("\r\n", $file);

  $mfcsam = array(
    'children' => 3,
    'cats' => '>7',
    'samoyeds' => 2,
    'pomeranians' => '<3',
    'akitas' => 0,
    'vizslas' => 0,
    'goldfish' => '<5',
    'trees' => '>3',
    'cars' => 2,
    'perfumes' => 1,
  );

  $sues = array();
  foreach ($datas as $data){
    preg_match('/^Sue (\d+): (.*)$/', $data, $matches);

    $values = preg_split('/, /', $matches[2]);
    foreach ($values as $value){
      list($thing, $n) = preg_split('/: /', $value);

      $sues[$matches[1]][$thing] = $n;
    }
  }

  foreach ($sues as $sue => $things){
    $flag_sue = true;
    foreach ($things as $thing => $n){
      $mfcsam_n = $mfcsam[$thing];

      if (is_numeric($mfcsam_n) && $mfcsam_n <> $n)
        $flag_sue = false;
      if ($mfcsam_n{0} == '>' && substr($mfcsam_n, 1) > $n)
        $flag_sue = false;
      if ($mfcsam_n{0} == '<' && substr($mfcsam_n, 1) < $n)
        $flag_sue = false;
    }

    if ($flag_sue)
      return $sue;
  }
}

function day17_permute($items, $perms = array()){
  global $eggnog, $max, $combinations, $possible;

  if (empty($items)){
    $t = 0;

    $maxperms = array_slice($perms, 0, $max);
    sort($maxperms);

    $thisperm = join(' ', $maxperms);
    if (!in_array($thisperm, $possible)){
      $possible[] = $thisperm;
      echo $thisperm." (".array_sum($maxperms).")"."\n";
    }else
      return;
  }

  for ($i = count($items) - 1; $i >= 0; --$i){
    $items_new = $items;
    $perms_new = $perms;

    list($foo) = array_splice($items_new, $i, 1);
    array_unshift($perms_new, $foo);

    day17_permute($items_new, $perms_new);
  }
}

function day17_1(){
  global $eggnog, $max, $combinations, $possible;

  $eggnog = 25;
  $possible = array();

  $file = file_get_contents('day17test.txt');
  $datas = explode("\r\n", $file);

  foreach ($datas as $k => $v)
    $datas[$k] = (int) $v;

  sort($datas, SORT_NUMERIC);

  $t = $max = 0;
  do {
    $t += next($datas);
    $max++;
  } while ($t <= $eggnog);

  day17_permute($datas);

  var_dump($possible);
  exit;

  do {
    $t += next($perms);
  } while ($t <= $eggnog);

  if ($t == $eggnog){
    reset($perms);
    var_dump($t, $perms);
  }
}

function day18_neighbors($location = '0,0', $grid = array()){
  list($x, $y) = explode(',', $location);

  $neigbors = 0;
  if (!empty($grid[$x][$y])){
    $state = $grid[$x][$y];

    if (!empty($grid[$x - 1][$y - 1]) && $grid[$x - 1][$y - 1] == '#') $neigbors++;
    if (!empty($grid[$x - 1][$y]) && $grid[$x - 1][$y] == '#') $neigbors++;
    if (!empty($grid[$x - 1][$y + 1]) && $grid[$x - 1][$y + 1] == '#') $neigbors++;

    if (!empty($grid[$x][$y - 1]) && $grid[$x][$y - 1] == '#') $neigbors++;
    if (!empty($grid[$x][$y + 1]) && $grid[$x][$y + 1] == '#') $neigbors++;

    if (!empty($grid[$x + 1][$y - 1]) && $grid[$x + 1][$y - 1] == '#') $neigbors++;
    if (!empty($grid[$x + 1][$y]) && $grid[$x + 1][$y] == '#') $neigbors++;
    if (!empty($grid[$x + 1][$y + 1]) && $grid[$x + 1][$y + 1] == '#') $neigbors++;

    if ($state == '#' && ($neigbors <> 2 && $neigbors <> 3))
      $state = '.';

    if ($state == '.' && $neigbors == 3)
      $state = '#';

    return $state;
  }
}

function day18_1(){
  $steps = 100;

  $file = file_get_contents('day18.txt');
  $datas = explode("\r\n", $file);

  $grid = $grid_new = array();
  foreach ($datas as $row => $col)
    $grid[$row] = str_split($col);

  for ($i = 0; $i < $steps; $i++){
    foreach ($grid as $x => $cols){
      foreach ($cols as $y => $state){
        $grid_new[$x][$y] = day18_neighbors($x.','.$y, $grid);
      }
    }

    $grid = $grid_new;
  }

  $count_on = 0;
  foreach ($grid as $x => $cols){
    $count_values = array_count_values($cols);

    $count_on += $count_values['#'];
  }

  return $count_on;
}

function day18_2(){
  $steps = 100;

  $file = file_get_contents('day18.txt');
  $datas = explode("\r\n", $file);

  $grid = array();
  foreach ($datas as $row => $col)
    $grid[$row] = str_split($col);

  $grid[0][0] = '#';
  $grid[count($grid) - 1][0] = '#';
  $grid[0][count($grid[0]) - 1] = '#';
  $grid[count($grid) - 1][count($grid[0]) - 1] = '#';

  $grid_new = $grid;
  for ($i = 0; $i < $steps; $i++){
    foreach ($grid as $x => $cols){
      foreach ($cols as $y => $state){
        if (($x == 0 && $y == 0) || ($x == count($grid) - 1 && $y == 0) || ($x == 0 && $y == count($grid[0]) - 1) || ($x == count($grid) - 1 && $y == count($grid[0]) - 1))
          continue;

        $grid_new[$x][$y] = day18_neighbors($x.','.$y, $grid);
      }
    }

    $grid = $grid_new;
  }

  $count_on = 0;
  foreach ($grid as $x => $cols){
    $count_values = array_count_values($cols);

    $count_on += $count_values['#'];
  }

  return $count_on;
}

function day19_replace($matches){
  var_dump($matches);
  exit;
}

function day19_1(){
  $file = file_get_contents('day19.txt');
  $datas = explode("\r\n", $file);

  $replacements = array();
  $medicine = '';
  foreach ($datas as $data){
    if (strpos($data, ' => ') !== false)
      $replacements[] = explode(' => ', $data);
    else
      $medicine .= trim($data);
  }

var_dump(count($replacements));

  $molecules = array();
  foreach ($replacements as $rpl){
    list($from, $to) = $rpl;

    preg_match_all('/'.$from.'+/', $medicine, $matches, PREG_OFFSET_CAPTURE);
    if (count($matches[0])){
      foreach ($matches[0] as $match){
        $molecules[] = substr($medicine, 0, ($match[1] - 1)).$to.substr($medicine, ($match[1] + strlen($from)));
      }
    }

    var_dump($molecules); exit;
  }

  return count(array_unique($molecules));
}

function day20_1(){
  $input = 36000000;
  $house = 850000;

  $input /= 10;

  do {
    $presents = 0;
    $elf = 0;

    do {
      $c = $house / ++$elf;

      $presents += ((int) $c === $c ? $elf : 0);
    } while ($elf <= $house);

    if ($house % 100 == 0){
      echo '#'.$house.' ('.$presents.') ['.round(bench(TRUE, $bench, bench()), 2).'s]'."\n";
      $bench = bench();
    }

    if ($presents >= $input)
      return $house;

  } while ($house++);
}

function day21_fight($p, $b){
  $turn = 0;

  do {
    switch ($turn++ % 2){
      case 0 : // player
        $hit = $p['damage'] - $b['armor'];
        $b['hit'] -= ($hit ? $hit : 1);
        break;
      case 1 : // boss
        $hit = $b['damage'] - $p['armor'];
        $p['hit'] -= ($hit ? $hit : 1);
        break;
    }
  } while ($p['hit'] > 0 && $b['hit'] > 0);

  return ($p['hit'] > 0 ? true : false);
}

function day21($part = 1){
  $boss = array('hit' => 109, 'damage' => 8, 'armor' => 2);
  $player = array('hit' => 100, 'damage' => 0, 'armor' => 0);

  $weapons = array(
    'dagger' => array('cost' => 8, 'damage' => 4, 'armor' => 0),
    'shortsword' => array('cost' => 10, 'damage' => 5, 'armor' => 0),
    'warhammer' => array('cost' => 25, 'damage' => 6, 'armor' => 0),
    'longsword' => array('cost' => 40, 'damage' => 7, 'armor' => 0),
    'greataxe' => array('cost' => 74, 'damage' => 8, 'armor' => 0),
  );

  $armors = array(
    'none' => array('cost' => 0, 'damage' => 0, 'armor' => 0),
    'leather' => array('cost' => 13, 'damage' => 0, 'armor' => 1),
    'chainmail' => array('cost' => 31, 'damage' => 0, 'armor' => 2),
    'splintmail' => array('cost' => 53, 'damage' => 0, 'armor' => 3),
    'bandedmail' => array('cost' => 75, 'damage' => 0, 'armor' => 4),
    'platemail' => array('cost' => 102, 'damage' => 0, 'armor' => 5),
  );

  $rings = array(
    'none' => array('cost' => 0, 'damage' => 0, 'armor' => 0),
    'damage +1' => array('cost' => 25, 'damage' => 1, 'armor' => 0),
    'damage +2' => array('cost' => 50, 'damage' => 2, 'armor' => 0),
    'damage +3' => array('cost' => 100, 'damage' => 3, 'armor' => 0),
    'defense +1' => array('cost' => 20, 'damage' => 0, 'armor' => 1),
    'defense +2' => array('cost' => 40, 'damage' => 0, 'armor' => 2),
    'defense +3' => array('cost' => 80, 'damage' => 0, 'armor' => 3),
  );

  foreach ($weapons as $weapon => $w){
    foreach ($armors as $armor => $a){
      foreach ($rings as $ring1 => $r1){
        foreach ($rings as $ring2 => $r2){
          if ($ring1 == $ring2 && $ring1 <> 'none')
            continue;

          $p = $player;
          $cost = $w['cost'] + $a['cost'] + $r1['cost'] + $r2['cost'];

          $p['damage'] += $w['damage'] + $a['damage'] + $r1['damage'] + $r2['damage'];
          $p['armor'] += $w['armor'] + $a['armor'] + $r1['armor'] + $r2['armor'];

          if ($part == 1 && day21_fight($p, $boss) && (!$least || $cost < $least))
            $least = $cost;
          elseif ($part == 2 && !day21_fight($p, $boss) && $cost > $most)
            $most = $cost;
        }
      }
    }
  }

  return ($part == 1 ? $least : $most);
}

function day22($part = 1){
  $boss = array('hit' => 71, 'damage' => 10, 'armor' => 0);
  $player = array('hit' => 50, 'damage' => 0, 'armor' => 0);
  $mana = 500;
  $turns = 20;

  $spells = array(
    'magic missile' => array('cost' => 53, 'damage' => 4, 'heal' => 0, 'turn' => array('n' => 0, 'damage' => 0, 'armor' => 0, 'mana' => 0)),
    'drain' => array('cost' => 73, 'damage' => 2, 'heal' => 2, 'turn' => array('n' => 0, 'damage' => 0, 'armor' => 0, 'mana' => 0)),
    'shield' => array('cost' => 113, 'damage' => 0, 'heal' => 0, 'turn' => array('n' => 6, 'damage' => 0, 'armor' => 7, 'mana' => 0)),
    'poison' => array('cost' => 173, 'damage' => 0, 'heal' => 0, 'turn' => array('n' => 6, 'damage' => 3, 'armor' => 0, 'mana' => 0)),
    'recharge' => array('cost' => 229, 'damage' => 0, 'heal' => 0, 'turn' => array('n' => 5, 'damage' => 0, 'armor' => 0, 'mana' => 101)),
  );

  for ($i = 0; $i <= $turns; $i++){
    if ($i % 2 == 0){ // player
      $j = 0;
      foreach ($spells as $spell => $s){
        $turns[$i][$j] = '';

        $j++;
      }
    }else{ // boss
      $hit = $boss['damage'] - $player['armor'];
      $player['hit'] -= ($hit ? $hit : 1);
    }

    // cast,
  }
}

function day23_instruction($key, &$a, &$b){
  global $instructions;

  if (!array_key_exists($key, $instructions))
    return array($a, $b);

  list($instruction, $register) = preg_split('/ /', $instructions[$key], 2);

  switch ($instruction){
    case 'hlf' : // half
      ${$register} = floor(${$register} / 2);
      day23_instruction($key + 1, $a, $b);
      break;

    case 'tpl' : // triple
      ${$register} *= 3;
      day23_instruction($key + 1, $a, $b);
      break;

    case 'inc' : // increment one
      ${$register} += 1;
      day23_instruction($key + 1, $a, $b);
      break;

    case 'jmp' : // jump to offset
      day23_instruction($key + $register, $a, $b);
      break;

    case 'jie' : // jump if even
      list($register, $offset) = preg_split('/, /', $register, 2);
      if (${$register} % 2 == 0)
        day23_instruction($key + $offset, $a, $b);
      else
        day23_instruction($key + 1, $a, $b);
      break;

    case 'jio' : // jump if one
      list($register, $offset) = preg_split('/, /', $register, 2);
      if (${$register} == 1)
        day23_instruction($key + $offset, $a, $b);
      else
        day23_instruction($key + 1, $a, $b);
      break;
  }
}

function day23($a = 0, $b = 0){
  global $instructions;

  $file = file_get_contents('day23.txt');
  $datas = explode("\r\n", $file);

  $instructions = array();
  foreach ($datas as $data)
    $instructions[] = $data;

  day23_instruction(0, $a, $b);

  return $b;
}

function day24(){
  $file = file_get_contents('day24.txt');
  $datas = explode("\r\n", $file);

  $weight_total = array_sum($datas);
  $weight_group = $weight_total / 3;

  var_dump(1536 / 3);

  return;

  foreach ($datas as $data)
    $instructions[] = $data;

  day23_instruction(0, $a, $b);

  return $b;
}

function day25($row, $col){
  $row_max = $row_pointer = $col_pointer = 1;

  $code = 20151125;
  $mul = 252533;
  $mod = 33554393;

  do {
    if ($row_pointer == $row && $col_pointer == $col)
      return $code;

    $col_pointer++;
    if (--$row_pointer < 1){
      $row_pointer = $row_max + 1;
      $col_pointer = 1;
    }

    $row_max = ($row_pointer > $row_max ? $row_pointer : $row_max);
    $code = bcmod(bcmul($code, $mul), $mod);
  } while (true);
}