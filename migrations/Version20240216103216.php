<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216103216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Set database structure for the User and Thanks entities';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE thanks (id INT AUTO_INCREMENT NOT NULL, from_who_id INT NOT NULL, to_who_id INT NOT NULL, message LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6E5365E79D320F1 (from_who_id), INDEX IDX_6E5365ED23057BC (to_who_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D6495E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE thanks ADD CONSTRAINT FK_6E5365E79D320F1 FOREIGN KEY (from_who_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE thanks ADD CONSTRAINT FK_6E5365ED23057BC FOREIGN KEY (to_who_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE thanks DROP FOREIGN KEY FK_6E5365E79D320F1');
        $this->addSql('ALTER TABLE thanks DROP FOREIGN KEY FK_6E5365ED23057BC');
        $this->addSql('DROP TABLE thanks');
        $this->addSql('DROP TABLE user');
    }
}
