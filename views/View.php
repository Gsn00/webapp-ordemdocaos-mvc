<?php
namespace Views;
class View {
    private $fileName;

    function __construct($fileName) {
        $this->fileName = $fileName;
    }

    function render() {
        $GLOBALS['CURRENT_PAGE'] = $this->fileName;    
    }
}
?>