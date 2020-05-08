<?php

namespace App\Scrapers;

use Sunra\PhpSimple\HtmlDomParser;


use App\Feeders\Atom as Atom;


class FeedScraper
{
  private
    $url,
    $atom,
    $newAtom,
    $atoms,
    $myfile,
    $html,
    $title,
    $body,
    $body_array,
    $link,
    $description;

  public function __construct($url, Atom $atom, $myFile)
  {



    $this->url = $url;
    $this->atom = $atom;
    $this->atoms = array();
    $this->myfile = $myFile;
    $this->html = HtmlDomParser::file_get_html($this->url, false, null, 0);
    $this->title = $this->html->find('title', 0)->plaintext;
    $this->body = $this->html->find('body', 0);
    $this->body_array = $this->body->find('a');
  }




  public function scraper()
  {



    foreach ($this->body_array as $element) {



      $this->newAtom = $this->atom->getInstance();


      $this->link = $element->href;

      $this->description = $element->plaintext;

      if (filter_var($this->link, FILTER_VALIDATE_URL) === FALSE) {

        continue;
      } else {


        $this->newAtom->setTitle($this->title);
        $this->newAtom->setLink($this->link);
        $this->newAtom->setDescription($this->description);


        $this->atoms[] = $this->newAtom;
      }
    }



    return $this->atoms;
  }
}
