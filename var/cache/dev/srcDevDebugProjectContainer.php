<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPggn1Ba\srcDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPggn1Ba/srcDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerPggn1Ba.legacy');

    return;
}

if (!\class_exists(srcDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerPggn1Ba\srcDevDebugProjectContainer::class, srcDevDebugProjectContainer::class, false);
}

return new \ContainerPggn1Ba\srcDevDebugProjectContainer(array(
    'container.build_hash' => 'Pggn1Ba',
    'container.build_id' => 'eb08f781',
    'container.build_time' => 1542039984,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerPggn1Ba');
