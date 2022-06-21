<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621153618 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories ADD niveau_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE categories ADD CONSTRAINT FK_3AF34668B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveaux (id)');
        $this->addSql('CREATE INDEX IDX_3AF34668B3E9C81 ON categories (niveau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories DROP FOREIGN KEY FK_3AF34668B3E9C81');
        $this->addSql('DROP INDEX IDX_3AF34668B3E9C81 ON categories');
        $this->addSql('ALTER TABLE categories DROP niveau_id');
    }
}
