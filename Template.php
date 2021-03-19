<?php

class Template
{
    public function render($templateName, $context)
    {
        $html = file_get_contents('templates/' . $templateName . '.html');

        $this->getLoopHtml($html);

        foreach ($context as $variableName => $value) {
            if (is_string($value) === true) {
                $html = str_replace('#' . $variableName . '#', $value, $html);
            }
        }

        return $html;
    }

    private function getLoopHtml($html)
    {
        $results = [];

        preg_match_all('/#%(?P<LoopName>.*)%#(?P<LoopContent>.*)#%\//sU', $html, $results);

        $loopName = $results[1];
        $loopHtml = $results[2];

        die(print_R($results));

        return [
            'loopName' => $loopName,
            'loopHtml' => $loopHtml
        ];
    }
}