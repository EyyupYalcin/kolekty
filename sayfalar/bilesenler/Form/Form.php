<?php 
include bilesen('Form/AjaxPostButton');
include bilesen('Form/tinymce_editor');
include bilesen('Form/datetime');
include bilesen('Form/date');
include bilesen('Form/time');
include bilesen('Form/text');
include bilesen('Form/single_select_db');
include bilesen('Form/single_select_api');
include bilesen('Form/file');
include bilesen('Form/money');
include bilesen('Form/hidden_text');

Class Form {
    public static function render($function, $parametreler){
        global $gelistirici_modu;
        $cikti = ob_get_contents();
        try {
            $parametreler['deger'] = isset($parametreler['deger']) ? $parametreler['deger'] : "";
            eval($function . "(" . var_export($parametreler, true) . ");");
            global $Form_Eleman_ID_Listesi;
            if(isset($Form_Eleman_ID_Listesi)){
                $Form_Eleman_ID_Listesi[str_replace('form_','',$function)][] = $parametreler['id'];
            }
        } catch (\Throwable $th) {
            ob_clean();
            echo $cikti;
            if($gelistirici_modu){var_dump($th);}
        }
    }
}

