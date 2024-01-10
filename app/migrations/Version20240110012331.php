<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110012331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_products (id VARCHAR(255) NOT NULL, products_id VARCHAR(255) NOT NULL, order_id_id VARCHAR(255) NOT NULL, quantity INT NOT NULL, INDEX IDX_5242B8EB6C8A81A9 (products_id), INDEX IDX_5242B8EBFCDAEAAA (order_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `orders` (id VARCHAR(255) NOT NULL, customer_name VARCHAR(255) NOT NULL, amount INT NOT NULL, total_vat NUMERIC(10, 2) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, desc_text LONGTEXT DEFAULT NULL, price INT NOT NULL, status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EB6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('ALTER TABLE order_products ADD CONSTRAINT FK_5242B8EBFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `orders` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_products DROP FOREIGN KEY FK_5242B8EB6C8A81A9');
        $this->addSql('ALTER TABLE order_products DROP FOREIGN KEY FK_5242B8EBFCDAEAAA');
        $this->addSql('DROP TABLE order_products');
        $this->addSql('DROP TABLE `orders`');
        $this->addSql('DROP TABLE products');
    }
}
