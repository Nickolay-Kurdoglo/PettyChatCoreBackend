<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229085743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('user_oauth');

        $table->addColumn('user_id', Types::INTEGER);
        $table->addColumn('access_token', Types::STRING)->setLength(350);
        $table->addColumn('refresh_token', Types::STRING)->setLength(350);
        $table->addColumn('created_at', Types::DATETIME_MUTABLE);
        $table->addColumn('expires_at', Types::DATETIME_MUTABLE);

        $table->addForeignKeyConstraint('users', ['user_id'], ['id'], ['onDelete' => 'CASCADE']);
    }

    public function down(Schema $schema): void
    {
        $table = $schema->dropTable('user_oauth');
    }
}
