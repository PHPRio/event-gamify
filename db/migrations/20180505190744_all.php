<?php


use Phinx\Migration\AbstractMigration;

class All extends AbstractMigration
{
    public function up()
    {
        $this->table('user')
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addTimestamps()
            ->addIndex(['id'], ['unique' => true])
            ->save();

        $this->table('user_service')
            ->addColumn('service', 'string')
            ->addColumn('service_metadata', 'string')
            ->addColumn('user_id', 'integer')
            ->addIndex(['id'], ['unique' => true])
            ->addForeignKey('user_id', 'user', 'id', [
                'delete'=> 'CASCADE',
                'update'=> 'CASCADE'
            ])
            ->save();

        $this->table('meetup_event')
            ->addColumn('urlname', 'string')
            ->addColumn('event_code', 'integer')
            ->addColumn('date_start', 'datetime')
            ->addColumn('date_finish', 'datetime')
            ->addIndex(['id'], ['unique' => true])
            ->save();

        $this->table('user_event')
            ->addColumn('user_service_id', 'integer')
            ->addColumn('meetup_event_id', 'integer')
            ->addColumn('response', 'string')
            ->addColumn('status', 'string')
            ->addIndex(['id'], ['unique' => true])
            ->addForeignKey('user_service_id', 'user_service', 'id', [
                'delete'=> 'CASCADE',
                'update'=> 'CASCADE'
            ])
            ->addForeignKey('meetup_event_id', 'meetup_event', 'id', [
                'delete'=> 'CASCADE',
                'update'=> 'CASCADE'
            ])
            ->save();
    }

    public function down()
    {
        $this->dropTable('user_event');
        $this->dropTable('user_service');
        $this->dropTable('meetup_event');
        $this->dropTable('user');
    }
}
