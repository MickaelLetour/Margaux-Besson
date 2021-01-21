<?php

namespace App\Form;

use App\Entity\PhotoSearch;
use App\Entity\Photo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PhotoSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('theme', ChoiceType::class,[
                'choices' => $this->getChoicesTheme(),
                'required' => false,
                'label' => 'Theme des photos',
            ])
            ->add('header', ChoiceType::class,[
                'choices' => $this->getChoicesHeader(),
                'required' => false,
                'label' => 'Emplacement des photos',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PhotoSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    /**
     * récupère l'intitulté des thèmes correspondant en bdd
     */
    private function getChoicesTheme(){
        $Themes = PHOTO::THEME;
        $outputTheme = [];
        foreach($Themes as $k => $v) {
            $outputTheme[$v] = $k;
        }
        return $outputTheme;
    }

    /**
     * recupère les intitulés des titres correspondant en bdd
     */
    private function getChoicesHeader(){
        $Headers = PHOTO::HEADER;
        $outputHeader= [];
        foreach($Headers as $k => $v) {
            $outputHeader[$v] = $k;
        }
        return $outputHeader;
    }

    /**
     * permet un rendu propre de l 'url arprès validation des filtres de la recherche
     */
    public function getBlockPrefix(){
        return '';
    }
}
