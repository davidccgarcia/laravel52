<?php

Route::get('v1/upper/{word}', function ($word) {
    return [
        'original' => $word, 
        'upper' => strtoupper($word)
    ];
});
