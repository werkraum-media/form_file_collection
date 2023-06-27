<?php

declare(strict_types=1);

/*
 * Copyright (C) 2023 Daniel Siepmann <coding@daniel-siepmann.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301, USA.
 */

namespace WerkraumMedia\FormFileCollection\Tests\Functional;

use Codappix\Typo3PhpDatasets\TestingFramework;
use TYPO3\TestingFramework\Core\Functional\Framework\Frontend\InternalRequest;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

class FormIntegrationTest extends FunctionalTestCase
{
    use TestingFramework;

    public function setUp(): void
    {
        $this->coreExtensionsToLoad = [
            'fluid_styled_content',
            'form',
        ];
        $this->testExtensionsToLoad = [
            'typo3conf/ext/form_file_collection',
            'typo3conf/ext/form_file_collection/Tests/Fixtures/form_file_collection_example',
        ];
        $this->pathsToLinkInTestInstance = [
            'typo3conf/ext/form_file_collection/Tests/Fixtures/Sites' => 'typo3conf/sites',
            'typo3conf/ext/form_file_collection/Tests/Fixtures/Fileadmin/Files' => 'fileadmin/Files',
        ];

        parent::setUp();

        $this->importPHPDataSet(__DIR__ . '/../Fixtures/BasicDatabase.php');
        $this->setUpFrontendRootPage(1, [
            'setup' => [
                'EXT:fluid_styled_content/Configuration/TypoScript/setup.typoscript',
                'EXT:form_file_collection_example/Configuration/TypoScript/Form.typoscript',
            ],
        ]);
    }

    /**
     * @test
     */
    public function rendersFileFromSelectedCollection(): void
    {
        $this->importPHPDataSet(__DIR__ . '/../Fixtures/SingleFileDatabase.php');

        $request = new InternalRequest();

        $response = $this->executeFrontendRequest($request);

        $content = $response->getBody()->__toString();
        self::assertStringContainsString('name="tx_form_formframework[test-1][file-collection-1]"', $content);

        self::assertStringContainsString('FirstResult.png', $content);
        self::assertStringContainsString('value="/Files/FirstResult.png"', $content);
        self::assertStringContainsString('<span>/Files/FirstResult.png</span>', $content);

        self::assertStringNotContainsString('SecondResult.png', $content);
    }

    /**
     * @test
     */
    public function providesMultipleFilesFromSelectedCollection(): void
    {
        $this->importPHPDataSet(__DIR__ . '/../Fixtures/TwoFilesDatabase.php');

        $request = new InternalRequest();

        $response = $this->executeFrontendRequest($request);

        $content = $response->getBody()->__toString();
        self::assertStringContainsString('name="tx_form_formframework[test-1][file-collection-1][]"', $content);

        self::assertStringContainsString('FirstResult.png', $content);
        self::assertStringContainsString('value="/Files/FirstResult.png"', $content);
        self::assertStringContainsString('<span>/Files/FirstResult.png</span>', $content);

        self::assertStringContainsString('SecondResult.png', $content);
        self::assertStringContainsString('value="/Files/SecondResult.png"', $content);
        self::assertStringContainsString('<span>/Files/SecondResult.png</span>', $content);
    }

    /**
     * @test
     */
    public function rendersConfiguredLabel(): void
    {
        $this->importPHPDataSet(__DIR__ . '/../Fixtures/SingleFileDatabase.php');

        $request = new InternalRequest();
        $request = $request->withPageId(2);

        $response = $this->executeFrontendRequest($request);

        $content = $response->getBody()->__toString();
        self::assertStringContainsString('name="tx_form_formframework[test-2][file-collection-1][]"', $content);

        self::assertStringContainsString('value="29b827d0daa29658d8a0d952dfd20f559bbe3bcf"', $content);
        self::assertStringContainsString('<span>image/png</span>', $content);
    }
}
