<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219203914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $users = $schema->createTable('users');

        $users->addColumn('id', Types::INTEGER)->setAutoincrement(true);
        $users->addColumn('username', Types::STRING)->setLength(64);
        $users->addColumn('email', Types::STRING)->setLength(80);
        $users->addColumn('password', Types::STRING)->setLength(256);
        $users->addColumn('token', Types::STRING);

        $users->setPrimaryKey(['id']);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $schema->dropTable('users');
    }
}
