<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210162409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added food tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE food_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE food (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE food_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_15DF93A12C2AC5D3 ON food_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX food_translation_unique_translation ON food_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE food_translation ADD CONSTRAINT FK_15DF93A12C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES food (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE food_translation_id_seq CASCADE');
        $this->addSql('ALTER TABLE food_translation DROP CONSTRAINT FK_15DF93A12C2AC5D3');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE food_translation');
    }
}
