<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\SymfonySetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

return RectorConfig::configure()
                   ->withPaths([
	                   __DIR__ . '/src',
	                   __DIR__ . '/tests',
                   ])
                   ->withPhpSets(php80: true)
                   ->withPreparedSets(
	                   deadCode          : true, codeQuality: true, codingStyle: true, doctrineCodeQuality: true,
	                   symfonyCodeQuality: true, symfonyConfigs: true, twig: true
                   )
                   ->withImportNames(removeUnusedImports: true)
                   ->withTypeCoverageLevel(0)
                   ->withSets([
	                   SymfonySetList::SYMFONY_54,
	                   SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
                   ])
                   ->withRules([AddVoidReturnTypeWhereNoReturnRector::class])
;