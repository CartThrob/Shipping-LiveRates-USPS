<?php

ini_set('memory_limit', '2048M');

$finder = PhpCsFixer\Finder::create()
    ->notPath('views')
    ->notPath('vendor')
    ->in(__DIR__)
    ->name('*.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        '@Symfony' => true,
        'binary_operator_spaces' => ['align_double_arrow' => true],
        'cast_spaces' => ['space' => 'none'],
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => false,
        'linebreak_after_opening_tag' => true,
        'ordered_imports' => true,
        'phpdoc_separation' => false,
        'phpdoc_summary' => false,
        'phpdoc_order' => true,
        'ordered_imports' => true,
        'yoda_style' => false
    ])
    ->setFinder($finder);
