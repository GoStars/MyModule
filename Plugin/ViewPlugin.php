<?php
    namespace Magefan\MyModule\Plugin;

    use Magefan\MyModule\Controller\Page\View;

    class ViewPlugin {
        public function beforeSetTitle(View $subject, $title) {
            $title = $title . " to ";

            return [$title];
        }

        public function afterGetTitle(View $subject, $result) {
            return '<h1>'. $result . 'Magefan.com' .'</h1>';
        }

        public function beforeDispatch(View $subject, $request) {
            $action = $request->getFullActionName();
            $action .= '<br>';
            
            echo $action;
        }
    }
