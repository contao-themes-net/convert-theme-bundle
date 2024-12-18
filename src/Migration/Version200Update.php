<?php

declare(strict_types=1);

/*
 * CONVERT theme for Contao Open Source CMS
 *
 * Copyright (C) 2024 pdir / digital agentur // pdir GmbH
 *
 * @package    contao-themes-net/convert-theme-bundle
 * @link       https://github.com/contao-themes-net/convert-theme-bundle
 * @license    pdir contao theme licence
 * @author     Mathias Arzberger <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ContaoThemesNet\ConvertThemeBundle\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

/**
 * @internal
 */
class Version200Update extends AbstractMigration
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws \Exception
     */
    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->createSchemaManager();

        // If the database table itself does not exist we should do nothing
        if (!$schemaManager->tablesExist(['tl_content'])) {
            return false;
        }

        $test = $this->connection->fetchOne("
            SELECT
                id
            FROM
                tl_content
            WHERE
                customTpl = 'ce_text_portfolio' OR 
                customTpl = 'ce_gallery_convert' OR 
                customTpl = 'ce_hyperlink_button_convert'
        ");

        return false !== $test;
    }

    /**
     * @throws \Exception
     */
    public function run(): MigrationResult
    {
        // change templates
        $this->connection->executeStatement("
            UPDATE
                tl_content
            SET
                customTpl = 'content_element/text/portfolio_convert'
            WHERE
                customTpl = 'ce_text_portfolio'
        ");

        $this->connection->executeStatement("
            UPDATE
                tl_content
            SET
                customTpl = 'content_element/gallery/gallery_convert'
            WHERE
                customTpl = 'ce_gallery_convert'
        ");

        $this->connection->executeStatement("
            UPDATE
                tl_content
            SET
                customTpl = 'content_element/hyperlink/button_convert'
            WHERE
                customTpl = 'ce_hyperlink_button_convert'
        ");

        return $this->createResult(
            true
        );
    }
}
