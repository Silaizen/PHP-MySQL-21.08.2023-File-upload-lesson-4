<?php 
class OldInputs{
    public static function set($inputs) : void {
        $_SESSION['old_inputs'] = $inputs;
    }

    public static function get($key) : string {
        return $_SESSION['old_inputs'][$key] ?? '';
    }

    public static function remove() :void {
       
        if(isset($_SESSION['old_inputs'])){
            unset($_SESSION['old_inputs']);
        }
    }
}
?>