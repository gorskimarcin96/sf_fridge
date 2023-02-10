<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230210170126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added recipe tables.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE recipe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_food_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE recipe_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recipe_food (id INT NOT NULL, recipe_id INT DEFAULT NULL, food_id INT DEFAULT NULL, unit_food VARCHAR(255) NOT NULL, volume INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AB23732859D8A214 ON recipe_food (recipe_id)');
        $this->addSql('CREATE INDEX IDX_AB237328BA8E87C4 ON recipe_food (food_id)');
        $this->addSql('CREATE TABLE recipe_image (id INT NOT NULL, recipe_id INT DEFAULT NULL, file_fn VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D32ED04059D8A214 ON recipe_image (recipe_id)');
        $this->addSql('CREATE TABLE recipe_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_609B0B0B2C2AC5D3 ON recipe_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX recipe_translation_unique_translation ON recipe_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE recipe_food ADD CONSTRAINT FK_AB23732859D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_food ADD CONSTRAINT FK_AB237328BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_image ADD CONSTRAINT FK_D32ED04059D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_translation ADD CONSTRAINT FK_609B0B0B2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE recipe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_food_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE recipe_translation_id_seq CASCADE');
        $this->addSql('ALTER TABLE recipe_food DROP CONSTRAINT FK_AB23732859D8A214');
        $this->addSql('ALTER TABLE recipe_food DROP CONSTRAINT FK_AB237328BA8E87C4');
        $this->addSql('ALTER TABLE recipe_image DROP CONSTRAINT FK_D32ED04059D8A214');
        $this->addSql('ALTER TABLE recipe_translation DROP CONSTRAINT FK_609B0B0B2C2AC5D3');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_food');
        $this->addSql('DROP TABLE recipe_image');
        $this->addSql('DROP TABLE recipe_translation');
    }
}
