<?php

if ( ! function_exists("esc"))
{
    function esc($text)
    {
      $text = htmlspecialchars($text,ENT_QUOTES,'UTF-8');
      return $text;
    }
}
