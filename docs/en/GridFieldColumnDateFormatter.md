# GridFieldColumnDateFormatter

GridFieldColumnDateFormatter reformats the parent GridField columns so that
any Date/DateTime fields are formatted in the chosen format (default is 
`DBDate::Nice()`) while retaining sorting.

## Code Example

Just add the component to your `GridField` as you would any other:

    use SilverStripe\GridFieldAddOns\GridFieldColumnDateFormatter;

	$grid_field->getConfig()->addComponent(new GridFieldColumnDateFormatter());

**NOTE** Ensure you add this component after any other column providers and
headers.

## Customising the date format

You can customise the date format either globally (using SilverStripe config) or
per instance (using `setDateType`).

### Global

Set the date format globally using `GridFieldColumnDateFormatter.default_date_type`.

For example to use the `Full` date format using config.yml you could add:

    SilverStripe\GridFieldAddOns\GridFieldColumnDateFormatter:
      default_date_type: '.Full'

### Per instance

If you want a particular `GridField` to use a custom date format, you can use
`GridFieldColumnDateFormatter::setDateType()`. For example, if you want a `GridField`
to use `DBDate::Short()`:

    use SilverStripe\GridFieldAddOns\GridFieldColumnDateFormatter;

    $date_formatter = new GridFieldColumnDateFormatter();
    $date_formatter->setDateType(".Short");
	$grid_field->getConfig()->addComponent($date_formatter);