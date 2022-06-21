<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220621163156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, publication_id INT NOT NULL, contenu LONGTEXT NOT NULL, rgpd TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, is_actif TINYINT(1) NOT NULL, INDEX IDX_5F9E962AA76ED395 (user_id), INDEX IDX_5F9E962A38B217A7 (publication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962AA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A38B217A7 FOREIGN KEY (publication_id) REFERENCES publications (id)');
        $this->addSql('ALTER TABLE categories CHANGE slug slug VARCHAR(128) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF34668989D9B62 ON categories (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72B88B24989D9B62 ON cycles (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56F771A0989D9B62 ON niveaux (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_32783AF4989D9B62 ON publications (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comments');
        $this->addSql('DROP INDEX UNIQ_3AF34668989D9B62 ON categories');
        $this->addSql('ALTER TABLE categories CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_72B88B24989D9B62 ON cycles');
        $this->addSql('DROP INDEX UNIQ_56F771A0989D9B62 ON niveaux');
        $this->addSql('DROP INDEX UNIQ_32783AF4989D9B62 ON publications');
    }
}
