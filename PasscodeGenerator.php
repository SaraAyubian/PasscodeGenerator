/* PasscodeGenerator.php (Version 1.0) Created by Sara Ayubian */


<?php
$prefix       = "ENC";
$file         = $argv[1];
$out_file     = $argv[2] ?? "{$file}.Output.csv";
$fin          = fopen($file, "r+");
$fout         = fopen($out_file, "w+");

while (($data = fgetcsv($fin)) !== FALSE)
{
    $counter ++;
  for ($i=count($data)-1; $i>1;--$i)
    if ($data[$i]) break;
  $serial = $data[$i];
    if ($counter == 1)
        $out = "Passcode";
    else
        $out        = serial_to_md5(trim($serial), $prefix);
    
  echo $serial, " -> ", $out, PHP_EOL;
   $data[] = "'". $out . "'";
  fputcsv($fout, $data);
}


//md5 algorithm
function serial_to_md5(string $str, string $prefix = "")
{
  return $md5 = str_replace(['a','b','c','d','e','f'], [0,1,2,3,4,5], substr(md5($prefix . $str), 0, 4));
  // return str_pad($md5, 4, "0", STR_PAD_LEFT);
}

//run project by typing "php PasscodeGenerator.php MD5.Input.csv MD5.Ouput.csv"
