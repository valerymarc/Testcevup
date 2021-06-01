<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210526190931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_26A98456FB88E14F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achat AS SELECT id, utilisateur_id, produit1, produit2, produit3, produit4 FROM achat');
        $this->addSql('DROP TABLE achat');
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER NOT NULL, produit1 INTEGER NOT NULL, produit2 INTEGER NOT NULL, produit3 INTEGER NOT NULL, produit4 INTEGER NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_26A98456FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO achat (id, utilisateur_id, produit1, produit2, produit3, produit4) SELECT id, utilisateur_id, produit1, produit2, produit3, produit4 FROM __temp__achat');
        $this->addSql('DROP TABLE __temp__achat');
        $this->addSql('CREATE INDEX IDX_26A98456FB88E14F ON achat (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_26A98456FB88E14F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achat AS SELECT id, utilisateur_id, produit1, produit2, produit3, produit4 FROM achat');
        $this->addSql('DROP TABLE achat');
        $this->addSql('CREATE TABLE achat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER NOT NULL, produit1 INTEGER NOT NULL, produit2 INTEGER NOT NULL, produit3 INTEGER NOT NULL, produit4 INTEGER NOT NULL)');
        $this->addSql('INSERT INTO achat (id, utilisateur_id, produit1, produit2, produit3, produit4) SELECT id, utilisateur_id, produit1, produit2, produit3, produit4 FROM __temp__achat');
        $this->addSql('DROP TABLE __temp__achat');
        $this->addSql('CREATE INDEX IDX_26A98456FB88E14F ON achat (utilisateur_id)');
    }
}
