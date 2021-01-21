<?php

namespace App\Form;

use App\Entity\Photo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('theme', ChoiceType::class, [
                'choices' => $this->getChoicesTheme()
            ])
            ->add('orientation', ChoiceType::class, [
                'choices' => $this->getChoicesOrientation()
            ])
            ->add('header', ChoiceType::class, [
                'choices' => $this->getChoicesHeader()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
            'translation_domain' => 'forms'
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
     * récupère l'intitulté des orientation de photos correspondant en bdd
     */
    private function getChoicesOrientation(){
        $orientations = PHOTO::ORIENTATION;
        $outputOrientation = [];
        foreach($orientations as $k => $v) {
            $outputOrientation[$v] = $k;
        }
        return $outputOrientation;
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
}
