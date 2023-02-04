<?php
namespace Views;
class View {
    private $fileName;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }

    function render($vars = []) {
        ob_start();
        extract($vars);
        include('pages/'.$this->fileName.'.php');
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}
?>