<?php

class Paginate{
    public $current_page;
    public $items_per_page;
    public $total_item;
    
    public function __construct($page=1, $page_items=4, $items=0){
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$page_items;
        $this->total_item = (int)$items;
    }
    
    public function nexts(){
        return $this->current_page + 1;
    }
    public function previous(){
        return $this->current_page - 1;
    }
    public function total_page(){
        return ceil($this->total_item/$this->items_per_page);
    }
    
    public function has_prev(){
        return $this->previous() >= 1 ? true : false;
    }
    public function has_next(){
        return $this->nexts() <= $this->total_page() ? true : false;
    }
    
    public function offset(){
        return ($this->current_page - 1) * $this->items_per_page;
    }
    
}





?>