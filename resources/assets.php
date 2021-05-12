<?php
  
  class CSS
  {
    const FORM_INPUT_CLASS = 'w-full py-1 px-3 my-1 border focus:outline-none';
    const FORM_INPUT_BTN = 'bg-green-600 text-white py-1 px-3 my-1 border w-full cursor-pointer';
    const LOGIN_SWITCHED_BTN = 'w-1/2 text-center px-3 py-2 text-2xl';
  }
  
  class ICON
  {
    
    public static function _ICON($_icon, $_class = ''): string
    {
      return "<span class='material-icons $_class'>$_icon</span>";
    }
    
    const VIEW = '<span class="material-icons">visibility</span>';
    const DELETE = '<span class="material-icons">delete</span>';
    
  }
