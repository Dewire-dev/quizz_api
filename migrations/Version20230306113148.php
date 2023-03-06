<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306113148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT NOT NULL, label VARCHAR(255) NOT NULL, is_good_answer TINYINT(1) NOT NULL, point SMALLINT NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avatar (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quizz_id INT NOT NULL, label VARCHAR(255) NOT NULL, position SMALLINT NOT NULL, INDEX IDX_B6F7494EBA934BCD (quizz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz (id INT AUTO_INCREMENT NOT NULL, creator_id INT DEFAULT NULL, category VARCHAR(50) NOT NULL, subject VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_7C77973D61220EA6 (creator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_launch (id INT AUTO_INCREMENT NOT NULL, launcher_id INT NOT NULL, quizz_id INT NOT NULL, current_question_id INT DEFAULT NULL, ulid VARCHAR(26) NOT NULL, status VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_234871E42724B909 (launcher_id), INDEX IDX_234871E4BA934BCD (quizz_id), INDEX IDX_234871E4A0F35D66 (current_question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizz_launch_participant (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, quizz_launch_id INT NOT NULL, participant_status VARCHAR(255) NOT NULL, current_score INT NOT NULL, INDEX IDX_CB0C9579A76ED395 (user_id), INDEX IDX_CB0C957986893C7A (quizz_launch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, avatar_id INT NOT NULL, ulid VARCHAR(26) NOT NULL, INDEX IDX_8D93D64986383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EBA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT FK_7C77973D61220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quizz_launch ADD CONSTRAINT FK_234871E42724B909 FOREIGN KEY (launcher_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quizz_launch ADD CONSTRAINT FK_234871E4BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id)');
        $this->addSql('ALTER TABLE quizz_launch ADD CONSTRAINT FK_234871E4A0F35D66 FOREIGN KEY (current_question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE quizz_launch_participant ADD CONSTRAINT FK_CB0C9579A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE quizz_launch_participant ADD CONSTRAINT FK_CB0C957986893C7A FOREIGN KEY (quizz_launch_id) REFERENCES quizz_launch (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64986383B10 FOREIGN KEY (avatar_id) REFERENCES avatar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EBA934BCD');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY FK_7C77973D61220EA6');
        $this->addSql('ALTER TABLE quizz_launch DROP FOREIGN KEY FK_234871E42724B909');
        $this->addSql('ALTER TABLE quizz_launch DROP FOREIGN KEY FK_234871E4BA934BCD');
        $this->addSql('ALTER TABLE quizz_launch DROP FOREIGN KEY FK_234871E4A0F35D66');
        $this->addSql('ALTER TABLE quizz_launch_participant DROP FOREIGN KEY FK_CB0C9579A76ED395');
        $this->addSql('ALTER TABLE quizz_launch_participant DROP FOREIGN KEY FK_CB0C957986893C7A');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64986383B10');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE avatar');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_launch');
        $this->addSql('DROP TABLE quizz_launch_participant');
        $this->addSql('DROP TABLE user');
    }
}
