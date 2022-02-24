<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224014157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_329937516ED75F8F');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751F773E7CA');
        $this->addSql('DROP INDEX UNIQ_329937516ED75F8F ON score');
        $this->addSql('DROP INDEX IDX_32993751F773E7CA ON score');
        $this->addSql('ALTER TABLE score DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE score ADD student_id INT NOT NULL, ADD subject_id INT NOT NULL, DROP id, DROP student_id_id, DROP subject_id_id');
        $this->addSql('ALTER TABLE score ADD PRIMARY KEY (student_id, subject_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE score ADD id INT AUTO_INCREMENT NOT NULL, ADD student_id_id INT NOT NULL, ADD subject_id_id INT NOT NULL, DROP student_id, DROP subject_id, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_329937516ED75F8F FOREIGN KEY (subject_id_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751F773E7CA FOREIGN KEY (student_id_id) REFERENCES student (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_329937516ED75F8F ON score (subject_id_id)');
        $this->addSql('CREATE INDEX IDX_32993751F773E7CA ON score (student_id_id)');
    }
}
