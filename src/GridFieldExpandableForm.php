<?php

namespace SilverStripe\GridFieldAddOns;

use SilverStripe\Forms\Form;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\View\Requirements;
use SilverStripe\Control\Controller;
use SilverStripe\Control\RequestHandler;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\ValidationException;
use SilverStripe\Control\PjaxResponseNegotiator;
use SilverStripe\Forms\GridField\GridField_URLHandler;
use SilverStripe\Forms\GridField\GridField_HTMLProvider;
use SilverStripe\GridFieldAddOns\GridFieldExpandableForm;
use SilverStripe\GridFieldAddOns\GridFieldExpandableForm_ItemRequest;

class GridFieldExpandableForm implements GridField_URLHandler, GridField_HTMLProvider
{

    public $template = GridFieldExpandableForm::class;
    public $formorfields;

    function __construct($formorfields = null)
    {

        $this->formorfields = $formorfields;
    }

    public function getURLHandlers($gridField)
    {
        return array(
            'expand/$ID' => 'handleItem',
        );
    }

    public function handleItem($gridField, $request)
    {

        $controller = $gridField->getForm()->getController();

        $record = $gridField->getList()->byId($request->param("ID"));

        $handler = Injector::inst()->create(GridFieldExpandableForm_ItemRequest::class, $gridField, $this, $record, $controller, 'DetailForm', $this->formorfields);

        return $handler->handleRequest($request);
    }

    public function getHTMLFragments($gridField)
    {
        Requirements::javascript('silverstripe/gridfield-addons:/javascript/GridFieldExpandableForm.js');
        Requirements::css('silverstripe/gridfield-addons:/css/GridFieldExpandableForm.css');

        $gridField->addExtraClass('expandable-forms');
        $gridField->setAttribute('data-pseudo-form-url', $gridField->Link('expand'));

        return array();
    }
}
