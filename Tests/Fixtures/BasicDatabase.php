<?php

return [
    'pages' => [
        [
            'uid' => 1,
            'pid' => 0,
            'slug' => '/',
            'title' => 'Page Title',
        ],
        [
            'uid' => 2,
            'pid' => 1,
            'slug' => '/page-2',
            'title' => 'Page 2 Title',
        ],
    ],
    'tt_content' => [
        [
            'uid' => 1,
            'pid' => 1,
            'header' => 'Form',
            'header_layout' => '0',
            'CType' => 'form_formframework',
            'pi_flexform' => '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
                <T3FlexForms>
                    <data>
                        <sheet index="sDEF">
                            <language index="lDEF">
                                <field index="settings.persistenceIdentifier">
                                    <value index="vDEF">EXT:form_file_collection_example/Configuration/Forms/Example.form.yaml</value>
                                </field>
                                <field index="settings.overrideFinishers">
                                    <value index="vDEF">0</value>
                                </field>
                            </language>
                        </sheet>
                    </data>
                </T3FlexForms>
            ',
        ],
        [
            'uid' => 2,
            'pid' => 2,
            'header' => 'Form',
            'header_layout' => '0',
            'CType' => 'form_formframework',
            'pi_flexform' => '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>
                <T3FlexForms>
                    <data>
                        <sheet index="sDEF">
                            <language index="lDEF">
                                <field index="settings.persistenceIdentifier">
                                    <value index="vDEF">EXT:form_file_collection_example/Configuration/Forms/ExampleCustomLabelAndValue.form.yaml</value>
                                </field>
                                <field index="settings.overrideFinishers">
                                    <value index="vDEF">0</value>
                                </field>
                            </language>
                        </sheet>
                    </data>
                </T3FlexForms>
            ',
        ],
    ],
];
