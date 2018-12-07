<?php

namespace Correction\TP7\Plugin;

class RandomizeOnLoad
{
    public function aroundLoad(
        \Magento\Customer\Model\ResourceModel\Customer $subject, \Closure $proceed,
        $object, $entityId, $attributes = []
    )
    {
        $doRandomize = $object->getData('random');
        if($doRandomize)
        {
            $firstNames = ['Adrien', 'Benjamin', 'Clément', 'Damien', 'Eugène', 'Francis'];
            $lastNames = ['Dupont', 'Dupond', 'Dulac', 'Dujardin', 'Dupuy'];
            $randomFirstNameIndex = rand(0,count($firstNames) - 1);
            $randomLastNameIndex = rand(0,count($lastNames) - 1);

            $object->setFirstname($firstNames[$randomFirstNameIndex]);
            $object->setLastname($lastNames[$randomLastNameIndex]);
            $object->setEmail(strtolower($firstNames[$randomFirstNameIndex][0].$lastNames[$randomLastNameIndex].'@test.fr'));
        }
        else
        {
            $proceed($object, $entityId, $attributes);
        }

        return $subject;
    }
}