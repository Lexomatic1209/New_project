<?php

namespace App\Feeders;





class Atom  {



private 
$title,
$link,
$description;



public function getInstance(){

 return new Atom();
}


public function setTitle($title){

     $this->title = $title;
    
    }

    public function setLink($link){

        $this->link = $link;
       
       }

       public function setDescription($description){

        $this->description = $description;
       
       }

public function getTitle(){

return $this->title;

}

public function getLink(){

    return $this->link;
    
    }


    public function getDescription(){

        return $this->description;
        
        }




}





?>