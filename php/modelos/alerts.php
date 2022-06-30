<?php

class alerts{
    function simple($color,$info){
        $html = '<div class="container-fluid"><div class="alert alert-'.$color.' mt-3" role="alert">
        '.$info.'
      </div></div>';
      return $html;
    }
    function means($color,$subrayate,$info){
        $html = '<div class="alert alert-'.$color.' mt-3" role="alert">
        <strong>'.$subrayate.'</strong> '.$info.'
      </div>';
      return $html;
    }

    function compound($color,$tittle,$body,$footer){
        $html = '<div class="alert alert-'.$color.' mt-3" role="alert">
        <h4 class="alert-heading">'.$tittle.'</h4>
        <p>'.$body.'</p>
        <hr>
        <p class="mb-0">'.$footer.'</p>
      </div>';
      return $html;
    }
}