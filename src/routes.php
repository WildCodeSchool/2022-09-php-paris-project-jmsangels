<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index'],
    'subject/list' => ['SubjectController', 'list', ['theme_id']],
    'notion/list' => ['NotionController', 'list', ['subject_id']],
    'notion/show' => ['NotionController', 'show', ['id']],
    'notion/add' => ['NotionController', 'add', ['subject_id']],
    'notion/edit' => ['NotionController', 'edit', ['id']],
    'notion/delete' => ['NotionController', 'delete', ['id']]
];
