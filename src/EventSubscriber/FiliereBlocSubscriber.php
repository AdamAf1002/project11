<?php

namespace App\EventSubscriber;
use App\Entity\Bloc;
use App\Entity\Filiere;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class FiliereBlocSubscriber implements EventSubscriberInterface
{
    public function onPrePersist($event): void
    {
        // ...
        
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'prePersist' => 'onPrePersist',
        ];
    }
}
