<?php

namespace App\Controller\UserAccess;

use App\Entity\TaskItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class TaskItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TaskItem::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Task')
            ->setEntityLabelInPlural('Tasks')
            ->setSearchFields(['text'])
            ->setDefaultSort(['date' => 'DESC'])
        ;
    }

   /* public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('id'))
        ;
    }

    public function configureFields(string $pageName): iterable
     {
        yield AssociationField::new('id');
        yield TextareaField::new('text')
            ->hideOnIndex()
        ;
        
        $date = DateTimeField::new('date')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ]);
        if (Crud::PAGE_EDIT === $pageName) {
            yield $date->setFormTypeOption('disabled', true);
        } else {
            yield $date;
        }
     }*/
}
