<?php
    namespace Magefan\MyModule\Plugin;

    use Magefan\MyModule\Controller\Page\View;

    class MyPlugin {
        public function beforeSetTitle(View $subject, $title) {
            $title = $title . " to ";
            echo __METHOD__ . "</br>";

            return [$title];
        }

        public function afterGetTitle(View $subject, $result) {
            echo __METHOD__ . "</br>";

            return '<h1>'. $result . 'Magefan.com' .'</h1>';
        }

        public function aroundGetTitle(View $subject, callable $proceed) {
            echo __METHOD__ . " - Before proceed() </br>";
            $result = $proceed();
            echo __METHOD__ . " - After proceed() </br>";

            return $result;
        }
    }
