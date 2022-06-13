<?php

namespace App\Controller\UserAccess;

use App\Entity\TaskItem;
use App\Service\CsvService;

use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\FilterFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class TaskItemCrudController extends AbstractCrudController
{
    private CsvService $csvService;

    public function __construct(CsvService $csvService)
    {
        $this->csvService = $csvService;
    }

    public static function getEntityFqcn(): string
    {
        return TaskItem::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $export = Action::new('export', 'CSV export')
            ->setIcon('fa fa-download')
            ->linkToCrudAction('export')
            ->setCssClass('btn')
            ->createAsGlobalAction();

        return $actions->add(Crud::PAGE_INDEX, $export);
    }

    public function export(Request $request)
    {
        $context = $request->attributes->get(EA::CONTEXT_REQUEST_ATTRIBUTE);
        $fields = FieldCollection::new($this->configureFields(Crud::PAGE_INDEX));
        $filters = $this->container->get(FilterFactory::class)->create($context->getCrud()->getFiltersConfig(), $fields, $context->getEntity());
        $tasks = $this->createIndexQueryBuilder($context->getSearch(), $context->getEntity(), $fields, $filters)
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($tasks as $task) {
            $data[] = $task->getExportData();
        }

        return $this->csvService->export($data, 'export_tasks_'.date_create()->format('d-m-y').'.csv');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Task')
            ->setEntityLabelInPlural('Tasks')
            ->setSearchFields(['text'])
            ->setDefaultSort(['flag' => 'DESC'])
            ->showEntityActionsInlined()
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('taskitem'))
        ;
    }

    public function configureFields(string $pageName): iterable
     {
        yield TextField::new('taskitemtext', 'Task');
        yield NumberField::new('flag', 'Flag');
        yield BooleanField::new('isdone', 'Done?');
        //yield DateTimeField::new('date', 'Deadline');

        $deadline = DateTimeField::new('date', 'Deadline')->setFormTypeOptions([
                        'html5' => false,
                        'widget' => 'single_text',
                    ]);
                        yield $deadline;
     }
}
