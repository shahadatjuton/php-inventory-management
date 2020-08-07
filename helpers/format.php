<?php
class Format{
    public function dateFormat($date){
       return date('F j, Y, g:i a', strtotime($date));
    }

    public function textShorten($text, $limit =300){
        $text = $text. " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text. "...";
        return $text;
    }
}
?>


