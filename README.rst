====================================
TYPO3 Extension Form File Collection
====================================

Adds new EXT:form element used to render a file collection allowing the visitor to choose files.

Concept
=======

The form element will fetch the configured file collection and assign proper options based on the contained files.
That allows using existing templates that allow to select a single or multiple options.

EXT:form integration
====================

The provided Configuration needs to be loaded via TypoScript.
Use a free identifier:

.. code:: plain

   plugin.tx_form.settings.yamlConfigurations {
       80 = EXT:form_file_collection/Configuration/Form/Setup.yaml
   }

No template is configured by default, choose one of the existing ones or provide your own:

.. code:: yaml

   TYPO3:
     CMS:
       Form:
         prototypes:
           standard:
             formElementsDefinition:
               FileCollection:
                 renderingOptions:
                   # Allows to switch between different rendering like "Checkbox", "MultiCheckbox" or "RadioButton", etc.
                   templateName: 'MultiCheckbox'

The existing templates will work out of the box.
An additional variable `files` is added for usage within custom templates.

This will register a new form element type ``FileCollection`` that can be used like this:

.. code:: yaml

   -
     type: FileCollection
     identifier: file-collection-1
     label: 'File Collection'
     properties:
       fileCollection:
         # UID of the sys_file_collection to use
         uid: 1
         # Optional, default is identifier
         # Defines the property to use as value for form element.
         valueProperty: 'identifier'
         # Optional, default is identifier
         # Defines the property to use as label for form element.
         labelProperty: 'identifier'

The two options `valueProperty` and `labelProperty` are used to prepare the `options` variable used by the available default templates.

Example
-------

A concrete example can be found within ``Tests/Fixtures/form_file_collection_example``.
