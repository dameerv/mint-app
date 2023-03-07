<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306180702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE users_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chat (id INT NOT NULL, issue_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_659DF2AA5E7AA58C ON chat (issue_id)');
        $this->addSql('CREATE TABLE issue (id INT NOT NULL, admin_id INT DEFAULT NULL, chat_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, text TEXT NOT NULL, is_closed BOOLEAN NOT NULL, is_resolved BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12AD233E642B8210 ON issue (admin_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_12AD233E1A9A7125 ON issue (chat_id)');
        $this->addSql('CREATE TABLE message (id INT NOT NULL, issue_id INT DEFAULT NULL, user_from_id INT NOT NULL, user_to_id INT NOT NULL, chat_id INT NOT NULL, text TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B6BD307F5E7AA58C ON message (issue_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F20C3C701 ON message (user_from_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FD2F7B13D ON message (user_to_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F1A9A7125 ON message (chat_id)');
        $this->addSql('CREATE TABLE users (id INT NOT NULL, roles JSON NOT NULL, name VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AA5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E642B8210 FOREIGN KEY (admin_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE issue ADD CONSTRAINT FK_12AD233E1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F20C3C701 FOREIGN KEY (user_from_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FD2F7B13D FOREIGN KEY (user_to_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE users_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE chat DROP CONSTRAINT FK_659DF2AA5E7AA58C');
        $this->addSql('ALTER TABLE issue DROP CONSTRAINT FK_12AD233E642B8210');
        $this->addSql('ALTER TABLE issue DROP CONSTRAINT FK_12AD233E1A9A7125');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F5E7AA58C');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F20C3C701');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307FD2F7B13D');
        $this->addSql('ALTER TABLE message DROP CONSTRAINT FK_B6BD307F1A9A7125');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE users');
    }
}
