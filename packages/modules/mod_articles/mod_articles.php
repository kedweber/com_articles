<?php

echo KService::get('mod://site/articles.html')
    ->module($module)
    ->attribs($attribs)
    ->display();