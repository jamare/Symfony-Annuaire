<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ApplicationType extends AbstractType{
    /*
    * Permet d'avoir la configuration de base d'un champ -> mise en protected pour que les class qui hérite du ApplicationType
    * puissent l'utiliser
    *
    * @param string $label
    * @param string $placeholder
    * @param array $options
    * @return array
    */
    protected function getConfiguration($label,$placeholder,$options = []){
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}