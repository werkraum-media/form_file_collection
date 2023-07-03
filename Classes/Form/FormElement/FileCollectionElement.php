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

namespace WerkraumMedia\FormFileCollection\Form\FormElement;

use TYPO3\CMS\Core\Resource\FileCollectionRepository;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Form\Domain\Model\FormElements\AbstractFormElement;

/**
 * Elements are created with constructor arguments and don't have DI available.
 */
final class FileCollectionElement extends AbstractFormElement
{
    public function setProperty(string $key, $value): void
    {
        if ($key === 'fileCollection' && is_array($value)) {
            $this->setProperty('options', $this->getOptions($value));
            return;
        }

        parent::setProperty($key, $value);
    }

    /**
     * @param array<string, string> $configuration
     *
     * @return array<string, string>
     */
    public function getOptions(array $configuration): array
    {
        $uid = (int)($configuration['uid'] ?? 0);
        $collection = $this->getRepository()->findByUid($uid);
        if ($collection === null) {
            return [];
        }

        if (method_exists($collection, 'loadContents')) {
            $collection->loadContents();
        }

        $options = [];
        foreach ($collection->getItems() as $file) {
            if (!$file instanceof FileInterface) {
                continue;
            }

            $options = $this->addOption($configuration, $options, $file);
        }

        return $options;
    }

    /**
     * @param array<string, string> $configuration
     * @param array<string, string> $options
     *
     * @return array<string, string>
     */
    private function addOption(
        array $configuration,
        array $options,
        FileInterface $file
    ): array {
        $value = $file->getProperty($configuration['valueProperty'] ?? 'identifier');
        $label = $file->getProperty($configuration['labelProperty'] ?? 'identifier');

        $options[$value] = $label;
        return $options;
    }

    private function getRepository(): FileCollectionRepository
    {
        return GeneralUtility::makeInstance(FileCollectionRepository::class);
    }
}
