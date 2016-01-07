<?php

namespace AppBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PersonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $self = $this;
        $builder
            ->add('vorname', TextType::class, array('mapped' => false))
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreSubmit'))
            ->addEventListener(
                FormEvents::POST_SET_DATA,
                array($this, 'onPreSetData'))
            ->add('nachname')
            ->add('nachnameGeboren')
            ->add('geschlecht', ChoiceType::class, array(
                'choices' => array(
                    'Männlich' => 'm',
                    'Weiblich' => 'f'
                ),
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ))
            ->add('geborenAm', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'attr' => array('class' => 'datepicker')
            ))
            ->add('geburtsort')
            ->add('geburtsortplz', TextType::class, array('mapped' => false, 'label' => 'PLZ'))
            ->add('beruf')
            ->add('besonderes',TextareaType::class,array(
                'attr'=>array(
                    'class'=>'materialize-textarea'
                )
            ))
            ->add('mutter', EntityType::class, array(
                'expanded' => false,
                'multiple' => false,
                'attr' => array('class' => 'input-field'),
                'class' => 'AppBundle\Entity\Person',
                'placeholder' => 'keine ausgewählt',
                'empty_data' => null,
                'required' => false,
                'choice_label' => function ($person) {
                    return $person->getFullname();
                },
                'query_builder' => function (EntityRepository $er) use ($options) {
                    $qb = $er->createQueryBuilder('u');
                    $user = $options['data'];

                    if ($user->getId()) {
                        return $qb->where("u.geschlecht = 'f'")->andWhere($qb->expr()->not('u.id = :id'))->setParameter(':id', $user->getId());
                    } else {
                        return $qb->where("u.geschlecht = 'f'");
                    }
                }
            ))
            ->add('vater', EntityType::class, array(
                'expanded' => false,
                'multiple' => false,
                'attr' => array('class' => 'input-field'),
                'class' => 'AppBundle\Entity\Person',
                'placeholder' => 'keine ausgewählt',
                'empty_data' => null,
                'required' => false,
                'choice_label' => function ($person) {
                    return $person->getFullname();
                },
                'query_builder' => function (EntityRepository $er) use ($options) {
                    $qb = $er->createQueryBuilder('u');
                    $user = $options['data'];

                    if ($user->getId()) {
                        return $qb->where("u.geschlecht = 'm'")->andWhere($qb->expr()->not('u.id = :id'))->setParameter(':id', $user->getId());
                    } else {
                        return $qb->where("u.geschlecht = 'm'");
                    }
                }
            ))
            ->add('isdead', ChoiceType::class, array(
                    'mapped' => false,
                    'label' => 'Verstorben',
                    'attr'=>array(
                        'id'=>'isdead',
                        'data-togglegroup'=>'gestorben'
                    ),
                    'choices' => array(
                        'dead' => true,
                    ),
                    'multiple' => true,
                    'expanded' => true,
                    'required'=>false
                )
            )
            ->add('ismarried', ChoiceType::class, array(
                    'mapped' => false,
                    'label' => 'Verheiratet',
                    'attr'=>array(
                        'id'=>'ismarried',
                        'data-togglegroup'=>'verheiratet'
                    ),
                    'choices' => array(
                        'married' => true,
                    ),
                    'multiple' => true,
                    'expanded' => true,
                    'required'=>false
                )
            )
            ->add('verheiratetMit', EntityType::class, array(
                'expanded' => false,
                'multiple' => false,
                'mapped'=>false,
                'attr' => array('class' => 'input-field'),
                'class' => 'AppBundle\Entity\Person',
                'placeholder' => 'keine ausgewählt',
                'empty_data' => null,
                'required' => false,
                'choice_label' => function ($person) {
                    return $person->getFullname();
                },
                'query_builder' => function (EntityRepository $er) use ($options, $self) {
                    $qb = $er->createQueryBuilder('u');
                    $user = $options['data'];
                    /* @var \AppBundle\Entity\Person $user */
                    if ($user->getId()) {
                        $geschlecht = $user->getGeschlecht();
                        if($geschlecht ==='m'){
                            $geschlecht = 'f';
                        }else{
                            $geschlecht = 'm';
                        }
                        return $qb->where("u.geschlecht = :gender")->andWhere($qb->expr()->not('u.id = :id'))->setParameter(':id', $user->getId())->setParameter(':gender',$geschlecht);
                    } else {
                        return $qb;
                    }
                }
            ))

            ->add('gestorbenAm', DateTimeType::class, array(
                'widget' => 'single_text',
                'format' => 'dd.MM.yyyy',
                'required'=>false,
                'attr' => array('class' => 'datepicker')
            ))
            ->add('sterbeort',TextType::class,array(
                'required'=>false
            ))
            ->add('sterbeortplz', TextType::class, array('mapped' => false,'required'=>false, 'label' => 'PLZ'))


            ->add('submit', SubmitType::class, array('label' => 'Speichern', 'attr'=>array('class'=>'btn primary waves-effect waves-light')));

    }

    /**
     * @param FormEvent $event
     */
    public function onPreSubmit(FormEvent $event)
    {

        $entity = $event->getForm()->getData();
        $formdata = $event->getData();
        $entity->setVorname2('');
        $entity->setVorname3('');
        $firstnames = preg_split("# #", $formdata['vorname'], -1, PREG_SPLIT_NO_EMPTY);

        if (is_array($firstnames)) {
            $entity->setVorname($firstnames[0]);

            if (isset($firstnames[1])) {
                $entity->setVorname2($firstnames[1]);
            }
            if (isset($firstnames[2])) {
                $entity->setVorname3($firstnames[2]);
            }
        }
    }

    public function onPreSetData(FormEvent $event)
    {
        $entity = $event->getData();
        $vorname = $entity->getVorname() .
            ($entity->getVorname2() ? " " . $entity->getVorname2() : "") .
            ($entity->getVorname3() ? " " . $entity->getVorname3() : "");

        $event->getForm()->get("vorname")->setData($vorname);
    }

    /**
     * Configures the options for this type.
     *
     * @param OptionsResolver $resolver The resolver for the options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Person'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_person';
    }
}
