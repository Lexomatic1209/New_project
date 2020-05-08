<?php

namespace App\Feeders;
  


class AtomFile {


private 
$atoms,
$myfile;

public function __construct($atoms,$myfile){

$this->atoms = $atoms;
$this->myfile = $myfile;

}
  
  
 

 function escape($string) {
  return str_replace(array('&','"',"'",'<','>'),
      array('&amp;','&quot;','&apos;','&lt;','&gt;'),
      $string);
}

   
function writer(){
  
  fwrite($this->myfile,'<?xml version="1.0" encoding="utf-8"?>');

  foreach($this->atoms as $atom){


  $atom_feed = 

  '<feed xmlns="http://www.w3.org/2005/Atom">

  <title>'.$this->escape($atom->getDescription()).'</title>
  <link href="'.$this->escape($atom->getLink()).'"/>
  <updated>'.date("Y-m-d\TH:i:sP").'</updated>
  <author>
    <name>John Doe</name>
  </author>
  <id>'.$this->escape($atom->getLink()).'</id>

  <entry>
    <title>'.$this->escape($atom->getDescription()).'</title>
    <link href="'.$this->escape($atom->getLink()).'"/>
    <id>'.$this->escape($atom->getLink()).'</id>
    <updated>'.date("Y-m-d\TH:i:sP").'</updated>
    <summary>'.$this->escape($atom->getDescription()).'.</summary>
  </entry>

</feed>
  ';


  fwrite($this->myfile,$atom_feed."\n");

  }


}




}
