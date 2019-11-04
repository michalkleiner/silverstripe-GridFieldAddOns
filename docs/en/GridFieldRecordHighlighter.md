# GridFieldRecordHighlighter

GridFieldRecordHighlighter highlights records in a GridField. A lot of people love to tint their spreadsheets in red and green and all the colors of the rainbow to highlight certain rows, indicating that there is something noteworthy about them. This component does exactly the same automatically by inspecting the records for the rules you specify.

Currently there are three states:

- nothing to highlight
- `info` indicated by a blue 'i'
- `alert` indicated by a red exclamation mark

These indicators are displayed in their own column. On mouseover they show the message that was returned on inspection.

The component can use properties or methods of the records to retrieve a value that gets compared with a given reference value using on of the following comparison operators:

- equal
- equalstrict
- unequal
- unequalstrict
- greater
- greaterorequal
- less
- lessorequal
- beginwith
- endwith
- contain
- regex

## Code Example

	class Bar extends DataObject {
		static $db = array(
			'Title' => 'Varchar',
			'Enabled' => 'Boolean'
		);
	}

	class Foo extends DataObject {

		static $db = array('Title' => 'Varchar');

		static $many_many = array('Bars' => 'Bar');

		static $many_many_extraFields = array('Bars' => array('Relation' => 'Varchar', 'OrderBy' => 'Int'));

		function getCMSFields() {
			$fields = parent::getCMSFields();
			if($field = $fields->dataFieldByName('Bars')) {

				$alerts = array(
					// Highlight the row if the Title of the Bar object is 'Bar'
					'Title' => array(
						'comparator' => 'equal',
						'patterns' => array(
							'Bar' => array(
								'status' => 'info',
								'message' => '"Bar" is not a witty title for a bar object.',
							),
						),
					),
					// Highlight the row if the Enabled property of the Bar object is false
					'Enabled' => array(
					  'comparator' => 'equal',
						'patterns' => array(
							0 => array(
								'status' => 'alert',
								'message' => 'Bar is disabled'
							),
						),
					)
				);
				$field->getConfig()->addComponent(new GridFieldRecordHighlighter($alerts));
			}
			return $fields;
		}
	}

## Screenshots

![GridFieldRecordHighlighter](https://raw.github.com/smindel/silverstripe-GridFieldAddOns/master/docs/en/_images/GridFieldRecordHighlighter1.png)

*GridFieldRecordHighlighter in action*
