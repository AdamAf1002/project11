<?php

namespace App\EventSubscriber;
use App\Entity\Bloc;
use App\Entity\Filiere;
use Doctrine\ORM\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\PrePersistEventArgs;


class FiliereBlocSubscriber implements EventSubscriber
{
    public function PostPersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof Bloc) {
            $filiere = $entity->getFiliere();

            if ($filiere instanceof Filiere) {
                 
                    $filiere->addBloc($entity);
                
            }
        }
        
    }

    public   function getSubscribedEvents(): array
    {
        return [
            Events::postPersist => 'PostPersist',
        ];
    }
}
