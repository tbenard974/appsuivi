<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNtytqt8\srcDevDebugProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNtytqt8/srcDevDebugProjectContainer.php') {
    touch(__DIR__.'/ContainerNtytqt8.legacy');

    return;
}

if (!\class_exists(srcDevDebugProjectContainer::class, false)) {
    \class_alias(\ContainerNtytqt8\srcDevDebugProjectContainer::class, srcDevDebugProjectContainer::class, false);
}

return new \ContainerNtytqt8\srcDevDebugProjectContainer(array(
    'container.build_hash' => 'Ntytqt8',
    'container.build_id' => '3a501f06',
    'container.build_time' => 1542039736,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerNtytqt8');
