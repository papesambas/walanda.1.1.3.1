<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220626113205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medias (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, alt_text VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, page_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, menu_order INT DEFAULT NULL, is_visible TINYINT(1) NOT NULL, link VARCHAR(255) DEFAULT NULL, INDEX IDX_727508CF38B217A7 (publication_id), INDEX IDX_727508CFBCF5E72D (categorie_id), INDEX IDX_727508CFC4663E4 (page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menus_menus (menus_source INT NOT NULL, menus_target INT NOT NULL, INDEX IDX_2317EF6380BBF257 (menus_source), INDEX IDX_2317EF63995EA2D8 (menus_target), PRIMARY KEY(menus_source, menus_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, valeur VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF38B217A7 FOREIGN KEY (publication_id) REFERENCES publications (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CFC4663E4 FOREIGN KEY (page_id) REFERENCES pages (id)');
        $this->addSql('ALTER TABLE menus_menus ADD CONSTRAINT FK_2317EF6380BBF257 FOREIGN KEY (menus_source) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menus_menus ADD CONSTRAINT FK_2317EF63995EA2D8 FOREIGN KEY (menus_target) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_29F65EB1989D9B62 ON etablissements (slug)');
        $this->addSql('ALTER TABLE publications ADD featured_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE publications ADD CONSTRAINT FK_32783AF43569D950 FOREIGN KEY (featured_image_id) REFERENCES medias (id)');
        $this->addSql('CREATE INDEX IDX_32783AF43569D950 ON publications (featured_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE publications DROP FOREIGN KEY FK_32783AF43569D950');
        $this->addSql('ALTER TABLE menus_menus DROP FOREIGN KEY FK_2317EF6380BBF257');
        $this->addSql('ALTER TABLE menus_menus DROP FOREIGN KEY FK_2317EF63995EA2D8');
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CFC4663E4');
        $this->addSql('DROP TABLE medias');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE menus_menus');
        $this->addSql('DROP TABLE options');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP INDEX UNIQ_29F65EB1989D9B62 ON etablissements');
        $this->addSql('DROP INDEX IDX_32783AF43569D950 ON publications');
        $this->addSql('ALTER TABLE publications DROP featured_image_id');
    }
}
