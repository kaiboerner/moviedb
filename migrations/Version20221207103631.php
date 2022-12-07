<?php

declare(strict_types=1);

namespace KaiBoerner\MovieDb\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207103631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'first install of table structure';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("
            create table if not exists users (
                id int unsigned not null primary key,
                name varchar(63) not null,
                password varchar(255) not null,
                unique(name)
            )
        ");
        $this->addSql("
            create table if not exists movie (
                id int unsigned not null primary key,
                title varchar(255) not null,
                regisseur varchar(127) not null,
                publication date not null,
                created datetime not null,
                created_by int unsigned not null,
                unique(title),
                foreign key (created_by) references users(id) on delete restrict on update cascade
            )
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("drop table if exists movie");
        $this->addSql("drop table if exists users");
    }
}
