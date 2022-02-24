<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224014613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, major_name VARCHAR(255) NOT NULL, batch VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (student_id INT NOT NULL, subject_id INT NOT NULL, score DOUBLE PRECISION NOT NULL, PRIMARY KEY(student_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, major_id_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, do_b DATE DEFAULT NULL, INDEX IDX_B723AF33312DAEDA (major_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subject (id INT AUTO_INCREMENT NOT NULL, major_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FBCE3E7A312DAEDA (major_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33312DAEDA FOREIGN KEY (major_id_id) REFERENCES major (id)');
        $this->addSql('ALTER TABLE subject ADD CONSTRAINT FK_FBCE3E7A312DAEDA FOREIGN KEY (major_id_id) REFERENCES major (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33312DAEDA');
        $this->addSql('ALTER TABLE subject DROP FOREIGN KEY FK_FBCE3E7A312DAEDA');
        $this->addSql('DROP TABLE major');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE subject');
    }
}
