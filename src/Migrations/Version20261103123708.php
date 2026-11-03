<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261103123708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

  
public function up(Schema $schema): void
{
    $this->addSql('ALTER TABLE exercice RENAME COLUMN date_debut TO debut_at');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN date_fin TO fin_at');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN date_limite_prets TO limite_prets_at');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN date_retribution TO retribution_at');

    $this->addSql('ALTER TABLE exercice ALTER COLUMN fin_at DROP NOT NULL');
    $this->addSql('ALTER TABLE exercice ALTER COLUMN limite_prets_at DROP NOT NULL');
    $this->addSql('ALTER TABLE exercice ALTER COLUMN retribution_at DROP NOT NULL');

    $this->addSql('ALTER TABLE exercice ADD create_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    $this->addSql('UPDATE exercice SET create_at = CURRENT_TIMESTAMP WHERE create_at IS NULL');
    $this->addSql('ALTER TABLE exercice ALTER COLUMN create_at SET NOT NULL');

    $this->addSql('ALTER TABLE exercice ADD update_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
}

public function down(Schema $schema): void
{
    $this->addSql('ALTER TABLE exercice DROP create_at');
    $this->addSql('ALTER TABLE exercice DROP update_at');

    $this->addSql('ALTER TABLE exercice RENAME COLUMN debut_at TO date_debut');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN fin_at TO date_fin');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN limite_prets_at TO date_limite_prets');
    $this->addSql('ALTER TABLE exercice RENAME COLUMN retribution_at TO date_retribution');

    $this->addSql('ALTER TABLE exercice ALTER COLUMN date_fin SET NOT NULL');
    $this->addSql('ALTER TABLE exercice ALTER COLUMN date_limite_prets SET NOT NULL');
    $this->addSql('ALTER TABLE exercice ALTER COLUMN date_retribution SET NOT NULL');
}

}
