<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\App;

trait TranslateTable
{
  protected $defaultLocale = "ru";

  public function __($fieldName)
  {

    if (App::getLocale() != null) {
      $locale = App::getLocale();
    } else {
      $locale = $this->defaultLocale;
    }

    $newField = $fieldName;
    if ($locale != $this->defaultLocale) {
      $newField .= "_" . $locale;
    }
  
    $attributes = array_keys($this->attributes);
    if(in_array($newField, $attributes) && $this->$newField != null){
      return $this->$newField;
    }else{
      return $this->$fieldName;
    }
    
  }
}
