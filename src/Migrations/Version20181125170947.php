<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181125170947 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, partie_id INT NOT NULL, numero INT NOT NULL, contrat VARCHAR(255) NOT NULL, debut_date DATETIME NOT NULL, fin_date DATETIME DEFAULT NULL, j1score INT DEFAULT NULL, j2score INT DEFAULT NULL, j3score INT DEFAULT NULL, j4score INT DEFAULT NULL, brin TINYINT(1) NOT NULL, est_gagnant TINYINT(1) NOT NULL, INDEX IDX_BAD4FFFDE075F7A4 (partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carte_joueur_local (carte_id INT NOT NULL, joueur_local_id INT NOT NULL, INDEX IDX_44C19B06C9C7CEB6 (carte_id), INDEX IDX_44C19B06D7DB0F99 (joueur_local_id), PRIMARY KEY(carte_id, joueur_local_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contrat_config (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, emb8pos INT NOT NULL, emb8neg INT DEFAULT NULL, emb9pos INT NOT NULL, emb9neg INT DEFAULT NULL, emb10pos INT NOT NULL, emb10neg INT DEFAULT NULL, emb11pos INT NOT NULL, emb11neg INT DEFAULT NULL, emb12pos INT NOT NULL, emb12neg INT DEFAULT NULL, solo6pos INT NOT NULL, solo6neg INT DEFAULT NULL, solo7pos INT NOT NULL, solo7neg INT DEFAULT NULL, solo8pos INT NOT NULL, solo8neg INT DEFAULT NULL, pmis_pos INT NOT NULL, pmis_neg INT DEFAULT NULL, picoli_pos INT NOT NULL, picoli_neg INT DEFAULT NULL, picolo_pos INT NOT NULL, picolo_neg INT DEFAULT NULL, abon9pos INT NOT NULL, abon9neg INT DEFAULT NULL, abon10pos INT NOT NULL, abon10neg INT DEFAULT NULL, abon11pos INT NOT NULL, abon11neg INT DEFAULT NULL, abonst9pos INT NOT NULL, abonst9neg INT DEFAULT NULL, abonst10pos INT NOT NULL, abonst10neg INT DEFAULT NULL, abonst11pos INT NOT NULL, abonst11neg INT DEFAULT NULL, gmis_pos INT NOT NULL, gmis_neg INT DEFAULT NULL, gmst_pos INT NOT NULL, gmst_neg INT DEFAULT NULL, gmsta_pos INT NOT NULL, gmsta_neg INT DEFAULT NULL, gmstt_pos INT NOT NULL, gmstt_neg INT DEFAULT NULL, trou INT NOT NULL, capot INT NOT NULL, ptsm INT NOT NULL, gdsm INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE joueur_local (id INT AUTO_INCREMENT NOT NULL, partie_id INT NOT NULL, nom VARCHAR(255) NOT NULL, score INT DEFAULT NULL, score_total INT DEFAULT NULL, ordre INT NOT NULL, INDEX IDX_536331EEE075F7A4 (partie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, config_id INT NOT NULL, tot_carte INT NOT NULL, resume LONGTEXT DEFAULT NULL, debut DATETIME NOT NULL, fin DATETIME DEFAULT NULL, en_cours TINYINT(1) NOT NULL, INDEX IDX_59B1F3D24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE carte_joueur_local ADD CONSTRAINT FK_44C19B06C9C7CEB6 FOREIGN KEY (carte_id) REFERENCES carte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carte_joueur_local ADD CONSTRAINT FK_44C19B06D7DB0F99 FOREIGN KEY (joueur_local_id) REFERENCES joueur_local (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE joueur_local ADD CONSTRAINT FK_536331EEE075F7A4 FOREIGN KEY (partie_id) REFERENCES partie (id)');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D24DB0683 FOREIGN KEY (config_id) REFERENCES contrat_config (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carte_joueur_local DROP FOREIGN KEY FK_44C19B06C9C7CEB6');
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D24DB0683');
        $this->addSql('ALTER TABLE carte_joueur_local DROP FOREIGN KEY FK_44C19B06D7DB0F99');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDE075F7A4');
        $this->addSql('ALTER TABLE joueur_local DROP FOREIGN KEY FK_536331EEE075F7A4');
        $this->addSql('DROP TABLE carte');
        $this->addSql('DROP TABLE carte_joueur_local');
        $this->addSql('DROP TABLE contrat_config');
        $this->addSql('DROP TABLE joueur_local');
        $this->addSql('DROP TABLE partie');
    }
}
