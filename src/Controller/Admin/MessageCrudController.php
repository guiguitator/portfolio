<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MessageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['answered' => 'ASC', 'createdAt' => 'DESC'])
            ->setEntityLabelInSingular('Message')
            ->setEntityLabelInPlural('Messages');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('senderName', 'Nom de l\'envoyeur');
        yield EmailField::new('senderEmail', 'Email');
        yield TextField::new('subject', 'Sujet');
        yield TextEditorField::new('content', 'Contenu');
        yield BooleanField::new('answered', 'Répondu');
        yield DateField::new('createdAt', 'Date');
    }

    public function configureActions(Actions $actions): Actions
    {
        // TODO: Create an action to mark a message as replied
        
        return $actions
            ->add(Crud::PAGE_INDEX, 'detail')
            ->disable('edit');
    }
}
