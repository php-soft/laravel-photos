<?php

$this->set('version', '1.0');
$this->set('links', '{}');
$this->set('meta', '{}');
$this->set('entities', $this->each([ $photo ], function ($section, $photo) {
    $section->set($section->partial('partials/photo', [ 'photo' => $photo ]));
}));
$this->set('linked', '{}');
