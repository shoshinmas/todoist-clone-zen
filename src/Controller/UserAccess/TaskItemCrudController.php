<?php

namespace UserAccess;

use App\Entity\TaskItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TaskItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TaskItem::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
