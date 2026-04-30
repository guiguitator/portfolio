<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Projet')
            ->setEntityLabelInPlural('Projets');
    }

    public function configureFields(string $pageName): iterable
    {
        yield FormField::addColumn(4);
        // yield FormField::addFieldset('Détails', 'fas fa-circle-info');
        yield IdField::new('id')
                ->hideOnForm();
        yield TextField::new('name', 'Nom');
        yield TextField::new('caption', 'Accroche');
        yield ImageField::new('image', 'Image')
            ->setBasePath('uploads/projects')
            ->setUploadDir('public/uploads/projects')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->onlyOnForms();
        yield AssociationField::new('tags', 'Tags');
        yield UrlField::new('githubUrl', 'URL du GitHub')
            ->hideOnIndex();
        yield UrlField::new('documentationUrl', 'URL de la documentation')
            ->hideOnIndex();
        yield BooleanField::new('featured', 'À la une ?')
            ->hideOnIndex();

        yield FormField::addColumn(8);
        // yield FormField::addFieldset('Contenu', 'fas fa-file-pen');
        yield TextEditorField::new('content', 'Description')
            ->hideOnIndex();
    }
}
